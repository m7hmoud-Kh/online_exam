<?php
$namepage = "Exam page";
session_start();
include 'init.php';
if (isset($_GET["exam_id"]) && is_numeric($_GET["exam_id"])) {
    if (isset($_SESSION["stu_id"]) && is_numeric($_SESSION["stu_id"])) {

        $stmt = $con->prepare("SELECT * FROM user_exam_answer WHERE stud_id  = ? AND exam_id = ?");
        $stmt->execute(array($_SESSION["stu_id"], $_GET["exam_id"]));
        $alldet = $stmt->fetchAll();
        $count = $stmt->rowCount();

        if ($count > 0) {
            $stmt = $con->prepare("SELECT * FROM quest_exam WHERE online_exam_id = ?");
            $stmt->execute(array($_GET["exam_id"]));
            $allquest = $stmt->fetchAll();

            $stmt = $con->prepare("SELECT * FROM student WHERE stu_id  = ?");
            $stmt->execute(array($_SESSION["stu_id"]));
            $allinfo = $stmt->fetch();


            include $nav;
?>
            <div class="allcou">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel">
                                <div class="panelhead questions text-center result_ex"> online exam result </div>
                                <div class="panelbody">
                                    <table class="table table-bordered table_cou">
                                        <tr>
                                            <td>Questions</td>
                                            <td>option_A</td>
                                            <td>option_B</td>
                                            <td>option3_C</td>
                                            <td>option_D</td>
                                            <td>Your Answer</td>
                                            <td>Answer</td>
                                            <td>Result</td>
                                            <td>Marks</td>
                                        </tr>
                                        <?php
                                        $x = 1;
                                        foreach ($allquest as $qu) {
                                            $stmt = $con->prepare("SELECT * FROM options WHERE quest_id  = ? AND option_exam_id  = ?");
                                            $stmt->execute(array($qu["quest_id"], $_GET["exam_id"]));
                                            $alloption = $stmt->fetchAll();

                                        ?>
                                            <tr class="table_mark">
                                                <td><?php echo $x . ") " . substr($qu["question_title"], 0, 25) . "...."; ?></td>
                                                <?php
                                                foreach ($alloption as $opt) {
                                                ?>
                                                    <td><?php echo $opt["option_title"]; ?></td>
                                                <?php
                                                }
                                                $stmt = $con->prepare("SELECT * FROM user_exam_answer WHERE stud_id  = ? AND exam_id = ? AND question_id   = ?");
                                                $stmt->execute(array($_SESSION["stu_id"], $_GET["exam_id"], $qu["quest_id"]));
                                                $allanswer = $stmt->fetchAll();
                                                foreach ($allanswer as $det) {
                                                ?>
                                                    <td><?php if ($det["user_answer_option"] == 1) {
                                                            echo "A";
                                                        } elseif ($det["user_answer_option"] == 2) {
                                                            echo "B";
                                                        } elseif ($det["user_answer_option"] == 3) {
                                                            echo "C";
                                                        } elseif ($det["user_answer_option"] == 4) {
                                                            echo "D";
                                                        } ?></td>
                                                <?php
                                                }
                                                ?>
                                                <td>
                                                    <?php
                                                    if ($qu["anwser_quest"] == 1) {
                                                        echo "A";
                                                    } elseif ($qu["anwser_quest"] == 2) {
                                                        echo "B";
                                                    } elseif ($qu["anwser_quest"] == 3) {
                                                        echo "C";
                                                    } elseif ($qu["anwser_quest"] == 4) {
                                                        echo "D";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($allanswer as $det) {
                                                    ?>
                                                        <?php if ($det["user_answer_option"] == $qu["anwser_quest"]) {
                                                        ?>
                                                            <i class="fas fa-check" style="color:#16b681;"></i>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <i class="fas fa-times" style="color:#f00;"></i>
                                                        <?php
                                                        }
                                                        ?>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($allanswer as $mark) {
                                                        if ($mark["mark_per_question"] > 0) {
                                                            echo "+" . $mark["mark_per_question"];
                                                        } else {
                                                            echo $mark["mark_per_question"];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                            $x++;
                                        }
                                        ?>
                                        <h2>Total Result:
                                            <?php
                                            $stmt = $con->prepare("SELECT SUM(mark_per_question) AS totalmark FROM user_exam_answer WHERE stud_id = ? AND exam_id = ? ");
                                            $stmt->execute(array($_SESSION["stu_id"], $_GET["exam_id"]));
                                            $result = $stmt->fetch(); 
                                            ?>
                                            <span class="finresult"><?php echo $result["totalmark"] ; ?></span>
                                        </h2>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
            include $footer;
        } else {
            header("location:loginstudent.php");
        }
    } else {
        header("location:loginstudent.php");
    }
} else {
    header("location:loginstudent.php");
}
