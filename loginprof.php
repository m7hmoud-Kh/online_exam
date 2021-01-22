<?php
$namepage = 'login page';
session_start();
include 'init.php';

if($_SERVER["REQUEST_METHOD"] == 'POST')
{
	$formerr = array();
	$user = $_POST["username"];
	$pass = $_POST["password"];

	if(empty($user))
	{
		$formerr[] = "username can't be <b>Empty</b>";
	}
	if(empty($pass))
	{
		$formerr[] = "password can't be <b>Empty</b>";
	}
	if(empty($formerr))
	{
		$stmt = $con->prepare("SELECT * FROM prof WHERE prof_name = ? AND  prof_pass = ?");
		$stmt->execute(array($user,$pass));
		$count =$stmt->rowCount();
		$allinfo = $stmt->fetch();
		if($count == 0)
		{
			$formerr[] = "password <b>OR</b> username is <b>wrong</b>";
		}
		else
		{
			$_SESSION["prof_id"] = $allinfo["prof_id"];
			$_SESSION["prof_name"] = $allinfo["prof_name"];
			header("location:index.php"); 
		}
	}
}
?>
<div class="container2">
		<div class="img"> </div>
		<div class="login-content">
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="loginstudent">
				<img src="../online_exam/include/template/layout/img/prof.svg">
				<h2 class="title">Welcome professor</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
             
           		   <div class="div">
           		   		<input name="username" type="text" class="input" placeholder="Username" autocomplete="off" required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<input type="password" name="password" class="input" placeholder="password" autocomplete="new-password" required>
            	   </div>
            	</div>
            	<a class="login" href="loginstudent.php">Are you Student?</a>
              <a class="login" href="#">Forgot Password?</a>
				<input type="submit" class="btn" name ="add" value="Login">
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