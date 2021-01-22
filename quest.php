<?php
$namepage = "Exam";
session_start();
include 'init.php';

if (isset($_GET["exam_id"]) && is_numeric($_GET["exam_id"])) {

    /**for select all questions in exam ordering id of exam */
    $exam_id = $_GET["exam_id"];


    $stmt3 = $con->prepare("SELECT * FROM user_exam_answer WHERE  stud_id  = ? AND exam_id = ?");
    $stmt3->execute(array($_SESSION["stu_id"], $exam_id));
    $count2 = $stmt3->rowCount();
    if ($count2 == 0) {

        $stmt = $con->prepare("SELECT * FROM quest_exam WHERE online_exam_id = ? ");
        $stmt->execute(array($exam_id));
        $allquest = $stmt->fetchAll();


        $stmt3 = $con->prepare("SELECT * FROM online_exam WHERE exam_id  = ? ");
        $stmt3->execute(array($exam_id));
        $alldetailsexam = $stmt3->fetch();

        $stmt2 = $con->prepare("SELECT * FROM student WHERE stu_id = ?");
        $stmt2->execute(array($_SESSION["stu_id"]));
        $allinfo = $stmt2->fetch();
        $count = $stmt2->rowCount();
        if ($count > 0) {
            include $nav;

            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                $total_mark = 0;
                foreach ($allquest as $qu) {

                    $option = $_POST["option" . "_" . $qu["quest_id"]];
                    if ($option == $qu["anwser_quest"]) {
                        $total_mark = $total_mark + $alldetailsexam["marks_per_right_answer"];
                        $mark = $alldetailsexam["marks_per_right_answer"];
                    } else {
                        $total_mark = $total_mark - $alldetailsexam["marks_per_wrong_answer"];
                        $mark = "-" . $alldetailsexam["marks_per_wrong_answer"];
                    }
                    $stmt = $con->prepare("INSERT INTO user_exam_answer (stud_id , exam_id  , question_id  , user_answer_option , mark_per_question)
                                    VALUES (:st , :exam , :ques , :user_an_option , :mark_per_quest)");
                    $stmt->execute(array(
                        'st'             => $_SESSION["stu_id"],
                        'exam'           => $exam_id,
                        'ques'           => $qu["quest_id"],
                        'user_an_option' => $option,
                        'mark_per_quest' => $mark,
                    ));
                }
                if ($stmt) {
                    header("Refresh:1;feedback.php?prof_id=" . $alldetailsexam['prof_id'] . "&exam_id=" . $exam_id);
                    $suc = "<div class='alert alert-success text-center'>you are submit exam successfully</div>";
                }
            }
?>
            <div class="allcou">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8">
                            <?php if (isset($suc)) {
                                echo $suc;
                            } ?>
                            <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                                <?php
                                $x = 1;
                                foreach ($allquest as $qu) {
                                ?>
                                    <div class="panel">
                                        <div class="panelhead questions"><?php echo $x . ")"; ?> <?php echo ucwords($qu["question_title"]); ?></div>
                                        <div class="panelbody options text-left">
                                            <?php
                                            /**select all option from this exam for 4 question then 16 options in exam */
                                            $stmt4 = $con->prepare("SELECT * FROM options WHERE option_exam_id  = ? AND quest_id  = ? ");
                                            $stmt4->execute(array($exam_id, $qu["quest_id"]));
                                            $alloption = $stmt4->fetchAll();
                                            echo "<div class='row'>";
                                            $y = 1;
                                            foreach ($alloption as $opt) {
                                            ?>
                                                <div class="col-lg-6">
                                                    <input type="radio" name="option_<?php echo $opt['quest_id']; ?>" value="<?php echo $y ?>" id="option.<?php echo $opt["option_id"]; ?>" required>
                                                    <label for="option.<?php echo $opt["option_id"]; ?>"><?php echo $opt["option_title"]; ?></label>
                                                </div>
                                            <?php
                                                $y++;
                                            }
                                            ?>
                                        </div>

                                    </div>
                        </div>
                    <?php
                                    $x++;
                                }
                    ?>
                    <input type="hidden" name="action" value="sendexam">
                    <button class="btn btn-primary btn-block">Submit Exam</button>
                    </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel">
                            <div class="panelhead"><?php echo ucwords($alldetailsexam["exam_title"]); ?></div>
                            <div class="panelbody text-left">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-question-circle"></i> total Questions: <span class="infouser"><?php echo $alldetailsexam["total_ques"] . " Questions"; ?></span></li>
                                    <li><i class="fas fa-check-circle"></i> Marks Per Right Answer: <span class="infouser"><?php echo $alldetailsexam["marks_per_right_answer"] . " marks"; ?></span></li>
                                    <li><i class="fas fa-times-circle"></i> Marks Per Wrong Answer: <span class="infouser"><?php echo "-" . $alldetailsexam["marks_per_wrong_answer"] . " marks"; ?></span></li>
                                    <li><i class="fas fa-calendar-alt"></i> creat on: <span class="infouser"><?php echo ucfirst($alldetailsexam["creat_on"]); ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        <div class="panel">
                            <div class="panelhead"><?php echo ucwords($allinfo["username"]); ?></div>
                            <div class="panelbody text-left">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-venus-mars"></i> gender: <span class="infouser"><?php if ($allinfo["gender"] == 1) {
                                                                                                                echo "male";
                                                                                                            } else {
                                                                                                                echo "female";
                                                                                                            } ?></span></li>
                                    <li><i class="fas fa-university"></i> university: <span class="infouser"><?php if ($allinfo["collge"] == 1) {
                                                                                                                    echo "FCI";
                                                                                                                } elseif ($allinfo["collge"] == 2) {
                                                                                                                    echo "Sciences";
                                                                                                                } ?></span></li>
                                    <li><i class="fas fa-graduation-cap"></i> level: <span class="infouser"><?php echo $allinfo["level"]; ?></span></li>
                                    <li><i class="fas fa-envelope-open"></i> Address: <span class="infouser"><?php echo ucfirst($allinfo["address"]); ?></span></li>
                                    <li><i class="fas fa-mobile"></i> mobile: <span class="infouser"><?php echo $allinfo["mobile"];  ?></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            </div>
<?php
            include $footer;
        } else {
            header("location:loginstudent.php");
        }
    } else {
        header("location:details_exam.php");
    }
} else {
    header("location:loginstudent.php");
}
