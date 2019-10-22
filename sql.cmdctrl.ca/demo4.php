<?php
include "credentials/iss.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Search Demo 1</title>
	</head>
	<style>
	label{
		width:80px;
	}
	input[type=text], input[type=password]{
		width:350px;
		}
	#container{
		width:600px;
		height:100px;
		}
	#container2{
		width:600px;
		height:600px;
		}
	form{
		margin:20px auto;
		width:550px;
		height:50px;
		}
	table{
		margin:10px;
		width:580px;
		text-align:center;
		font-size: 13px;
		border-collapse: collapse;
		}
	td, th{
		padding:5px;
		border-bottom: 1px solid #ddd;
		}
	table tr td:first-child{
		width: 150px;
		}
	table tr td:first-child + td{
		width: 300px;
		}
	table tr td:first-child + td + td{
		width: 150px;
		}
	</style>
	<body>
		<div id="bg"></div>
		<h1>SQL Injection - Search Demo 1 </h1>
		<div id="container">
			<form action="" method="post">
				<label>Search: </label>
				<input type="text" name="search" />
				<input type="submit" name="submit" value="Try Me" />
			</form>
		</div>
		<div id="container2">
			<table>
				<tr style="font-size:18px; font-weight: 700;padding:8px">
					<th>Article</th>
					<th>Description</th>
					<th>Date</th>
				</tr>
				<?php
				if (isset($_POST["search"])){
					$var = $_POST["search"];
					// ' UNION SELECT id, username, password FROM users where 1; -- //
					// ' UNION SELECT id, username, password FROM users where 1; -- '
					$sql = "SELECT article, description, date FROM searcharea WHERE article LIKE '%$var%' or description LIKE '%$var%' or date LIKE '%$var%';";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result)){
						echo "<tr><td>". $row["article"] ."</td>";
						echo "<td>". $row["description"] ."</td>";
						echo "<td>". $row["date"] ."</td></tr>";
					}
				}
				mysqli_close($conn);
				?>
			</table>
		</div>
	</body>
</html>
