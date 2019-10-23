<?php
function error($x){
	if ($x == 1){
		throw new Exception("Invalid Syntax");
	}else if ($x == 2){
		throw new Exception("Wrong username/password");
	}
}
if (isset($_POST["username"])){
	include "credentials/iss.php";
	$username = $_POST["username"];
	$password = $_POST["password"];
	try {
		
		$sql = "SELECT * FROM users WHERE username='$username' AND password='$password';";
		$result = mysqli_query($conn, $sql) or error(1);
		$row = mysqli_fetch_array($result) or error(2);
		if($row){
			if (session_status() == PHP_SESSION_NONE) {
				session_set_cookie_params(3600, '/', 'cmdctrl.ca', isset($_SERVER["HTTPS"]), true);
				session_start();
			}
		$_SESSION['demo1'] = 'demo1';
		mysqli_close($conn);
		exit(0);
		header("Location: /home/demo1.php");
		}
	}catch(Exception $e) { 
		echo "<div id=\"alert\">Exception Caught: " . $e->getMessage() . "<br><br><br><button id=\"alertbtn\">[ close ]</button></div>";
	} 
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login Form</title>
		<script type="text/javascript" src="https://travel.cmdctrl.ca:8443/js/jquery-3.3.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/css/main.css" />
	</head>
	<body>
		<div id="bg"></div>
		<h1>SQL Injection Intro - Login Demo 1 </h1>
		<?php include "template/login_form.html"; ?>
	</body>
</html>
