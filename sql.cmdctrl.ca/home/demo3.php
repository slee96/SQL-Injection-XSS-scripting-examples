<?php
if (session_status() == PHP_SESSION_NONE) {
    //session_set_cookie_params(3600, '/', 'cmdctrl.ca', isset($_SERVER["HTTPS"]), true);
    //session_name("PHPSESSID");
   session_start();
}
if (!isset($_SESSION['demo3'])){
	if ($_SESSION['demo3'] != "demo3"){
		header("Location: https://sql.cmdctrl.ca:8443/login_demo_3.php");
	}
}
?>
<!DOCTYPE html>
<html>
        <head>
                <title>Success</title>
        </head>
	<body>
		<h1> You are logged in </h1>
	</body>
</html>
