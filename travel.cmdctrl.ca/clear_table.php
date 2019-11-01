<?php
include "credentials2.php";
mysqli_query($conn,"delete from review;");
mysqli_close($conn);
?>