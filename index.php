<?php
$namepage = "Welcome";
session_start();
include 'init.php';
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $stmt = $con->prepare("SELECT * FROM student WHERE ID = ?");
    $stmt->execute(array($id));
    $allinfo = $stmt->fetch();
?>

    <div class="container2">
        <div class="img"> </div>
        <div class="login-content">
            <form method="post">
                <img src="../online_exam/include/template/layout/img/avatar.svg">
                <p style="color:salmon;font-size:20px;font-family:calibri;"> Welcome <?php echo $allinfo["username"]; ?> </p>
        </div>
        </form>
    </div>
<?php
    header("Refresh:2;exam.php");
} elseif (isset($_SESSION["prof_id"]) && is_numeric($_SESSION["prof_id"])) {
    $prof_id = $_SESSION["prof_id"];

    $stmt = $con->prepare("SELECT * FROM prof WHERE prof_id  = ?");
    $stmt->execute(array($prof_id));
    $allinfo = $stmt->fetch();

?>

    <div class="container2">
        <div class="img"> </div>
        <div class="login-content">
            <form method="post">
                <img src="../online_exam/include/template/layout/img/prof.svg">
                <p style="color:salmon;font-size:30px;font-family:calibri;font-wight=bold"> Welcome <?php if($allinfo["gender"] == 1){echo "Mr/ ";}else{echo "Mrs/ "; }  ?> <?php echo $_SESSION["prof_name"];?> </p>
        </div>
        </form>
    </div>
<?php
    header("Refresh:2;prof_exam.php");
} else {
    header("location:loginstudent.php");
}
