<?php 
include "securesession.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	// Get user ip
  $ipaddress = '';
  if (getenv('HTTP_CLIENT_IP'))
      $ipaddress = getenv('HTTP_CLIENT_IP');
  else if(getenv('HTTP_X_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
  else if(getenv('HTTP_X_FORWARDED'))
      $ipaddress = getenv('HTTP_X_FORWARDED');
  else if(getenv('HTTP_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
  else if(getenv('HTTP_FORWARDED'))
     $ipaddress = getenv('HTTP_FORWARDED');
  else if(getenv('REMOTE_ADDR'))
      $ipaddress = getenv('REMOTE_ADDR');
  else
      $ipaddress = 'UNKNOWN';
	include "credentials2.php";
	
	$fname = $_POST["firstName"] ?? '';
  	$lname = $_POST["lastName"] ?? '';
	$phone = $_POST["phone"] ?? '';
	$email = $_POST["email"] ?? '';
	$address = $_POST["address1"] ?? '';
	$address2 = $_POST["address2"] ?? '';
	$city = $_POST["city"] ?? '';
	$state = $_POST["state"] ?? '';
	$postal = $_POST["postalCode"] ?? '';
	$username = $_POST["userName"] ?? '';
	$pass1 = $_POST["password"] ?? '';
	$pass2 = $_POST["confirmPassword"] ?? '';
	
	
	$stmt = $conn->prepare("SELECT username FROM user WHERE username= ? ");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	
	$result = $stmt->get_result();
    $count = $result->num_rows;
	mysqli_free_result($result);

	if ($fname == "" || $lname == "" || $phone == "" || $email == "" || $lname == "" || $address == "" || $city == "" || $state == "" || $postal == "" || $username == "" || $pass1 == "" || $pass2 == ""){
	   echo "* Fields cannot be blank *";
    }else if($pass1 != $pass2){
        echo "* Passwords do not match *";
    }else if(preg_match('/^(["\'\;#]).*\1$/m', $username) || htmlspecialchars($username, ENT_QUOTES) != $username){
        echo "* No SQL injections please >.< *";
    }else if($count){
        echo "* Username exists *";
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "* Invalid e-mail format *";
    }else if(!preg_match("/^[a-zA-Z ]*$/",$fname) || !preg_match("/^[a-zA-Z ]*$/",$lname) || htmlspecialchars($fname, ENT_QUOTES) != $fname || htmlspecialchars($lname, ENT_QUOTES) != $lname) {
        echo "* Sorry, no special characters in: first name or last name* ";
	}else{
		session_destroy();
		//create table user(userid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname varchar(50) NOT NULL, lastname varchar(50) NOT NULL, phone varchar(20), email varchar(255) NOT NULL, address varchar(255), address2 varchar(255), city varchar(50), state varchar(50), postal varchar(50), username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, ipaddress varchar(25));
		
		$stmt = $conn->prepare("INSERT INTO user (firstname, lastname, phone, email, address, address2, city, state, postal, username, password, ipaddress) values ( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?) ");
		$stmt->bind_param("ssssssssssss", $fname, $lname, $phone, $email, $address, $address2, $city, $state, $postal, $username, $pass1, $ipaddress);
		$stmt->execute();
		
		$stmt = $conn->prepare("SELECT userid, username FROM user WHERE username= ? ");
		$stmt->bind_param("s", $username);
		$stmt->execute();
	
		$result = $stmt->get_result();
		if($result->num_rows === 0) exit('Counld not create user');
    	if($row = $result->fetch_assoc()) {
			include "securesession.php";
			
	    	$_SESSION["user"] = $row["username"];
        	$_SESSION["userid"] = $row["userid"];
			
			header("Location: /home");
		}		
	}
}
?>