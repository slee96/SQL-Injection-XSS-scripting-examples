<?php
include "credentials2.php";
if( mysqli_query($conn,"delete from review;")){
	echo "Table \"review\" has been cleared of all rows";	
}
mysqli_close($conn);
?>