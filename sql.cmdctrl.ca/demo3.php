<?php
include "credentials/iss.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Search Demo 1</title>
	<script type="text/javascript" src="https://cmdctrl.ca:443/js/jquery-3.3.1.min.js" nonce="KCB29LwG4RYW5jbe"></script>
	</head>
	<style>
	html, body{
		padding:0;
		margin:0;
		height:100%;
		width:100%;
		}
	#bg{
		background-image: url("https://miro.medium.com/max/2048/0*ErN7MyOU7wjQLSgM.jpg");
		background-repeat: no-repeat;
		background-size: cover;
		opacity: 0.5;
		content: "";
		top: 0;
		left: 0;
 	    bottom: 0;
	    right: 0;
		position: absolute;
		}
	label{
		width:80px;
		display:inline-block;
		}
	input{
		margin: 10px 0;
		}
	input[type=text]{
		width:850px;
		display:inline-block;
		}
	input[type=submit]{
		padding:5px;
		cursor:pointer;
		}
	#container{
		width:1080px;
		height:100px;
		border-radius: 10px;
		margin:0 auto;
		display:flex;
		background-color: white;
		opacity:0.8;
		}
	#container2{
		width:1080px;
		height:600px;
		border-radius: 10px;
		margin:5px auto;
		display:flex;
		background-color: white;
		opacity:0.8;
		}
	form{
		margin:20px auto;
		display:block;
		width:1050px;
		height:50px;
		opacity:1;
		}
	h1{
		text-align:center;
		padding: 20px 0;
		}
	table{
		margin:10px;
		width:1080px;
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
        table tr td:first-child + td + td + td{
                width: 150px;
                }
        table tr td:first-child + td + td + td + td{
                width: 150px;
                }
        table tr td:first-child + td + td + td + td + td{
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
					<th>Complexity</th>
					<th>Read Time</th>
					<th>Price</th>
					<th>Date</th>
				</tr>
				<?php
				if (isset($_POST["search"])){
					$var = $_POST["search"];
					// ' UNION SELECT null, null, null, null, username, password FROM users where 1; -- //
					// ' UNION SELECT null, null, null, null, username, password FROM users where 1; -- '
					$sql = "SELECT article, description, complexity, readtime, price, date FROM search WHERE article LIKE '%$var%' or description LIKE '%$var%' or date LIKE '%$var%' or complexity LIKE '%$var%' or readtime LIKE '%$var%' or price LIKE '%$var%';";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result)){
						echo "<tr><td>". $row["article"] ."</td>";
						echo "<td>". $row["description"] ."</td>";
						echo "<td>". $row["complexity"] ."</td>";
						echo "<td>". $row["readtime"] ."</td>";
						echo "<td>$". $row["price"] ."</td>";
						echo "<td>". $row["date"] ."</td></tr>";
					}
				}
				mysqli_close($conn);
				?>
			</table>
		</div>
	</body>
</html>
