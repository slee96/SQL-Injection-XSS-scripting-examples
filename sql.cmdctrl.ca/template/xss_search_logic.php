<?php
function error($x){
	if ($x == 1){
		throw new Exception("error1");

	}else if ($x == 2){
		throw new Exception("error2");
	}
}

if (isset($_POST["search"])){
	include "../credentials/iss.php";
	$var = $_POST["search"];
	$counter=0;
	/* 
	' UNION SELECT id, username, password FROM users where 1 -- '
	' UNION SELECT null, user, password FROM mysql.user -- ' 
	' UNION SELECT user(), host, null FROM mysql.user; -- '
	' UNION SELECT null, load_file('/etc/passwd'), null -- '
	*/

	try {
		$var = '%' . $var . '%';
		$stmt = $conn->prepare("SELECT article, description, date FROM search WHERE article LIKE ? or description LIKE ? or date LIKE ? ;");
		$stmt->bind_param("sss", $var , $var, $var);
		$stmt->execute();

		$result = $stmt->get_result() or error(1);
		if($result->num_rows === 0) exit(error(2));
		while($row = $result->fetch_assoc()) {
			echo "<tr class='row'><td>". $row["article"] ."</td>";
			echo "<td>". $row["description"] ."</td>";
			echo "<td>". $row["date"] ."</td></tr>";
			$counter = 1;
		}
		echo "</table></div>";
		if ($counter == 0){
			error(2);
		}else{
			echo "success";	
		}
	}catch(Exception $e) { 
		echo $e->getMessage();
	} 
	mysqli_close($conn);
}else{
	echo "</table></div>";
}
?>