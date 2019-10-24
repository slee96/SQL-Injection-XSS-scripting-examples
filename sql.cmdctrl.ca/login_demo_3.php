<?php
function error($x){
	if ($x == 1){
		throw new Exception("Invalid Syntax:<br> SELECT * FROM users WHERE username='<span style=\"color: red; \">" 
							. $_POST["username"] . 
							"</span>';"
	}else if ($x == 2){
		throw new Exception("Wrong username/password");
	}
}
if (isset($_POST["username"])){
	/*
	username: 	' UNION SELECT null, null, '5f4dcc3b5aa765d61d8327deb882cf99' from users -- '
	password:	password
	
	username: 	' UNION SELECT id, username, MD5('password') from users; -- ' 
	password:	password
	*/
	
	include "credentials/iss.php";
	$username = $_POST["username"];
	$password = $_POST["password"];
	try {
		$sql = "SELECT * FROM users WHERE username='$username';";
		$result = mysqli_query($conn, $sql) or error(1);
		$row = mysqli_fetch_array($result) or error(2);
		if($row["password"] == md5($_POST["password"])){
			if (session_status() == PHP_SESSION_NONE) {
				session_set_cookie_params(3600, '/', 'cmdctrl.ca', isset($_SERVER["HTTPS"]), true);
				session_start();
			}
		$_SESSION['demo3'] = 'demo3';
		$_SESSION['username3'] = $row["username"];
		header("Location: /home/demo3.php");
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
		<h1>SQL Injection MD5 </h1>
		
		<?php include "template/login_form.html"; ?>
	</body>
</html>

