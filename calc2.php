<?php require_once("assets/DB.php"); ?>
<?php require_once("assets/Sessions.php"); ?>
<?php require_once("assets/Functions.php"); ?>

<?php Confirm_Login() ?>
<!DOCTYPE html>
<html>
<head>
<title>Calculator</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="CSS/bootstrap.min.css">
<script src="js/jquery-3.2.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style type="text/css">
</style>
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
<form class="col-xs-8 col-xs-offset-2" name="frm" method="POST" >
<span class="text-capitalize text-info" >operand 1</span>
<input type="number" id="opn1" class="form-control" name="opn1" >
<span class="text-capitalize text-info">operand 2</span>
<input type="number" id="opn2" class="form-control" name="opn2">
<span class="text-capitalize text-info" >operator</span>
<div class="row">
<div class="list-inline col-xs-8 col-xs-offset-2" id="ops" >
<button value="+" class="btn btn-lg btn-danger" id="add" >+</button>
<button value="-" class="btn btn-lg" id="sub">-</button>
<button value="*" class="btn btn-lg" id="mul">x</button>
<button value="/" class="btn btn-lg" id="div">÷</button>
</div>
</div>
<br>
<button id="calc" class="form-control btn-warning">Calculate</button>
<span class="text-capitalize text-primary">result</span>
<input disabled class="form-control" name="result"  >
</form>
</body>
<script type="text/javascript">
$(function() {
var opr = '+';
$("#ops").children().click(function(){
opr = this.value;
$("#ops").children().removeClass("btn-danger");  
$("#"+this.id).addClass("btn-danger");
event.preventDefault();
});
$("#calc").click(function(){
event.preventDefault();
$.ajax({
     type:'POST'
     , url:'assets/calculate.php'
     , data: ({Operand1:$("#opn1").val(),Operand2:$("#opn2").val(),Operation:opr})
     , dataType: 'json'
     , success: function(d)
     {
      document.frm.result.value = d.result;
     }
   })
});
});
</script>
</html>