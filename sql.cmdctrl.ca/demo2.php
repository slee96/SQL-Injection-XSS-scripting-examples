<?php
if (isset($_POST["username"])){
	include "credentials/iss.php";
	$username = $_POST["username"];
	$password = $_POST["password"];
	$sql = "SELECT password FROM users WHERE username='$username' AND password='$password';";
	$result = mysqli_query($conn, $sql);
	if($row = mysqli_fetch_array($result)){
		if($row["password"] == $_POST["password"]){
			if (session_status() == PHP_SESSION_NONE) {
			    session_set_cookie_params(3600, '/', 'cmdctrl.ca', isset($_SERVER["HTTPS"]), true);
			    session_start();
			}
		$_SESSION['demo2'] = 'demo2';
		mysqli_close($conn);
		exit(0);
		header("Location: /home/demo2.php");
		}
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login Form</title>
		
		<link rel="stylesheet" type="text/css" href="/css/main.css" />	
	</head>
	<body>
		<div id="bg"></div>
		<h1>SQL Injection Intro - Login Demo 1 </h1>
		
		<?php include "template/login_form.html"; ?>
	<!--
	username: 	' UNION SELECT 'pass' from users -- '
	password:	pass
	-->
	</body>
</html>
