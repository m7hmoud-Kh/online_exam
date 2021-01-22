<?php
session_start();
include "conn.php";
if($_SERVER["REQUEST_METHOD"] == 'POST')
{

    if($_POST["action"] == 'changepass')
    {
        $stu_id = $_SESSION["stu_id"];

        $stmt = $con->prepare("SELECT * FROM student WHERE stu_id = ?");
        $stmt->execute(array($stu_id));
        $allinfo = $stmt->fetch();
        $last_us = date("Y-M d");
        $formerr = array();

        $oldpass = filter_var($_POST["oldpass"],FILTER_SANITIZE_STRING);
        $newpass = filter_var($_POST["newpass"],FILTER_SANITIZE_STRING);
        $newpass2 = filter_var($_POST["newpass2"],FILTER_SANITIZE_STRING);

        if(empty($oldpass))
        {
            $formerr[] = "old password can't be <b>empty</b>";
        }
        if(empty($newpass))
        {
            $formerr[] = "new password can't be <b>empty</b>";
        }
        if(!empty($newpass))
        {
            if($newpass !=  $newpass2)
            {
                $formerr[] = "password dosen't <b>match</b>";
            }
        }
        if(empty($formerr))
        {
            if($allinfo["password"] != $oldpass)
            {
                $formerr[] = "old password is <b>incorrect</b>";
            }
            else
            {
                $stmt = $con->prepare("UPDATE student SET `password` = ? , old_pass = ? , last_up = ?  WHERE stu_id  = ?");
                $stmt->execute(array($newpass,$oldpass, $last_us,$stu_id));
                $count = $stmt->rowCount();
                if($count > 0)
                {
                    ?>
                    <div class="alert alert-success">password changed ...!</div>
                    <?php
                }
            }
        }
        if(!empty($formerr))
        {
            foreach($formerr as $err)
            {
                ?>
                <div class="alert alert-danger"><?php echo $err; ?></div>
                <?php
            }
        }
        
    }
    if($_POST["action"] == 'chnagepassprof')
    {
        $profid = $_SESSION["prof_id"];

        $stmt = $con->prepare("SELECT * FROM prof WHERE prof_id = ?");
        $stmt->execute(array($profid));
        $allinfo = $stmt->fetch();

        $formerr = array();

        $oldpass = filter_var($_POST["oldpass"],FILTER_SANITIZE_STRING);
        $newpass = filter_var($_POST["newpass"],FILTER_SANITIZE_STRING);
        $newpass2 = filter_var($_POST["newpass2"],FILTER_SANITIZE_STRING);

        if(empty($oldpass))
        {
            $formerr[] = "old password can't be <b>empty</b>";
        }
        if(empty($newpass))
        {
            $formerr[] = "new password can't be <b>empty</b>";
        }
        if(!empty($newpass))
        {
            if($newpass !=  $newpass2)
            {
                $formerr[] = "password dosen't <b>match</b>";
            }
        }
        if(empty($formerr))
        {
            if($allinfo["prof_pass"] != $oldpass)
            {
                $formerr[] = "old password is <b>incorrect</b>";
            }
            else
            {
                $stmt2 = $con->prepare("UPDATE prof SET prof_pass = ?  WHERE prof_id  = ?");
                $stmt2->execute(array($newpass,$profid));
                $count = $stmt2->rowCount();
                if($count > 0)
                {
                    ?>
                    <div class="alert alert-success">password changed ...!</div>
                    <?php
                }
            }
        }
        if(!empty($formerr))
        {
            foreach($formerr as $err)
            {
                ?>
                <div class="alert alert-danger"><?php echo $err; ?></div>
                <?php
            }
        }
        
    }

    if($_POST['action'] == 'addexam')
    {
        $profid = $_SESSION["prof_id"];

        $stmt = $con->prepare("SELECT * FROM prof WHERE prof_id = ?");
        $stmt->execute(array($profid));
        $allinfo = $stmt->fetch();


        $time       =  date("d-M Y") . ' at ' . date("h:i A");
        $extitle    =  strtolower(filter_var($_POST["examtitle"],FILTER_SANITIZE_STRING));
        $totalquest =  filter_var($_POST["totalquest"],FILTER_SANITIZE_NUMBER_INT);
        $markright  =  $_POST["markright"];
        $markwrong  =  $_POST["markwrong"];

        $stmt2 = $con->prepare("SELECT * FROM online_exam WHERE prof_id = ?");
        $stmt2->execute(array($profid));
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
            $stmt3 = $con->prepare("INSERT INTO online_exam (prof_id,exam_title,total_ques,marks_per_right_answer,marks_per_wrong_answer,creat_on)
             VALUES (:p,:e,:t,:mr,:mw,:co)");
            $stmt3->execute(array(
                'p'  =>  $profid ,
                'e'  =>  $extitle  ,
                't'  =>  $totalquest ,
                'mr' =>  $markright ,
                'mw' =>  $markwrong ,
                'co' =>  $time 
            ));
            if($stmt3)
            {
                ?>
                <div class="alert alert-success" style="text-transform: capitalize;">you have submit exam successfully</div>
                <?php 
            }
        }
    
    }




}