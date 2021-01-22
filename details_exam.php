<?php
$namepage = "Exams page";
session_start();
include 'init.php';
if (isset($_GET["prof_id"]) && is_numeric($_GET["prof_id"])) {
    $prof_id = $_GET["prof_id"];

    $stmt = $con->prepare("SELECT * FROM online_exam WHERE prof_id = ? AND exam_status = ? ORDER BY exam_id DESC");
    $stmt->execute(array($prof_id, 1));
    $allexam = $stmt->fetchAll();

    $stmt = $con->prepare("UPDATE `notification` SET con_status = 1 WHERE prof_id = ? AND std_id = ?");
    $stmt->execute(array($prof_id, $_SESSION["stu_id"]));

    $stmt2 = $con->prepare("SELECT * FROM student WHERE stu_id = ?");
    $stmt2->execute(array($_SESSION["stu_id"]));
    $allinfo = $stmt2->fetch();
    $count = $stmt2->rowCount();

    if ($count > 0) {
        include $nav;
?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="allcou">
                        <table class="table table-bordered table_cou">
                            <tr>
                                <td>ID</td>
                                <td> exam title</td>
                                <td> total questions</td>
                                <td> marks per right answer</td>
                                <td> marks per wrong answer</td>
                                <td>total marks</td>
                                <td>Add on</td>
                                <td>details</td>
                            </tr>
                            <?php
                            foreach ($allexam as $exam) {


                                $stmt3 = $con->prepare("SELECT * FROM user_exam_answer WHERE stud_id  = ? AND exam_id = ?");
                                $stmt3->execute(array($_SESSION["stu_id"], $exam["exam_id"]));
                                $count2 = $stmt3->rowCount();
                            ?>
                                <tr>
                                    <td><?php echo $exam["exam_id"] ?></td>
                                    <td><?php echo $exam["exam_title"] ?></td>
                                    <td><?php echo $exam["total_ques"] . '  Questions' ?></td>
                                    <td><?php echo $exam["marks_per_right_answer"] . ' marks' ?></td>
                                    <td><?php echo '-' . $exam["marks_per_wrong_answer"] . ' marks' ?></td>
                                    <td><?php echo $exam["total_ques"] * $exam["marks_per_right_answer"] . '  marks'; ?></td>
                                    <td><?php echo $exam["creat_on"] ?></td>
                                    <td>
                                        <?php
                                        if ($count2 == 0) {
                                        ?>
                                            <a href="quest.php?exam_id=<?php echo $exam['exam_id']; ?>" class="btn btn-primary">Start Now<a>
                                                <?php
                                            } else {
                                                ?>
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal_<?php echo $exam["exam_id"]; ?>">Show result</button>


                                                    <div class="modal fade" id="exampleModal_<?php echo $exam["exam_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $exam["exam_title"] ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php
                                                                    $stmt = $con->prepare("SELECT SUM(mark_per_question) AS totalmark FROM user_exam_answer WHERE stud_id = ? AND exam_id = ? ");
                                                                    $stmt->execute(array($_SESSION["stu_id"], $exam["exam_id"]));
                                                                    $result = $stmt->fetch();
                                                                    if ($result["totalmark"] <= 0) {
                                                                    ?>
                                                                        <div class="alert alert-danger text-center"> YOU have <?php echo $result["totalmark"]; ?> / <?php echo $exam["total_ques"] * $exam["marks_per_right_answer"] ?> </div>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <div class="alert alert-success text-center"> <i class="fas fa-trophy"></i> YOU have <?php echo $result["totalmark"]; ?> / <?php echo $exam["total_ques"] * $exam["marks_per_right_answer"] ?> </div>
                                                                    <?php
                                                                    }

                                                                    ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    <a href="mark.php?exam_id=<?php echo $exam['exam_id'] ?>" class="btn btn-warning">View details<a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                            }
                                                ?>
                                    </td>
                                </tr>
                            <?php
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
        header("location:loginstudent.php");
    }
} else {
    header("location:loginstudent.php");
}
