<?php
    session_start();
if (isset($_SESSION["stu_id"]) && is_numeric($_SESSION["stu_id"])) {
    session_unset();
    session_destroy();
    header("location:loginstudent.php");
    exit();
}
elseif(isset($_SESSION["prof_id"]) && is_numeric($_SESSION["prof_id"]))
{
    session_unset();
    session_destroy();
    header("location:loginprof.php");
    exit();
}
