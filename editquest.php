<?php
$namepage = "prof";
session_start();
include 'init.php';
if (isset($_SESSION['prof_id']) && is_numeric($_SESSION['prof_id'])) {
    if (isset($_GET['quest']) && is_numeric($_GET["quest"])) {

        $profid = $_SESSION['prof_id'];
        $qu = $_GET['quest'];

        $stmt = $con->prepare("SELECT * FROM options WHERE quest_id = ?");
        $stmt->execute(array($qu));
        $count = $stmt->rowCount();
        $alloption = $stmt->fetchAll();

        $stmt = $con->prepare("SELECT * FROM quest_exam WHERE quest_id = ?");
        $stmt->execute(array($qu));
        $quest = $stmt->fetch();
        if ($count > 0) {
            include $navprof;

            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                $formerr = array();
                $titelquest = $_POST["quest_title"];
                foreach ($alloption as $opt) {
                    $option = filter_var($_POST["option_" . $opt["option_id"]], FILTER_SANITIZE_STRING);
                    $stmt = $con->prepare("UPDATE options SET option_title = ? WHERE option_id  = ?");
                    $stmt->execute(array($option, $opt["option_id"]));
                }
                $rightoption = $_POST["roption"];

                if (empty($titelquest)) {
                    $formerr[] = "question title can't be <b>empty</b>";
                }
                if (empty($rightoption)) {
                    $formerr[] = "right option can't be <b>empty</b>";
                }

                if (empty($formerr)) {
                    $stmt1 = $con->prepare("UPDATE quest_exam SET question_title = ? , anwser_quest = ? WHERE quest_id  = ?");
                    $stmt1->execute(array($titelquest, $rightoption, $qu));
                    if ($stmt1) {
                    ?>
                        <div class="alert alert-success text-center">This Question Is Edited Successfully</div>
                    <?php
                        header("Refresh:2;viewQuest.php?exam_id=" . $quest["online_exam_id"]);
                    }
                } else {
                    foreach ($formerr as $err) {
                    ?>
                        <div class="alert alert-dnager"><?php echo $err; ?></div>
            <?php
                    }
                }
            }


            ?>
            <div class="allcou">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table_cou">
                                <tr>
                                    <td>Question title</td>
                                    <td>option_A</td>
                                    <td>option_B</td>
                                    <td>option_C</td>
                                    <td>option_D</td>
                                    <td>Option Right</td>
                                </tr>
                                <tr>
                                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?quest=" . $quest['quest_id']; ?>">
                                        <td> <input type="text" value="<?php echo $quest["question_title"]; ?>" name="quest_title" class='form-control' required></td>
                                        <?php
                                        foreach ($alloption as $opt) {
                                        ?>
                                            <td><input type="text" value="<?php echo $opt["option_title"]; ?>" name="option_<?php echo $opt['option_id']; ?>" class='form-control' required></td>
                                        <?php
                                        }
                                        ?>
                                        <td>
                                            <select name="roption" id="" class='form-control' required>
                                                <option value="1" <?php if ($quest['anwser_quest'] == 1) {
                                                                        echo "selected";
                                                                    } ?>>A</option>
                                                <option value="2" <?php if ($quest['anwser_quest'] == 2) {
                                                                        echo "selected";
                                                                    } ?>>B</option>
                                                <option value="3" <?php if ($quest['anwser_quest'] == 3) {
                                                                        echo "selected";
                                                                    } ?>>C</option>
                                                <option value="4" <?php if ($quest['anwser_quest'] == 4) {
                                                                        echo "selected";
                                                                    } ?>>D</option>
                                            </select>
                                        </td>
                                </tr>
                            </table>
                            <button type="submit" class='btn btn-success'> Save All Changes </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<?php
            include $footer;
        } else {
            header("location:viewQuest.php");
        }
    } else {
        header("location:loginprof.php");
    }
} else {
    header("location:loginprof.php");
}
