<!DOCTYPE html>
<?php require_once("assets/DB.php"); ?>
<?php require_once("assets/Sessions.php"); ?>
<?php require_once("assets/Functions.php"); ?>
<?php Confirm_Login() ?>
<?php
$SelectDB;
$currentAdmin=$_SESSION["User_Id"];
$Query="SELECT * FROM registration WHERE id='$currentAdmin'";
$ExecuteQuery=mysql_query($Query);
while($DataRows=mysql_fetch_array($ExecuteQuery)){
	$Name = $DataRows["name"];		
	$Email = $DataRows["email"];		
	$DOB = $DataRows["dob"];		
	$Age = $DataRows["age"];		
	$Edn = $DataRows["edn"];		
	$Gender = $DataRows["gender"];		
}
mysql_free_result($ExecuteQuery);
?>
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
<?php
 echo ErrorMessage();
 echo SuccessMessage();
?>
<h1 class="text-center text-capitalize" >Personel details</h1>
<div class="table-responsive" >
<table class="table table-striped table-bordered table-hover" >
<tr>
<td>Name</td>
<td><?php echo $Name ;?></td>
</tr>
<tr>
<td>Email</td>
<td><?php echo $Email ;?></td>
</tr>
<tr>
<td>D.O.B</td>
<td><?php echo $DOB ;?></td>
</tr>
<tr>
<td>Age</td>
<td><?php echo $Age ;?></td>
</tr>
<tr>
<td>Education</td>
<td><?php echo $Edn ;?></td>
</tr>
<tr>
<td>Gender</td>
<td><?php echo $Gender ;?></td>
</tr>
</table>
</div>
</body>
</html>