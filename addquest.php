<?php
$namepage = "Add Questions";
session_start();
include 'init.php';
if (isset($_SESSION['prof_id']) && is_numeric($_SESSION['prof_id'])) {
    if (isset($_GET['exam_id']) && is_numeric($_GET["exam_id"])) {

        $profid = $_SESSION['prof_id'];
        $exam_id = $_GET['exam_id'];

        $stmt = $con->prepare("SELECT * FROM online_exam WHERE exam_id = ? ");
        $stmt->execute(array($exam_id));
        $count = $stmt->rowCount();
        $examdet = $stmt->fetch();

        if ($count > 0) {

            if($_SERVER["REQUEST_METHOD"] == 'POST')
            {
                for ($i = 1; $i <= $examdet["total_ques"]; $i++) {

                    $quest = filter_var($_POST['quest_'.$i],FILTER_SANITIZE_STRING);
                    $optionright = filter_var($_POST["optionrght_".$i] , FILTER_SANITIZE_NUMBER_INT);

                    $stmt = $con->prepare("INSERT INTO quest_exam (online_exam_id ,question_title ,anwser_quest) VALUES(:o , :q , :a)");
                    $stmt->execute(array(
                        'o' => $exam_id ,
                        'q' => $quest ,
                        'a' => $optionright ,
                    ));
                }

                header("location:viewQuest.php?exam_id=".$exam_id);
            }
            include $navprof;
?>
            <div class="allcou">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="POST">
                            <?php
                            for ($i = 1; $i <= $examdet["total_ques"]; $i++) {
                            ?>
                                <table class="table table-bordered table_cou">
                                    <tr>
                                        <td>Q<?php echo  $i; ?></td>
                                        <td>right option</td>
                                    </tr>
                                    <tr>
                                    <td><input type="text" placeholder="type Question <?php echo $i; ?>" class='form-control' name="quest_<?php echo $i; ?>" required></td>
                                    <td>
                                    <select name="optionrght_<?php echo $i; ?>" id="" class='form-control'>
                                    <option value="1">A</option>
                                    <option value="2">B</option>
                                    <option value="3">C</option>
                                    <option value="4">D</option>
                                    </select>
                                    </td>
                                    </tr>
                                </table>
                            <?php
                            }
                            ?>
                            <button type="submit" class='btn btn-success'>Save All Changes</button>
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
