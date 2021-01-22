<?php
$namepage = "Add exam";
session_start();
include 'init.php';
if (isset($_SESSION['prof_id']) && is_numeric($_SESSION['prof_id'])) {
    $profid = $_SESSION['prof_id'];
    include $navprof;
    $stmt = $con->prepare("SELECT * FROM online_exam WHERE prof_id  =  ?");
    $stmt->execute(array($profid));
    $allexam = $stmt->fetchAll();
?>
    <div class="allcou">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 style="font-weight: bold; margin-bottom:1%">Add New Exam</h2>
                    <form id="addexam" method="POST">
                        <div class="panelbody">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        Title Exam:
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" name="examtitle" placeholder="Type Title Exam" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                    Total Question:
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="number" max='10' min='2' value="4"  name="totalquest"  class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                    Right answer mark:
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="number" max='5' min='1' step="0.25" value="1.5" name="markright"  class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                    Right wrong mark:
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="number" max='5' min='0.5' step="0.25" value="1" name="markwrong"  class="form-control">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="action" value="addexam">
                            <button style="margin-top: 3%;margin-bottom: 3%;" type="submit" class="btn btn-info btn-block">Submit</button>
                            <div id="addex"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    include $footer;
} else {
    header("location:loginprof.php");
}
