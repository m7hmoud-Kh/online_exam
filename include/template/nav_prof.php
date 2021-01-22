<?php
include 'conn.php';

$stmt = $con->prepare("SELECT * FROM feedback WHERE fed_status = 0 AND prof_id = ?");
$stmt->execute(array($_SESSION["prof_id"]));
$count = $stmt->rowCount();
$allfeed  = $stmt->fetchAll();

?>
<nav class="navstudent">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">

                <div class="dropdown">
                    <button class="dropbtn"> <i class="fa fa-user"></i> <b> <?php echo ucwords($_SESSION["prof_name"]); ?> </b></button>
                    <div class="dropdown-content">
                        <a href="prof_exam.php"><i class="fa fa-home"></i> Home</a>
                        <a href="change_password.php"><i class="fa fa-lock"></i> change password </a>
                        <a href="logout.php"> <i class="fas fa-door-open"></i> logout </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                            <div class="dropemail">
                                <div class="email"> <?php echo $count ; ?> </div>
                                <div><i class="fas fa-envelope-open-text"></i> </div>
                                <div class="dropmenu_con">
                                    <div class="panel">
                                        <?php 
                                        if($count > 0){
                                            ?>
                                        <div class="panel-head">
                                            <i class="fas fa-bolt"></i> emails
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="panel-body">
                                            <?php
                                            foreach ($allfeed as $feed) {
                                                $stmt = $con->prepare("SELECT exam_title FROM online_exam WHERE exam_id =?");
                                                $stmt->execute(array($feed["exam_id"]));
                                                $exam = $stmt->fetch();

                                                $stmt = $con->prepare("SELECT username FROM student WHERE stu_id  = ?");
                                                $stmt->execute(array($feed["stud_id"]));
                                                $student = $stmt->fetch();

                                                ?>
                                                <a href="resultexam.php?exam_id=<?php echo $feed["exam_id"]; ?>" > <b> <?php echo $student["username"]; ?></b> has finish <b> <?php echo $exam["exam_title"]; ?> </b> exam at <small><?php echo $feed["fed_data"]; ?></small> </a>
                                                <?php 
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>