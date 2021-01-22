<?php
$namepage = "Exam page";
session_start();
include 'init.php';
if (isset($_SESSION["stu_id"]) && is_numeric($_SESSION["stu_id"])) {

    $stu_id = $_SESSION["stu_id"];

    $stmt = $con->prepare("SELECT * FROM student WHERE stu_id = ?");
    $stmt->execute(array($stu_id));

    $allinfo = $stmt->fetch();
    
    $stmt = $con->prepare("SELECT * FROM prof_student WHERE stu_id  = ?");
    $stmt->execute(array($stu_id));
    $allprof = $stmt->fetchAll();
    include $nav;
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="allcou">
                    <table class="table table-bordered table_cou">
                        <tr>
                            <td>ID</td>
                            <td><i class="fa fa-user"></i> Prof name</td>
                            <td><i class="fas fa-venus-mars"></i> prof gender</td>
                            <td><i class="fas fa-file"></i> show details</td>
                        </tr>
                        <?php 
                        foreach($allprof as $prof)
                        {
                            $stmt = $con->prepare("SELECT * FROM prof WHERE prof_id  = ?");
                            $stmt->execute(array($prof["prof_id"]));
                            $allinfoprof = $stmt->fetch();

                            $stmt = $con->prepare("SELECT * FROM online_exam WHERE prof_id = ? AND exam_status = ?");
                            $stmt->execute(array($prof["prof_id"],1));
                            $count = $stmt->rowCount();
                            $allexam = $stmt->fetch();
                            ?>
                            <tr>
                                <td><?php echo $allinfoprof["prof_id"] ?></td>
                                <td><?php echo $allinfoprof["prof_name"] ?></td>
                                <td><?php if($allinfoprof["gender"] == 1){echo "Male";}else{echo "Female";} ?></td>
                                <td><?php if($count == 0){echo "<button  href='#' disable class='examshow alert alert-danger'>No Exam Until</button>" ;}else{echo "<a href='details_exam.php?prof_id=$allinfoprof[prof_id]' class='examshow alert alert-success'>Show Exams</a>";} ?></td>
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
