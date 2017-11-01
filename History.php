<!DOCTYPE html>
<?php require_once("assets/DB.php"); ?>
<?php require_once("assets/Sessions.php"); ?>
<?php require_once("assets/Functions.php"); ?>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<link rel="stylesheet" href="CSS/bootstrap.min.css">
                <script src="js/jquery-3.2.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
<ul class="nav navbar-nav list-inline" >
<li><a href="Home.php" >Home</a></li>
<li><a href="calc2.php" >Calculator</a></li>
<li><a href="History.php" >History</a></li>
<li><a href="Logout.php" >Logout</a></li>
</ul>
</nav>
<h1 class="text-center text-capitalize" >History</h1>
<div class="table-responsive" >
<table class="table table-striped table-bordered table-hover" >
<tr>
<th>Login time</th>
<th>Operand 1</th>
<th>Operand 2</th>
<th>Operator</th>
<th>Result</th>
<th>Logout time</th>
</tr>
<?php
 global $SelectDB;
 $User_Id = $_SESSION["User_Id"];
 $Query="SELECT * from history WHERE userid='$User_Id'";
 $Execute=mysql_query($Query);
 $Previous1=0;
 $Previous2=0;
 while($DataRows=mysql_fetch_array($Execute)){
 $Id= $DataRows["id"];
 $Login_time = $DataRows["logintime"];
 $Logout_time = $DataRows["logouttime"];
 //check number of entries in same login time
 $QueryTotal="SELECT COUNT(*) FROM history WHERE userid='$User_Id' AND logintime='$Login_time'";
 $ExecuteTotal=mysql_query($QueryTotal);
 $RowsTotal=mysql_fetch_array($ExecuteTotal);
 mysql_free_result($ExecuteTotal);
 $Total=array_shift($RowsTotal);
 $Operand1 = $DataRows["operand1"];
 $Operand2 = $DataRows["operand2"];
 $Operation = $DataRows["operation"];
 $Result = $DataRows["result"];
 ?>
<tr>
<?php
if($Login_time!==$Previous1){
?>
<td rowspan="<?php echo $Total;?>"><?php echo $Login_time; ?></td>
<?php
$Previous1=$Login_time;
}
?>
<td><?php echo $Operand1; ?></td>
<td><?php echo $Operand2; ?></td>
<td><?php echo $Operation; ?></td>
<td><?php echo $Result; ?></td>
<?php
if($Logout_time!==$Previous2){
?>
<td rowspan="<?php echo $Total;?>"><?php echo $Logout_time; ?></td>
<?php
$Previous2=$Logout_time;
}
?>
</tr>
<?php }
mysql_free_result($Execute);
?>
</table>
</div>
</body>
</html>