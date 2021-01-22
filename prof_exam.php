<?php
$namepage = "prof";
session_start();
include 'init.php';
if (isset($_SESSION['prof_id']) && is_numeric($_SESSION['prof_id'])) {
    $profid = $_SESSION['prof_id'];
    include $navprof;
    $stmt = $con->prepare("SELECT * FROM online_exam WHERE prof_id  =  ? ORDER BY exam_id DESC");
    $stmt->execute(array($profid));
    $allexam = $stmt->fetchAll();
    $count = $stmt->rowCount();
    if ($count > 0) {
?>
        <div class="allcou">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel">
                            <div class="panelhead">All My Exam</div>
                            <div class="panelbody">
                                <div class="row text-left" style="margin-bottom: 1%;">
                                    <div class="col-lg-12">
                                        <a href="addexam.php" class="btn btn-primary">Add Exam</a>
                                        <a href="alluser.php" class="btn btn-danger"> <i class="fa fa-users"></i> All My Student </a>
                                    </div>
                                </div>
                                <table class="table table-bordered table_cou">
                                    <tr>
                                        <td>#</td>
                                        <td>Exam Eitle</td>
                                        <td>Data & Time</td>
                                        <td>Total Question</td>
                                        <td>Right answer</td>
                                        <td>Wrong answer</td>
                                        <td>Total Rate</td>
                                        <td>Question</td>
                                        <td>Result</td>
                                        <td>status</td>
                                        <td>Action</td>
                                    </tr>

                                    <?php
                                    foreach ($allexam as $exam) {
                                        if (isset($_POST["submit"]) && $_POST["submit"] == $exam["exam_id"]) {

                                            if ($_POST["action"] == "editexam" . "_" . $exam['exam_id']) {

                                                $time       =  date("d-M Y") . ' at ' . date("h:i A");
                                                $extitle    =  strtolower(filter_var($_POST["examtitle"], FILTER_SANITIZE_STRING));
                                                $totalquest =  filter_var($_POST["totalquest"], FILTER_SANITIZE_NUMBER_INT);
                                                $markright  =  $_POST["markright"];
                                                $markwrong  =  $_POST["markwrong"];

                                                $stmt2 = $con->prepare("SELECT * FROM online_exam WHERE prof_id = ? AND exam_id != ?");
                                                $stmt2->execute(array($profid, $exam['exam_id']));
                                                $allexam = $stmt2->fetchAll();

                                                $exist = 0;
                                                foreach ($allexam as $exam) {
                                                    if ($exam["exam_title"] == $extitle) {
                                                        $exist = $exist + 1;
                                                    }
                                                }
                                                if ($exist == 1) {
                                    ?>
                                                    <div class="alert alert-danger" style="text-transform: capitalize;"> this exam title is allready <b>exist<b> </div>
                                                    <?php
                                                } else {
                                                    $stmt3 = $con->prepare("UPDATE online_exam SET prof_id = ? , exam_title =  ? , total_ques = ? , marks_per_right_answer = ? , marks_per_wrong_answer = ? , creat_on = ?  WHERE exam_id = ?");
                                                    $stmt3->execute(array($profid, $extitle, $totalquest, $markright, $markwrong, $time, $exam["exam_id"]));
                                                    if ($stmt3) {
                                                    ?>
                                                        <div class="alert alert-success" style="text-transform: capitalize;">you have Edit exam successfully</div>
                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $exam["exam_id"]; ?></td>
                                            <td><?php echo  ucwords($exam["exam_title"]); ?></td>
                                            <td><?php echo $exam["creat_on"]; ?></td>
                                            <td><?php echo $exam["total_ques"]; ?></td>
                                            <td><?php echo $exam["marks_per_right_answer"] . " mark"; ?></td>
                                            <td><?php echo '-' . $exam["marks_per_wrong_answer"] . ' mark'; ?></td>
                                            <td>
                                                <?php
                                                $stmt = $con->prepare("SELECT floor(AVG(fed_rate)) AS rate FROM feedback WHERE exam_id = ?");
                                                $stmt->execute(array($exam["exam_id"]));
                                                $totavg = $stmt->fetch();
                                                $count = $stmt->rowCount();

                                                if ($count > 0) {

                                                    if ($totavg["rate"] == 1) {
                                                        echo '<i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> ';
                                                    } elseif ($totavg["rate"] == 2) {
                                                        echo '<i class="fas fa-star"  style="color: gold;"></i><i class="fas fa-star"  style="color: gold;"></i> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
                                                    } elseif ($totavg["rate"] == 3) {
                                                        echo '<i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i> <i class="fas fa-star"></i><i class="fas fa-star"></i>';
                                                    } elseif ($totavg["rate"] == 4) {
                                                        echo '<i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i> <i class="fas fa-star"></i>';
                                                    } elseif ($totavg["rate"] == 5) {
                                                        echo '<i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i>';
                                                    }
                                                } else {
                                                    echo "No Rate Until";
                                                }
                                                ?>
                                            </td>
                                            <?php
                                            $stmt = $con->prepare("SELECT * FROM quest_exam WHERE online_exam_id = ?");
                                            $stmt->execute(array($exam["exam_id"]));
                                            $count2 = $stmt->fetch();
                                            if ($count2 > 0) {
                                            ?>
                                                <td><a href="viewQuest.php?exam_id=<?php echo $exam["exam_id"]; ?>" style="color: #fff;" class="btn btn-info">View Questions</a></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td><a href="addquest.php?exam_id=<?php echo $exam["exam_id"]; ?>" class="btn btn-primary">Add Question</a></td>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            $stmt = $con->prepare("SELECT * FROM user_exam_answer WHERE exam_id = ? GROUP BY stud_id");
                                            $stmt->execute(array($exam["exam_id"]));
                                            $count = $stmt->rowCount();
                                            if ($count > 0) {
                                            ?>
                                                <td><a href="resultexam.php?exam_id=<?php echo $exam["exam_id"]; ?>" class="btn btn-secondary"><i class="fa fa-file"></i> Result</a></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td><a href="#" class="btn btn-dark" disable> No Result</a></td>
                                            <?php
                                            }
                                            ?>
                                            <td>
                                                <?php
                                                if ($exam["exam_status"] == 0) {
                                                ?>
                                                    <button class='btn btn-danger'> Not completed</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class='btn btn-success'> completed</button>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="editexam.php?exam_id=<?php echo $exam["exam_id"]; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="deletexam.php?exam_id=<?php echo $exam["exam_id"]; ?>" class="btn btn-danger"> <i class="fas fa-times"></i> Delete</a>
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
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="allcou">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger text-center"> no exam added untill </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="addexam.php" class="btn btn-primary">Add Exam</a>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
    include $footer;
} else {
    header("location:loginprof.php");
}
