<?php require_once("assets/Sessions.php"); ?>
<?php require_once("assets/Functions.php"); ?>
<?php
date_default_timezone_set("Asia/Kolkata");
$DateTime = date("d-m-Y")."<br>".date("h:i:s A");
$User_Id = $_SESSION["User_Id"];
$Login_time = $_SESSION["Login_time"];
$Query="UPDATE history SET logouttime='$DateTime' WHERE userid='$User_Id' AND logintime='$Login_time'";
$Execute=mysql_query($Query);
$_SESSION["User_Id"]=null;
session_destroy();
Redirect_to("index.php");
?>