<?php
$namepage = "My Students";
session_start();
include 'init.php';
if (isset($_SESSION['prof_id']) && is_numeric($_SESSION['prof_id'])) {
    $profid = $_SESSION['prof_id'];
    include $navprof;
    $stmt = $con->prepare("SELECT * FROM prof_student WHERE prof_id  = ?");
    $stmt->execute(array($profid));
    $alluser = $stmt->fetchAll();
?>
    <div class="allcou">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table_cou">
                        <tr>
                            <td>#</td>
                            <td>username</td>
                            <td>the college</td>
                            <td>View Details</td>
                        </tr>
                        <?php
                        $x =1;
                        foreach ($alluser as $user) {
                            $stmt = $con->prepare("CALL Display_all_student_of_specific_prof(?)");
                            $stmt->execute(array($user["stu_id"]));
                            $userinfo = $stmt->fetch();
                        ?>
                            <tr>
                                <td><?php echo $x; ?></td>
                                <td><?php echo $userinfo["username"]; ?></td>
                                <td><?php if ($userinfo["collge"] == 1) {
                                        echo "Computer Science";
                                    } elseif ($userinfo["collge"] == 2) {
                                        echo "Sciences";
                                    } ?></td>
                                <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#alluser_<?php echo $userinfo["stu_id"]; ?>"> <i class="fas fa-eye"></i> View All</button></td>
                            </tr>
                            <div class="modal fade" id="alluser_<?php echo $userinfo["stu_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <?php echo $userinfo["username"]; ?>
                                                            </div>
                                                        </div>
                                                        <div class="row userdet">
                                                            <div class="col-lg-4">
                                                                <i class="fas fa-venus-mars"></i> Gender:-
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <?php if ($userinfo["gender"] == 1) {
                                                                    echo "Male";
                                                                } elseif ($userinfo["gender"] == 2) {
                                                                    echo "Female";
                                                                } ?>
                                                            </div>
                                                        </div>
                                                        <div class="row userdet">
                                                            <div class="col-lg-4">
                                                                <i class="fas fa-university"></i> collge:-
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <?php if ($userinfo["collge"] == 1) {
                                                                    echo "Computer Science";
                                                                } elseif ($userinfo["collge"] == 2) {
                                                                    echo   "Sciences";
                                                                } ?>
                                                            </div>
                                                        </div>
                                                        <div class="row userdet">
                                                            <div class="col-lg-4">
                                                                <i class="fas fa-graduation-cap"></i> level:-
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <?php echo $userinfo["level"]; ?>
                                                            </div>
                                                        </div>
                                                        <div class="row userdet">
                                                            <div class="col-lg-4">
                                                                <i class="fas fa-envelope-open"></i> Address:-
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <?php echo $userinfo["address"]; ?>
                                                            </div>
                                                        </div>
                                                        <div class="row userdet">
                                                            <div class="col-lg-4">
                                                                <i class="fas fa-mobile"></i> mobile:-
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <?php echo $userinfo["mobile"]; ?>
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
