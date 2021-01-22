<?php 
$host = "mysql:host=localhost;dbname=exam";
$user = "root";
$password = "";

try
{
    $con = new PDO($host,$user,$password);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo "not connected " . $e->getMessage();
}