<?php
$namepage = "prof";
session_start();
include 'init.php';
if (isset($_SESSION['prof_id']) && is_numeric($_SESSION['prof_id'])) {
    if (isset($_GET['exam_id']) && is_numeric($_GET["exam_id"])) {

        $profid = $_SESSION['prof_id'];
        $exam_id = $_GET['exam_id'];
        $stmt = $con->prepare("SELECT * FROM  online_exam WHERE exam_id  = ?");
        $stmt->execute(array($exam_id));
        $examdett = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $stmt = $con->prepare("SELECT * FROM quest_exam WHERE online_exam_id  = ?");
            $stmt->execute(array($exam_id));
            $allquest = $stmt->fetchAll();
            include $navprof;
?>
            <div class="allcou">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table_cou">
                                <tr>
                                    <td>#</td>
                                    <td>Questions title</td>
                                    <td>Option Right</td>
                                    <td>Action</td>
                                <tr>
                                    <?php
                                    $x = 1;
                                    foreach ($allquest as $qu) {

                                        if($_SERVER["REQUEST_METHOD"] == 'POST')
                                        {
                                            if($_POST["action"] == $qu["quest_id"])
                                            {
                                                $option1 = $_POST["option1"];
                                                $option2 = $_POST["option2"];
                                                $option3 = $_POST["option3"];
                                                $option4 = $_POST["option4"];

                                                $stmt = $con->prepare("INSERT INTO  options (quest_id ,option_exam_id , option_title) VALUES(:q , :e , :o)");
                                                $stmt->execute(array(
                                                    'q' => $qu["quest_id"],
                                                    'e' => $exam_id,
                                                    'o' => $option1
                                                ));
                                                $stmt = $con->prepare("INSERT INTO  options (quest_id ,option_exam_id , option_title) VALUES(:q , :e , :o)");
                                                $stmt->execute(array(
                                                    'q' => $qu["quest_id"],
                                                    'e' => $exam_id,
                                                    'o' => $option2
                                                ));
                                                $stmt = $con->prepare("INSERT INTO  options (quest_id ,option_exam_id , option_title) VALUES(:q , :e , :o)");
                                                $stmt->execute(array(
                                                    'q' => $qu["quest_id"],
                                                    'e' => $exam_id,
                                                    'o' => $option3
                                                ));
                                                $stmt = $con->prepare("INSERT INTO options (quest_id ,option_exam_id , option_title) VALUES(:q , :e , :o)");
                                                $stmt->execute(array(
                                                    'q' => $qu["quest_id"],
                                                    'e' => $exam_id,
                                                    'o' => $option4
                                                ));
                                            }
                                        }

                                    ?>
                                <tr>
                                    <td><?php echo $x; ?></td>
                                    <td class="text-left"><?php echo $qu["question_title"]; ?></td>
                                    <td><?php echo 'option ' . $qu["anwser_quest"]  ?></td>
                                    <td>

                                        <a href="editquest.php?quest=<?php echo $qu["quest_id"] ?>" class='btn btn-primary'> <i class='fa fa-edit'></i>Edit</a>
                                        <?php
                                        $stmt = $con->prepare("SELECT * FROM  options WHERE option_exam_id = ? AND quest_id  = ?");
                                        $stmt->execute(array($exam_id, $qu["quest_id"]));
                                        $count = $stmt->rowCount();
                                        if ($count == 0) {
                                        ?>
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addoption_<?php echo $qu["quest_id"]; ?>">Add Option</button>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <form action="<?php echo $_SERVER["PHP_SELF"]."?exam_id=".$exam_id; ?>" method="post">
                                    <div class="modal fade" id="addoption_<?php echo $qu["quest_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="allcou">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="optionst row">
                                                                        <div class="col-lg-3">
                                                                            Option 1:
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" placeholder="type option 1" name="option1" class='form-control' required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="optionst row">
                                                                        <div class="col-lg-3">
                                                                            Option 2:
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" placeholder="type option 2" name="option2" class='form-control' required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="optionst row">
                                                                        <div class="col-lg-3">
                                                                            Option 3:
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" placeholder="type option 3" name="option3" class='form-control' required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="optionst row">
                                                                        <div class="col-lg-3">
                                                                            Option 4:
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" placeholder="type option 4" name="option4" class='form-control' required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" value="<?php echo $qu["quest_id"]; ?>" name="action" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php
                                        $x++;
                                    }
                                    $stmt = $con->prepare("SELECT * FROM options WHERE option_exam_id = ?");
                                    $stmt->execute(array($exam_id));
                                    $count2 = $stmt->rowCount();
                                    
                                    if($count2 == $examdett['total_ques'] * 4)
                                    {
                                        $stmt = $con->prepare("UPDATE online_exam SET exam_status = ? WHERE exam_id  = ?");
                                        $stmt->execute(array(1,$exam_id));
                                        $dat_con = date('M-d h:i:s A');
                                        
                                        $stmt = $con->prepare("SELECT * FROM prof_student WHERE prof_id  = ?");
                                        $stmt->execute(array($profid));
                                        $allstud = $stmt->fetchAll();

                                        foreach($allstud as $std)
                                        {
                                            $stmt = $con->prepare("INSERT INTO `notification` (prof_id, exam_id , std_id , no_date,con_status) VALUES(:p,:e,:s ,:n,:c)");
                                            $stmt->execute(array(
                                                'p' => $profid,
                                                'e' =>  $exam_id,
                                                's' => $std["stu_id"],
                                                'n' => $dat_con,
                                                'c' => 0
                                            ));
                                        }
                                    }
                            ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
<?php
            include $footer;
        } else {
            header("location:loginprof.php");
        }
    } else {
        header("location:loginprof.php");
    }
} else {
    header("location:loginprof.php");
}
