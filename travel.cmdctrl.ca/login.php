<?php
  if(isset($_POST["userName"]) && isset($_POST["password"]) ){
  $user = $_POST["userName"] ?? '';
  $pass = $_POST["password"] ?? '';
    //Check for sql injections
    if(!preg_match('/^(["\'\;#]).*\1$/m', $user) && !preg_match('/^(["\'\;#]).*\1$/m', $pass) && htmlspecialchars($user, ENT_QUOTES) == $user && htmlspecialchars($pass, ENT_QUOTES) == $pass){
		include "credentials.php";
		// Hash password they entered to compare with hashed password in db
		//$pass = md5($pass);

	  $stmt = $conn->prepare("SELECT username, userid, password FROM user WHERE username= ? AND password = ? ");
	  $stmt->bind_param("ss", $user, md5($pass));
	  $stmt->execute();
		
	 $result = $stmt->get_result();
	 if($result->num_rows === 0) exit('No rows');
     if($row = $result->fetch_assoc()) {
		 
		include "securesession.php";
	    $_SESSION["user"] = $row["username"];
        $_SESSION["userid"] = $row["userid"];
        mysqli_free_result($result);
        echo "success";
        header("Location: /");
      }else{
        echo "* Invalid password or username *";
 		//error_log('Invalid input on user login'.PHP_EOL, 3, '/var/log/php_errors.log');
      }
      mysqli_close($conn);
    }else{
     //echo "SQL injections detected";
      //error_log('SQL injection attempted'.PHP_EOL, 3, '/var/log/php_errors.log');
    }
  }else{
    echo "* Fields cannot be blank *";
    //error_log('Blank username & password'.PHP_EOL, 3, '/var/log/php_errors.log');
  }


?>