<?php
if (session_status() == PHP_SESSION_NONE) {
    //session_set_cookie_params(3600, '/', 'cmdctrl.ca', isset($_SERVER["HTTPS"]), true);
    //session_name("PHPSESSID");
   session_start();
}
if (!isset($_SESSION['demo1'])){
	if ($_SESSION['demo1'] != "demo1"){
		header("Location: https://sql.cmdctrl.ca:8443/demo1.php");
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

	</body>
</html>

