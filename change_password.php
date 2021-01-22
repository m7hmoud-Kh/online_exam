<?php
$namepage = "change password";
session_start();
include 'init.php';
if (isset($_SESSION["stu_id"]) && is_numeric($_SESSION["stu_id"])) {

    $stu_id = $_SESSION["stu_id"];

    $stmt = $con->prepare("SELECT * FROM student WHERE stu_id = ?");
    $stmt->execute(array($stu_id));
    $allinfo = $stmt->fetch();
    include $nav;
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="allcou">
                    <div class="panel">
                        <div class="panelhead">
                            <i class="fa fa-lock"></i> change password
                        </div>
                        <div class="panelbody">
                            <form method="POST" id="chnagepass">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label for="olpass" class="text-center">current password : </label>
                                        </div>
                                        <div class="col-lg-7">
                                            <input type="password" id="olpass" class="form-control" name="oldpass" autocomplete="new-password" placeholder="current password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label for="newpass" class="text-center">new password : </label>
                                        </div>
                                        <div class="col-lg-7">
                                            <input type="password" id="newpass" class="form-control" name="newpass" placeholder="new password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label for="conpass" class="text-center">confirm new password: </label>
                                        </div>
                                        <div class="col-lg-7">
                                            <input type="password" id="conpass" class="form-control" name="newpass2" placeholder="confirm new  password">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="action" value="changepass">
                                <button type="submit" class="btn btn-success btn-block"> save </button>
                                <div id="result"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>

<?php
    include $footer;
} 
elseif (isset($_SESSION["prof_id"]) && is_numeric($_SESSION["prof_id"])) {
    include $navprof;
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="allcou">
                    <div class="panel">
                        <div class="panelhead">
                            <i class="fa fa-lock"></i> change password
                        </div>
                        <div class="panelbody">
                            <form method="POST" id="chnagepassprof">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label for="olpass" class="text-center">current password : </label>
                                        </div>
                                        <div class="col-lg-7">
                                            <input type="password" id="olpass" class="form-control" name="oldpass" autocomplete="new-password" placeholder="current password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label for="newpass" class="text-center">new password : </label>
                                        </div>
                                        <div class="col-lg-7">
                                            <input type="password" id="newpass" class="form-control" name="newpass" placeholder="new password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label for="conpass" class="text-center">confirm new password: </label>
                                        </div>
                                        <div class="col-lg-7">
                                            <input type="password" id="conpass" class="form-control" name="newpass2" placeholder="confirm new  password">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="action" value="chnagepassprof">
                                <button type="submit" class="btn btn-success btn-block"> save </button>
                                <div id="result"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
<?php
    include $footer;
} else {
    header("location:loginstudent.php");
}
