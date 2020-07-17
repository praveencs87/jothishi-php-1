<!DOCTYPE HTML>
<html lang="en-IN">
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<style>*{font-family: 'Raleway',sans-serif;}</style>
<body class="bg-light container">
	<div>
		<h3 class="mt-5 mb-5">Sign In Here
			<a class="link pull-right" href="register.php"><i class="fa fa-user-plus"></i></a>
		</h3>
	</div>
	<section class="col-md-6 container bg-white p-4 rounded shadow">
		<form class="form" method="POST" action="home.php" enctype="multipart/form-data">
			<div class="form-group">
				<label for="email" class="font-weight-bold">Email address :</label>
				<input type="email" name="mail" id="mail" class="form-control" placeholder="Enter email address">
				<span class="text-danger font-weight-bold" style="display:none;" id="e1Error">Email required.!!</span>
				<span class="text-danger font-weight-bold" style="display:none;" id="e2Error">Check Email address.!!</span>
			</div>
			<div class="form-group">
				<label for="password" class="font-weight-bold">Password :</label>
				<input type="password" name="pass" id="pass" class="form-control" placeholder="Enter password">
				<span class="text-danger font-weight-bold" style="display:none;" id="pError">Password required.!!</span>
			</div>
			<div class="form-group text-center">
				<input type="submit" name="btnsubmit" id="logSubmit" class="btn btn-sm btn-success p-2" value="Sign In">
			</div>
		</form>
	</section>
</body>
<script>
$(document).ready(function(){
	$("#logSubmit").click(function(){
		var mail = $("#mail").val();
		var pass = $("#pass").val();
		var check = /^([a-zA-Z0-9\_\-\.])+\@([gmail|outlook])+\.(com)$/;
		
		if(mail == ""){
			$("#e1Error").removeAttr("style");
			$("#mail").focus();
			return false;
		}$("#e1Error").attr("style", "display:none");
		if(check.test(mail) == false){
			$("#e2Error").removeAttr("style");
			$("#mail").focus();
			return false;
		}$("#e2Error").attr("style", "display:none");
		if(pass == ""){
			$("#pError").removeAttr("style");
			$("#pass").focus();
			return false;
		}$("#pError").attr("style", "display:none");
	});
});
</script>	
</html>