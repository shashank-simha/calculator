<?php require_once("DB.php"); ?>
<?php require_once("Sessions.php"); ?>
<?php require_once("Functions.php"); ?>
<?php Confirm_Login() ?>
<?php
$response = array();
$Operand1 = $_POST['Operand1'];
$Operand2 = $_POST['Operand2'];
$Operation = $_POST['Operation'];
if(is_null($Operand1) || is_null($Operand2) || (!preg_match('/[0-9]+(\.[0-9]+)?/',$Operand1)) || (!preg_match('/[0-9]+(\.[0-9]+)?/',$Operand2)))
{
  $response["result"] = 'invalid inputs';
}
else if(strlen($Operand1)>=100 ||strlen($Operand2)>=100)
{
  $response["result"] = 'operand length error';
}
else
{
 $Login_time = $_SESSION["Login_time"];
 $User_Id = $_SESSION["User_Id"];
 if($Operand2==0 && $Operation=='/')
 {
  $Operation = 'divide';
  $response["result"] = 'error';
 }
 else if($Operation=='+')
 {
  $Operation = 'add';
  $response["result"] = $Operand1+$Operand2;
 }
 else if($Operation=='-')
 {
  $Operation = 'sub';
  $response["result"] = $Operand1-$Operand2;
 }
 else if($Operation=='*')
 {
  $Operation = 'multiply';
  $response["result"] = $Operand1*$Operand2;
 }
 else if($Operation=='/')
 {
  $Operation = 'divide';
  $response["result"] = $Operand1/$Operand2;
 }
 global $SelectDB;
 $result = $response["result"];
 $Query="INSERT INTO history(userid,operand1,operand2,operation,result,logintime)
 VALUES('$User_Id','$Operand1','$Operand2','$Operation','$result','$Login_time')";
 $Execute=mysql_query($Query);
 }	
 
 echo json_encode($response);
?>