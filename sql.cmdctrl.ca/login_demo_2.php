<?php
function error($x){
	if ($x == 1){
				throw new Exception("Invalid Syntax:<br> SELECT * FROM users WHERE username=
							'<span style=\"color: red; \">" . $_POST["username"] . "</span>';"
	}else if ($x == 2){
		throw new Exception("Wrong username/password");
	}
}
if (isset($_POST["username"])){
	/*
	username: 	' UNION SELECT null, null, 'pass' from users -- '
	password:	pass
	
	username: 	' UNION SELECT id, username, "pass" from users -- '
	password:   pass
	
	username: 	' UNION SELECT id, username, "pass" from users where username="admin" -- '
	password:   pass
	
	*/
	
	include "credentials/iss.php";
	$username = $_POST["username"];
	$password = $_POST["password"];
	try {
		$sql = "SELECT * FROM users WHERE username='$username';";
		$result = mysqli_query($conn, $sql) or error(1);
		$row = mysqli_fetch_array($result) or error(2);
		if($row["password"] == $_POST["password"]){
			if (session_status() == PHP_SESSION_NONE) {
				session_set_cookie_params(3600, '/', 'cmdctrl.ca', isset($_SERVER["HTTPS"]), true);
				session_start();
			}
		$_SESSION['demo2'] = 'demo2';
		$_SESSION['username2'] = $row["username"];
		header("Location: /home/demo2.php");
		exit(0);
		}
	}catch(Exception $e) { 
		echo "<div id=\"alert\">Exception Caught: " . $e->getMessage() . "<br><br><br><button id=\"alertbtn\">[ close ]</button></div>";
	} 
	mysqli_close($conn);
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
		<h1>SQL Injection UNION</h1>
		
		<?php include "template/login_form.html"; ?>
	</body>
</html>
