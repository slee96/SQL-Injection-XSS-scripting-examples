<?php
function error($x){
	if ($x == 1){
		throw new Exception("Invalid Syntax:<br> SELECT * FROM users WHERE username=
							'<span style=\"color: red; \">" . $_POST["username"] . "</span>' 
							AND password=
							'<span style=\"color: red; \">" . $_POST["password"] . "</span>';");
	}else if ($x == 2){
		throw new Exception("Wrong username/password");
	}
}
if (isset($_POST["username"])){
	/*
	something_that_returns_nothing' UNION SELECT * from users where 1 limit 1 -- '
	
	username:	'-
	password:	-
	
	username:	'-0||'
	password:	rand
	
	*/
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
		$_SESSION['username'] = $row["username"];
		mysqli_close($conn);
		header("Location: /home/demo1.php");
		exit(0);
		}
	}catch(Exception $e) { 
		echo "<div id=\"alert\">Exception Caught -> " . $e->getMessage() . "<br><br><br><button id=\"alertbtn\">[ close ]</button></div>";
	} 
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login Form</title>

<?php include "template/htmlHeader.html"; ?>
	
	</head>
	<body>
		<div id="bg"></div>
		<h1>SQL Injection Intro</h1>
		<?php include "template/login_form.html"; ?>
	</body>
</html>
