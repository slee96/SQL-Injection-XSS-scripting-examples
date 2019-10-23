<?php
function login(){
	include "credentials/iss.php";
	$username = $_POST["username"];
	$password = $_POST["password"];
	$sql = "SELECT password FROM users WHERE username='$username' AND password='$password';";
	$result = mysqli_query($conn, $sql);
	try {
		$row = mysqli_fetch_array($result);
		if(!$row){
			throw new Exception("Invalid Syntax");
		}else{
			if($row["password"] == $_POST["password"]){
				if (session_status() == PHP_SESSION_NONE) {
					session_set_cookie_params(3600, '/', 'cmdctrl.ca', isset($_SERVER["HTTPS"]), true);
					session_start();
				}
			$_SESSION['demo2'] = 'demo2';
			exit(0);
			header("Location: /home/demo2.php");
		}
			
		#echo "<div id=\"alert\">";
		#echo htmlentities(trigger_error("Exception Caught", E_USER_ERROR), ENT_QUOTES);
		#echo "<br><br><br><button id=\"alertbtn\">[ close ]</button></div>";

	}catch(Exception $e) { 
		echo "<div id=\"alert\">" . $e->getMessage() . "<br><br><br><button id=\"alertbtn\">[ close ]\n Exception Caught</button></div>";
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
