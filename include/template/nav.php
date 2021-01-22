<?php
include 'conn.php';
$stmt = $con->prepare("SELECT * FROM prof_student WHERE stu_id = ?");
$stmt->execute(array($_SESSION["stu_id"]));
$allprof_id = $stmt->fetchAll();
$count  = $stmt->rowCount();
$x = 0;
foreach ($allprof_id as $prof_id) {
    $stmt = $con->prepare("SELECT * FROM `notification` WHERE con_status = 0 AND prof_id = ? AND std_id  = ?");
    $stmt->execute(array($prof_id["prof_id"] ,$_SESSION["stu_id"]));
    $count = $stmt->rowCount();
    $x = $x + $count;
}
?>
<nav class="navstudent">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" style="font-size: 30px; color:#16b681;margin-top: 0.5%;">
                <a href="exam.php" class="exam"> <i class="fa fa-home"></i> Home </a>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="dropmenu">
                            <div class="not"> <?php echo $x; ?> </div>
                            <div><i class="fas fa-bell"></i> </div>
                            <div class="dropmenu_con">
                                <div class="panel">
                                    <?php
                                    if ($x > 0) {
                                    ?>
                                        <div class="panel-head">
                                            <i class="fas fa-bolt"></i> Notification
                                        </div>
                                    <?php
                                    
                                    ?>
                                    <div class="panel-body">
                                        <?php
                                        foreach ($allprof_id as $prof_id) {
                                            $stmt = $con->prepare("SELECT `notification`.* , prof.* FROM `notification` INNER JOIN prof ON `notification`.prof_id = prof.prof_id WHERE `notification`.con_status = 0 AND `notification`.prof_id = ? GROUP BY `notification`.exam_id ORDER BY no_id DESC ");
                                            $stmt->execute(array($prof_id["prof_id"]));
                                            $allnot = $stmt->fetchAll();
                                            $count = $stmt->rowCount();
                                            if ($count > 0) {
                                                foreach ($allnot as $not) {
                                                    $stmt = $con->prepare("SELECT exam_id , exam_title FROM online_exam WHERE exam_id = ?");
                                                    $stmt->execute(array($not["exam_id"]));
                                                    $examtitle = $stmt->fetch();
                                        ?>
                                                    <a href="details_exam.php?prof_id=<?php echo $not["prof_id"]; ?>"> DR <b><?php echo $not["prof_name"]; ?></b> Added a <b> <?php echo   $examtitle["exam_title"];  ?> </b> exam  At <small> <?php echo $not["no_date"]; ?> </small> </a>
                                        <?php
                                                }
                                            }
                                        }
                                    
                                        ?>
                                    </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="dropdown">
                            <button class="dropbtn"> <i class="fa fa-user"></i> <b> <?php echo ucwords($allinfo["username"]); ?> </b></button>
                            <div class="dropdown-content">
                                <a href="change_password.php"> change password <i class="fa fa-lock"></i></a>
                                <a href="logout.php"> logout <i class="fas fa-door-open"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</nav>