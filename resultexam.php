<?php
$namepage = "prof";
session_start();
include 'init.php';
if (isset($_SESSION['prof_id']) && is_numeric($_SESSION['prof_id'])) {
    if (isset($_GET['exam_id']) && is_numeric($_GET["exam_id"])) {

        $exam_id = $_GET['exam_id'];


        $stmt = $con->prepare("UPDATE feedback SET fed_status = 1 WHERE exam_id = ?");
        $stmt->execute(array($exam_id));


        $stmt1 = $con->prepare("SELECT * FROM online_exam WHERE exam_id = ?");
        $stmt1->execute(array($exam_id));
        $examdet = $stmt1->fetch();


        $profid = $_SESSION['prof_id'];


        $stmt = $con->prepare("SELECT * FROM user_exam_answer WHERE exam_id = ? GROUP BY stud_id");
        $stmt->execute(array($exam_id));
        $alluser = $stmt->fetchAll();
        $count = $stmt->rowCount();
        if ($count > 0) {
            include $navprof;
?>
            <div class="allcou">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table_cou">
                                <tr>
                                    <td>#</td>
                                    <td>username</td>
                                    <td>Gender</td>
                                    <td>Full Mark</td>
                                    <td>Your Grade</td>
                                    <td>Rate</td>
                                    <td>Feedback</td>
                                    <td>view details</td>
                                </tr>
                                <?php
                                $x = 1;
                                foreach ($alluser as $userinfo) {
                                    $stmt = $con->prepare("SELECT * FROM student WHERE stu_id = ?");
                                    $stmt->execute(array($userinfo['stud_id']));
                                    $user = $stmt->fetch();

                                    $stmt = $con->prepare("SELECT SUM(mark_per_question) AS totalmark FROM user_exam_answer WHERE stud_id = ? AND exam_id = ?  ORDER BY SUM(mark_per_question) DESC");
                                    $stmt->execute(array($user["stu_id"], $exam_id));
                                    $result = $stmt->fetch();


                                    $stmt = $con->prepare("SELECT * FROM feedback WHERE prof_id = ? AND exam_id = ? AND  stud_id = ?");
                                    $stmt->execute(array($profid, $exam_id, $user["stu_id"]));
                                    $feed = $stmt->fetch();

                                ?>
                                    <tr>
                                        <td><?php echo $x; ?></td>
                                        <td><?php echo $user["username"]; ?></td>
                                        <td><?php if ($user["gender"] == 1) {
                                                echo "Male";
                                            } elseif ($user["gender"] == 2) {
                                                echo  "Female";
                                            } ?>
                                        </td>
                                        <td><?php echo $examdet["total_ques"] * $examdet['marks_per_right_answer']; ?></td>
                                        <td><?php echo $result["totalmark"];  ?></td>

                                        <td> <?php if ($feed["fed_rate"] == 1) {
                                                    echo '<i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> ';
                                                } elseif ($feed["fed_rate"] == 2) {
                                                    echo '<i class="fas fa-star"  style="color: gold;"></i><i class="fas fa-star"  style="color: gold;"></i> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
                                                } elseif ($feed["fed_rate"] == 3) {
                                                    echo '<i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i> <i class="fas fa-star"></i><i class="fas fa-star"></i>';
                                                } elseif ($feed["fed_rate"] == 4) {
                                                    echo '<i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i> <i class="fas fa-star"></i>';
                                                } elseif ($feed["fed_rate"] == 5) {
                                                    echo '<i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i><i class="fas fa-star" style="color: gold;"></i>';
                                                }  ?></td>
                                        <td> <?php echo $feed["fed_con"]; ?> </td>

                                        <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#alluser_<?php echo $user["stu_id"]; ?>"> <i class="fas fa-eye"></i> View All</button></td>
                                    </tr>
                                    <div class="modal fade" id="alluser_<?php echo $user["stu_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">User Detail</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="row userdet">
                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-user"></i> Name:-
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $user["username"]; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row userdet">
                                                                    <div class="col-lg-4">
                                                                        <i class="fas fa-venus-mars"></i> Gender:-
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <?php if ($user["gender"] == 1) {
                                                                            echo "Male";
                                                                        } elseif ($user["gender"] == 2) {
                                                                            echo  "Female";
                                                                        } ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row userdet">
                                                                    <div class="col-lg-4">
                                                                        <i class="fas fa-university"></i> collge:-
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <?php if ($user["collge"] == 1) {
                                                                            echo "Computer Science";
                                                                        } elseif ($user["collge"] == 2) {
                                                                            echo "Sciences";
                                                                        } ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row userdet">
                                                                    <div class="col-lg-4">
                                                                        <i class="fas fa-graduation-cap"></i> level:-
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $user["level"]; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row userdet">
                                                                    <div class="col-lg-4">
                                                                        <i class="fas fa-envelope-open"></i> Address:-
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $user["address"]; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row userdet">
                                                                    <div class="col-lg-4">
                                                                        <i class="fas fa-mobile"></i> mobile:-
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $user["mobile"]; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $x++;
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
