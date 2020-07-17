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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<style>*{font-family: 'Raleway',sans-serif;}</style>
<body class="bg-light container">
	<div>
		<h3 class="mt-5 mb-5">Sign Up Here
			<a class="link pull-right" href="index.php"><i class="fa fa-sign-in"></i></a>
		</h3>
	</div>
	<section class="container bg-white p-4 rounded shadow">
		<form class="form" method="POST" action="register.php" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6 form-group">
					<label for="firstName" class="font-weight-bold">First Name :</label>
					<input type="text" name="firstName" id="firstName" class="form-control" placeholder="Enter first name">
					<span class="text-danger font-weight-bold" style="display:none;" id="fError">First Name required.!!</span>
				</div>
				<div class="col-md-6 form-group">
					<label for="lastName" class="font-weight-bold">Last Name :</label>
					<input type="text" name="lastName" id="lastName" class="form-control" placeholder="Enter last name">
					<span class="text-danger font-weight-bold" style="display:none;" id="lError">Last Name required.!!</span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 form-group">
					<label for="email" class="font-weight-bold">Email address :</label>
					<input type="email" name="mail" id="mail" class="form-control" placeholder="Enter email address">
					<span class="text-danger font-weight-bold" style="display:none;" id="e1Error">Email required.!!</span>
					<span class="text-danger font-weight-bold" style="display:none;" id="e2Error">Check Email address.!!</span>
				</div>
				<div class="col-md-4 form-group">
					<label for="password" class="font-weight-bold">Password :</label>
					<input type="password" name="pass" id="pass" class="form-control" placeholder="Enter password">
					<span class="text-danger font-weight-bold" style="display:none;" id="pError">Password required.!!</span>
				</div>
				<div class="col-md-4 form-group">
					<label for="dateOfBirth" class="font-weight-bold">Date of Birth :</label>
					<input type="date" name="dateOfBirth" id="dateOfBirth" class="form-control">
					<span class="text-danger font-weight-bold" style="display:none;" id="dError">Date required.!!</span>
				</div>
			</div>
			<div class="form-group text-center">
				<input type="submit" name="btnsubmit" id="registerSubmit" class="btn btn-sm btn-success p-2" value="Sign Up"> | 
				<input type="reset" name="reset" id="reset" class="btn btn-sm btn-danger p-2" value="Cancel">
			</div>
		</form>
	</section>
</body>
<script>
$(document).ready(function(){
	$("#registerSubmit").click(function(){
		var firstName = $("#firstName").val();
		var lastName = $("#lastName").val();
		var mail = $("#mail").val();
		var pass = $("#pass").val();
		var date = $("#dateOfBirth").val();
		var check = /^([a-zA-Z0-9\_\-\.])+\@([gmail|outlook])+\.(com)$/;
		
		if(firstName == ""){
			$("#fError").removeAttr("style");
			$("#firstName").focus();
			return false;
		}$("#fError").attr("style", "display:none");
		if(lastName == ""){
			$("#lError").removeAttr("style");
			$("#lastName").focus();
			return false;
		}$("#lError").attr("style", "display:none");
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
		if(date == ""){
			$("#dError").removeAttr("style");
			$("#dateOfBirth").focus();
			return false;
		}$("#dError").attr("style", "display:none");
	});
});
</script>
</html>

<?php
	error_reporting(0);
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$db = 'jothisthi';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
	// if($conn->connect_error){
		// echo "ERROR - 404";
	// }else{
		// echo "Connect";
	// }
	//echo "<script>alert('hii')</script>";
	if(!$_POST['btnsubmit']){
		echo " ";
	}else{
		$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
		$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
		$mail = mysqli_real_escape_string($conn, $_POST['mail']);
		$pass = md5($_POST['pass']);
		$dateOfBirth = mysqli_real_escape_string($conn, $_POST['dateOfBirth']);
		
		$mailsql = $conn->prepare("SELECT * FROM users WHERE email = ?");
		$mailsql->bind_param("s", $mail);
		$mailsql->execute();

		$result = $mailsql->get_result();
		if($result->num_rows > 0){
			echo "<script>swal('Email ID already exists!!', {icon: 'error', buttons: false, timer: 3000,})</script>";
		}else{
			$sql = "INSERT into users(firstName, lastName, email, password, dateOfBirth) VALUES('$firstName', '$lastName', '$mail', '$pass', '$dateOfBirth')";
			if(mysqli_query($conn, $sql)){
				echo "<script>swal('Register Success!!', {icon: 'success', buttons: false, timer: 3000,})</script>";
				header("location:index.php");
			}else{
				echo "<script>swal('Fail to Register!!', {icon: 'error', buttons: false, timer: 3000,})</script>";
			}
			$conn->close();
		}
	}
?>