<?php require_once("DB.php"); ?>
<?php require_once("Sessions.php"); ?>
<?php
function Redirect_to($New_Location)
{
    header("Location:".$New_Location);
	exit;
}

function Login_Attempt($Username,$Password)
{
    $SelectDB;
    $Query="SELECT * FROM registration
    WHERE username='$Username' AND password='$Password'";
    $Execute=mysql_query($Query);
    $admin=mysql_fetch_assoc($Execute);
    mysql_free_result($Execute);
    if($admin)
    {
	return $admin;
    }
    else
    {
	return null;
    }
}
function Login()
{
    if(isset($_SESSION["User_Id"]))
    {
	return true;
    }
}
 function Confirm_Login()
 {
    if(!Login())
    {
	$_SESSION["ErrorMessage"]="Login Required ! ";
	Redirect_to("index.php");
    }
 }
 function Calculate($op1,$op2,$opr)
 {
 
 }
?>