<?php
include "securesession.php";
session_destroy();
header("Location: /");
?>