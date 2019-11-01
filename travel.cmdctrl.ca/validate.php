<?php
include "securesession.php"
if (!isset($_SESSION['user']) && !isset($_SESSION["userid"])){
	header("Location: https://travel.cmdctrl.ca:8443");
}

?>