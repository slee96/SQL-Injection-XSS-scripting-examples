<?php
function error($x){
	if ($x == 1){
		throw new Exception("Invalid Syntax");
	}else if ($x == 2){
		throw new Exception("Wrong username/password");
	}
}
function login(){
	include "credentials/iss.php";
	$username = $_POST["username"];
	$password = $_POST["password"];
	try {
		$sql = "SELECT password FROM users WHERE username='$username' AND password='$password';";
		$result = mysqli_query($conn, $sql) or error(1);
		$row = mysqli_fetch_array($result) or error(2);
		if($row["password"] == $_POST["password"]){
			if (session_status() == PHP_SESSION_NONE) {
				session_set_cookie_params(3600, '/', 'cmdctrl.ca', isset($_SERVER["HTTPS"]), true);
				session_start();
			}
		$_SESSION['demo2'] = 'demo2';
		exit(0);
		header("Location: /home/demo2.php");
		}
	}catch(Exception $e) { 
		echo "<div id=\"alert\">Exception Caught: " . $e->getMessage() . "<br><br><br><button id=\"alertbtn\">[ close ]</button></div>";
	} 
	mysqli_close($conn);
}
if (isset($_POST["username"])){
	login();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login Form</title>
		<script type="text/javascript" src="https://travel.cmdctrl.ca:8443/js/jquery-3.3.1.min.js"></script>	
		<link rel="stylesheet" type="text/css" href="/css/main.css" />	
		<script type="text/javascript">
			$("#alertbtn").click(function(){
				$("#alert").hide();
			});
		</script>
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
