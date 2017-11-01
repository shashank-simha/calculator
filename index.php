<?php require_once("assets/DB.php"); ?>
<?php require_once("assets/Sessions.php"); ?>
<?php require_once("assets/Functions.php"); ?>
<?php
if(isset($_SESSION["User_Id"]))
{
 Redirect_to("Home.php");	
}
else{
if(isset($_POST["Login"])){
$Username=mysql_real_escape_string($_POST["Username"]);
$Password=mysql_real_escape_string($_POST["Password"]);

if(empty($Username)||empty($Password))
{
	$_SESSION["ErrorMessage"]="All Fields must be filled out";
	Redirect_to("index.php");	
}
else
 {
	$Found_Account=Login_Attempt($Username,$Password);
	$_SESSION["User_Id"] =$Found_Account["id"];
	$_SESSION["Username"] =$Found_Account["username"];
	date_default_timezone_set("Asia/Kolkata");
	$DateTime = date("d-m-Y")."<br>".date("h:i:s A");
	$_SESSION["Login_time"] = $DateTime;
	if($Found_Account)
	   {
     	$_SESSION["SuccessMessage"]="Welcome  {$_SESSION["Username"]} ";
      	Redirect_to("Home.php");	
       }
	else
       {
		$_SESSION["ErrorMessage"]="Invalid Username / Password";
    	Redirect_to("index.php");
    	}
  }	
 }	
 else if (isset($_POST["SignUp"])){
 $Name=mysql_real_escape_string($_POST["Fullname"]);
 $Email =mysql_real_escape_string($_POST["email"]);
 $DOB =mysql_real_escape_string($_POST["dob"]);
 $Age =mysql_real_escape_string($_POST["age"]);
 $Edn =mysql_real_escape_string($_POST["edn"]);
 $Gender =mysql_real_escape_string($_POST["gender"]);
 $Username =mysql_real_escape_string($_POST["NewUsername"]);
 $Password =mysql_real_escape_string($_POST["NewPassword"]);
 $ConfirmPassword =mysql_real_escape_string($_POST["ConfirmPassword"]);
 date_default_timezone_set("Asia/Kolkata");
 $DateTime = date("d-m-Y")."<br>".date("h:i:s A");
 //check for availability of username
 $UsernameCheckQuery="SELECT * FROM registration where username='$Username'";
 $UsernameCheckExecute =mysql_query($UsernameCheckQuery);
 $UsernameArray=mysql_fetch_array($UsernameCheckExecute);
 mysql_free_result($UsernameCheckExecute);
 $UsernameExist=$UsernameArray["id"];
 $Usernameavailable=null;
 if($UsernameExist)
 {
 $Usernameavailable="NO";
 }
 //
 if(empty($Name)||empty($Email)||empty($DOB)||empty($Age)||empty($Edn)||empty($Gender)||empty($Username)||empty($Password)||empty($ConfirmPassword)){
 $_SESSION["ErrorMessage"]="All Fields must be filled out";
 Redirect_to("index.php");	
 }
 elseif(!empty($Usernameavailable))
 {
 $_SESSION["ErrorMessage"]="User Name already exist.";
 Redirect_to("index.php");	
 }
 elseif(strlen($Password)<4)
 {
 $_SESSION["ErrorMessage"]="Password length is too short";
 Redirect_to("index.php");
 }
 elseif(strlen($Password)>100)
 {
 $_SESSION["ErrorMessage"]="Password length is too long";
 Redirect_to("index.php");
 }
 elseif($Password!==$ConfirmPassword)
 {
 $_SESSION["ErrorMessage"]="Password / ConfirmPassword does not match";
 Redirect_to("index.php");
 }
 else
 {
  global $SelectDB;
  $Query="INSERT INTO registration(name,email,dob,age,edn,gender,username,password)
  VALUES('$Name','$Email','$DOB','$Age','$Edn','$Gender','$Username','$Password')";
  $Execute=mysql_query($Query);
  if($Execute)
  {
  $Query="SELECT * from registration WHERE username='$Username'";
  $Execute=mysql_query($Query);
  while($DataRows=mysql_fetch_array($Execute)){
  $_SESSION["User_Id"]=$DataRows["id"];
  }
  $_SESSION["Username"]=$Username;
  date_default_timezone_set("Asia/Kolkata");
  $DateTime = date("d-m-Y")."<br>".date("h:i:s A");
  $_SESSION["Login_time"] = $DateTime;
  $_SESSION["SuccessMessage"]="Registered successfully";
  Redirect_to("Home.php");
  }
  else
  {
  $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
  Redirect_to("index.php");		
  }	
 }
 }
}
?>

<!DOCTYPE>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html>
	<head>
		<title>Log-in</title>
                <link rel="stylesheet" href="CSS/bootstrap.min.css">
                <script src="js/jquery-3.2.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
<style>
	.FieldInfo{
    color: rgb(251, 174, 44);
    font-family: Bitter,Georgia,"Times New Roman",Times,serif;
    font-size: 1.2em;
}
body{
	background-color: #ffffff;
}
</style>               
</head>
<body>
<div class="row container-fluid">
<div class="col-sm-offset-3 col-sm-6">
<br><br><br><br>
<h2>Welcome</h2>
<?php
 echo ErrorMessage();
 echo SuccessMessage();
?>
<div id="login" >
<form action="index.php" method="post">
	<fieldset>
	<div class="form-group">
	<label for="Username"><span class="FieldInfo">UserName:</span></label>
	<div class="input-group input-group-lg">
	<span class="input-group-addon">
	<span class="glyphicon glyphicon-envelope text-primary"></span>
	</span>
	<input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
	</div>	
	</div>
	
	<div class="form-group">
	<label for="Password"><span class="FieldInfo">Password:</span></label>
	<div class="input-group input-group-lg">
	<span class="input-group-addon">
	<span class="glyphicon glyphicon-lock text-primary"></span>
	</span>
	<input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
	</div>
	</div>
	<br>
	<input class="btn btn-info btn-block" type="Submit" name="Login" value="Login"><br>
    <div class="text-center text-primary" id="signupbtn" >Sign up</div>
	</fieldset><br>
</form>
</div>
<div id="signup" >
	<form action="index.php" method="post">
	<fieldset>
	<div class="form-group">
	<label for="Fullname"><span class="FieldInfo">Name:</span></label>
	<input class="form-control" type="text" name="Fullname" id="Fullname" placeholder="Fullname" required="required" >
	</div>
	<div class="form-group">
	<label for="email"><span class="FieldInfo">Email:</span></label>
	<input class="form-control" type="email" name="email" id="email" placeholder="example@ex.com" required="required">
	</div>
	<div class="form-group">
	<label for="dob"><span class="FieldInfo">D O B:</span></label>
	<input class="form-control" type="text" name="dob" id="dob" required="required">
	</div>
	<div class="form-group">
	<label for="age"><span class="FieldInfo">Age:</span></label>
	<input class="form-control" type="number" name="age" id="age">
	</div>
	<div class="form-group">
	<label for="edn"><span class="FieldInfo">Education:</span></label>
	<input class="form-control" type="text" name="edn" id="edn" required="required">
	</div>
	<div class="form-group">
	<label for="gender"><span class="FieldInfo">Gender:</span></label>
	<div class="text-justify text-info" >Male<input type="radio" id="male" name="gender" value="male" style="margin-right:10%;" >Female<input type="radio" id="female" name="gender" value="female"></div>
	</div>
    <div class="form-group">
    <label for="NewUsername"><span class="FieldInfo">User Name:</span></label>
    <input class="form-control" type="text" name="NewUsername" id="NewUsername" placeholder="User name" required="required">
    </div>
    <div class="form-group">
    <label for="NewPassword"><span class="FieldInfo">Password:</span></label>
    <input class="form-control" type="Password" name="NewPassword" id="NewPassword" placeholder="Password" required="required">
    </div>
    <div class="form-group">
    <label for="ConfirmPassword"><span class="FieldInfo">Confirm Password:</span></label>
    <input class="form-control" type="Password" name="ConfirmPassword" id="ConfirmPassword" placeholder=" Retype same Password" required="required">
    </div>
	<br>
	<input class="btn btn-info btn-block" type="Submit" name="SignUp" value="Sign Up"><br>
	<div class="text-center text-primary" id="loginbtn" >Login</div>
	</fieldset><br>
	</form>
</div>
</div> <!-- Ending of Main Area-->	
</div> <!-- Ending of Row-->	
</body>
<script type="text/javascript">
$(function() {
var login = $("#login");
var signup = $("#signup");
signup.hide();
$("#signupbtn").click(function(){
login.hide();
signup.show();
});
$("#loginbtn").click(function(){
signup.hide();
login.show();
});
});
</script>
</html>