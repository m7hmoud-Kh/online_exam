<?php
$namepage = "edit exam";
session_start();
include 'init.php';
if (isset($_SESSION['prof_id']) && is_numeric($_SESSION['prof_id'])) {

    $profid = $_SESSION['prof_id'];

    if (isset($_GET["exam_id"]) && is_numeric($_GET["exam_id"])) {


        $examid = $_GET["exam_id"];

        $stmt = $con->prepare("SELECT * FROM online_exam WHERE exam_id = ?");
        $stmt->execute(array($examid));
        $exam = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) {
            include $navprof;
            if($_SERVER["REQUEST_METHOD"] == 'POST')
            {

                $time       =  date("d-M Y") . ' at ' . date("h:i A");
                $extitle    =  strtolower(filter_var($_POST["examtitle"],FILTER_SANITIZE_STRING));
                $totalquest =  filter_var($_POST["totalquest"],FILTER_SANITIZE_NUMBER_INT);
                $markright  =  $_POST["markright"];
                $markwrong  =  $_POST["markwrong"];

        
                $stmt2 = $con->prepare("SELECT * FROM online_exam WHERE prof_id = ? AND exam_id != ?");
                $stmt2->execute(array($profid,$examid));
                $allexam = $stmt2->fetchAll();
        
                $exist = 0;
                foreach($allexam as $exam)
                {
                    if($exam["exam_title"] == $extitle)
                    {
                        $exist = $exist + 1;
                    }
                }
                if($exist == 1)
                {
                    ?>
                    <div class="alert alert-danger" style="text-transform: capitalize;"> this exam title is allready <b>exist<b> </div>
                    <?php 
                }
                else
                {
                    $stmt3 = $con->prepare("UPDATE online_exam SET prof_id = ? , exam_title = ? , total_ques = ? , marks_per_right_answer = ? , marks_per_wrong_answer = ? , creat_on = ? WHERE exam_id = ?");
                    $stmt3->execute(array($profid ,$extitle, $totalquest,$markright,$markwrong,$time,$examid));
                    if($stmt3)
                    {
                        ?>
                        <div class="alert alert-success" style="text-transform: capitalize;">you have Edit exam successfully</div>
                        <?php
                         header("Refresh:2;prof_exam.php"); 
                    }
                }
            }
?>
            <div class="allcou">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 style="font-weight: bold; margin-bottom:1%">Edit Exam</h2>
                            <form action="<?php echo $_SERVER["PHP_SELF"]."?exam_id=".$examid ; ?>" method="POST">
                                <div class="panelbody">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                Title Exam:
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" name="examtitle" placeholder="Type Title Exam" class="form-control" value="<?php echo $exam["exam_title"];  ?>">
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
                                                <input type="number" max='5' min='2' value="<?php echo $exam["total_ques"];?>" name="totalquest" class="form-control">
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
                                                <input type="number" max='5' min='1' step="0.25" value="<?php echo $exam["marks_per_right_answer"];?>" name="markright" class="form-control">
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
                                                <input type="number" max='5' min='0.5' step="0.25" value="<?php echo $exam["marks_per_wrong_answer"];?>" name="markwrong" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="action" value="addexam">
                                    <button style="margin-top: 3%;margin-bottom: 3%;" type="submit" class="btn btn-info btn-block">Submit</button>
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
    } else {
        header("location:loginprof.php");
    }
} else {
    header("location:loginprof.php");
}
