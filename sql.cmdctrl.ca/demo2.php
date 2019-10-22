<?php
include "credentials/iss.php";

if (isset($_POST["username"])){
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
		header("Location: https://cmdctrl.ca:8443/home/demo2.php");
		}
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login Demo 1</title>
	</head>
	<style>
	html, body{
		padding:0;
		margin:0;
		height:100%;
		width:100%;
		}
	#bg{
		background-image: url("https://miro.medium.com/max/2048/0*ErN7MyOU7wjQLSgM.jpg");
		background-repeat: no-repeat;
		background-size: cover;
		opacity: 0.5;
		content: "";
		top: 0;
		left: 0;
 	    bottom: 0;
	    right: 0;
		position: absolute;
		}
	label{
		width:120px;
		display:inline-block;
		}
	input{
		margin: 10px 0;
		}
	input[type=text], input[type=password]{
		width:230px;
		display:inline-block;
		}
	#submitHolder{
		width: 390px;
		text-align: center;
		}
	input[type=submit]{
		padding:5px;
		cursor:pointer;
		}
	#container{
		width:500px;
		height:300px;
		border-radius: 10px;
		margin:0 auto;
		display:flex;
		align-items: center;
		vertical-align:center;
		background-color: white;
		opacity:0.8;
		}
	form{
		margin:0 auto;
		display:block;
		width:390px;
		opacity:1;
		}
	h1{
		text-align:center;
		padding: 20px 0;
		}
	</style>
	<body>
		<div id="bg"></div>
		<h1>SQL Injection Intro - Login Demo 1 </h1>
		<div id="container">
	<!--
	username: 	' UNION SELECT 'pass' from users -- '
	password:	pass
	-->
			<form action="" method="post">
				<label>Username: </label>
				<input type="text" name="username" />
				<br>
				<label>Password: </label>
				<input type="password" name="password" />
				<br>
				<div id="submitHolder"><input type="submit" name="submit" value="Try Me" /></div>
			</form>
		</div>
	</body>
</html>
