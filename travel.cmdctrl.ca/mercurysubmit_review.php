<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$rating = $_POST["rating"] ?? '';
  	$testimonial = $_POST["testimonial"] ?? '';
	
	if ($rating == "" || $testimonial == "" ){
		echo "* Fields cannot be blank *";
	}else{
		
		include "securesession.php";
		if (!isset($_SESSION['user']) && !isset($_SESSION["userid"])){
			echo "You have to loggin to submit a review";
		}else{
			
			include "credentials2.php";
			$username = $_SESSION["user"];
			$sql = "INSERT INTO review values ('$username', '$rating', '$testimonial')";
			mysqli_query($conn, $sql);
			header("Location: /mercurytestimonials.php");
		}	
	}
	
}
?>