<?php

if (isset($_POST["username"])){
	include "credentials/iss.php";
	$username = $_POST["username"];
	$password = $_POST["password"];
	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password';";
	$result = mysqli_query($conn, $sql);
	if($row = mysqli_fetch_array($result)){
		if (session_status() == PHP_SESSION_NONE) {
		    session_set_cookie_params(3600, '/', 'cmdctrl.ca', isset($_SERVER["HTTPS"]), true);
		    session_start();
		}
	$_SESSION['demo1'] = 'demo1';
	mysqli_close($conn);
	exit(0);
	header("Location: /home/demo1.php");
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
	</body>
</html>
