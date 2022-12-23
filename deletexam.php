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
            $stmt2 = $con->prepare("CALL Remove(?,?,?)");
            $stmt2->execute(array('quest_exam','online_exam_id',$examid));
            $stmt = $con->prepare("CALL Remove(?,?,?)");
            $stmt->execute(array('online_exam','exam_id',$examid));
            $count2 = $stmt->rowCount();
            if ($count2 > 0) {
?>
                <div class="alert alert-success text-center" style="margin-bottom:5%;" style="text-transform: capitalize;">you have Delete exam successfully</div>
<?php
                header("Refresh:1;prof_exam.php");
            }
        } else {
            header("location:loginprof.php");
        }
    } else {
        header("location:loginprof.php");
    }
} else {
    header("location:loginprof.php");
}
