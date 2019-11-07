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
			
			include "credentials.php";
			$username = $_SESSION["user"];
			$sql = "INSERT INTO review values ('$username', '$rating', '$testimonial', curdate())";
			if ($result=mysqli_query($conn,$sql)){
				mysqli_close($conn);
				header("Location: /mercurytestimonials.php");
			}else{
				echo "error inserting into the database";	
			}
		}	
	}
	
}
?>