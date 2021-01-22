<?php
session_start();
$namepage = "Login page";
include "init.php";
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $formerr = array();

    $ID = $_POST["id"];
    $pass = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

    if (empty($ID)) {
        $formerr[] = '<b>ID</b> can"t be empty';
    }
    if (empty($pass)) {
        $formerr[] = '<b>password</b> can"t be empty';
    }
    if (empty($formerr)) {
        $stmt = $con->prepare("SELECT * FROM student WHERE ID = ? AND `password` = ?");
        $stmt->execute(array($ID, $pass));
        $allinfo = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $_SESSION["id"] = $ID;
            $_SESSION["stu_id"] = $allinfo["stu_id"];
            header("location:index.php");
        } else {
            $stmt = $con->prepare("SELECT ID FROM  student WHERE ID = ?");
            $stmt->execute(array($ID));
            $count = $stmt->rowCount();
            if ($count == 0) {
                $formerr[] = 'ID not correct..!';
            } else {
                $stmt = $con->prepare("SELECT * FROM student WHERE ID = ? AND old_pass = ?");
                $stmt->execute(array($ID,$pass));
                $info = $stmt->fetch();
                $count = $stmt->rowCount();
                if ($count > 0) {
                    $formerr[] = 'Password is Old that update on ' . $info["last_up"];
                }
                else {
                    $formerr[] = 'Password not correct..!';
                }
            }
        }
    }
}
?>
<div class="container2">
    <div class="img"> </div>
    <div class="login-content">
        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" class="loginstudent">
            <img src="../online_exam/include/template/layout/img/avatar.svg">
            <h2 class="title">Welcome to Exams</h2>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>

                <div class="div">
                    <input name="id" type="text" class="input" placeholder="ID" autocomplete="off">
                </div>
            </div>
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <input type="password" name="password" class="input" placeholder="password" autocomplete="new-password">
                </div>
            </div>
            <a class="login" href="loginprof.php">Are you professor?</a>
            <a class="login" href="#">Forgot Password?</a>
            <input type="submit" class="btn" name="add" value="Login">
            <?php
            if (!empty($formerr)) {
                foreach ($formerr as $err) {
            ?>
                    <div class="alert alert-danger text-center"><?php echo $err; ?></div>
            <?php
                }
            }
            ?>
        </form>
    </div>
</div>
<?php
include $footer;
?>


