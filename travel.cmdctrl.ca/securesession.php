<?php
if (session_status() == PHP_SESSION_NONE) {
    session_set_cookie_params(3600, '/', 'travel.cmdctrl.ca', isset($_SERVER["HTTPS"]), true);
    //session_name("PHPSESSID");
    session_start();
}
?>
