<!DOCTYPE html>
<html>
	<head>
		<title>Login Demo 1</title>
	<script type="text/javascript" src="https://travel.cmdctrl.ca/js/jquery-3.3.1.min.js" nonce="KCB29LwG4RYW5jbe"></script>	
	</head>
	<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<body>
		<div id="bg"></div>
		<h1>SQL Injection Intro - Login Demo 1 </h1>
		<?php include "template/login_form.html"; ?>
		
	<?php
	if (isset($_GET["msg"])){
		echo $_GET["msg"];
	}
	?>
	</body>
</html>
