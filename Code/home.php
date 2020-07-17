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
		$mail = $_POST['mail'];
		$pass = md5($_POST['pass']);
		
		$sql = "SELECT * FROM users WHERE email = '$mail' and password = '$pass'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
		
		if($mail=="" && $pass==""){
			header('location:index.php');
		}
		if($row['email'] == $mail && $row['password'] == $pass){
			$_SESSION['username'] = $row['firstName'] . ' ' . $row['lastName'];
		}else{
			header('location:index.php');
			//echo "<script>swal('Fail to Login!!', {icon: 'error', buttons: false, timer: 3000,})</script>";
		}
	}
?>

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
		<h3 class="mt-5 mb-5">
		Welcome, <?php echo $_SESSION['username']; ?>
			<a class="link pull-right" href="logout.php"><button class="btn btn-sm btn-danger"><i class="fa fa-sign-out"></i></button></a>
		</h3>
	</div>
</body>
</html>