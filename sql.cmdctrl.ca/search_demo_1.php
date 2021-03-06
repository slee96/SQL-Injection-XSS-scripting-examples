<!DOCTYPE html>
<html>
	<head>
		<title>Search Bar</title>

<?php include "template/htmlHeader.html"; ?>
		
		
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
	</head>
	<body>
		<div id="bg"></div>
		<h1>SQL Injection - Search Bar 2 </h1>
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
				function error($x){
					if ($x == 1){
						throw new Exception("Invalid Syntax:<br> SELECT article, description, date FROM search WHERE article LIKE 
						    '<span style=\"color: red; \">" . $_POST["search"] . "</span>'
							or description LIKE 
							'<span style=\"color: red; \">" . $_POST["search"] . "</span>'
							or date LIKE 
							'<span style=\"color: red; \">" . $_POST["search"] . "</span>';");
											
					}else if ($x == 2){
						throw new Exception("Not Results Returned");
					}
				}
			
				if (isset($_POST["search"])){
					include "credentials/iss.php";
					$var = $_POST["search"];
					$counter=0;
					$sql = "SELECT article, description, date FROM search WHERE article LIKE '%$var%' or description LIKE '%$var%' or date LIKE '%$var%';";
					
					try {
						$result = mysqli_query($conn, $sql) or error(1); 
						while($row = mysqli_fetch_array($result)){
							echo "<tr><td>". $row["article"] ."</td>";
							echo "<td>". $row["description"] ."</td>";
							echo "<td>". $row["date"] ."</td></tr>";
							$counter = 1;
						}
						echo "</table></div>";
						if ($counter == 0){
							error(2);
						}
					}catch(Exception $e) { 
						echo "</table></div><div id=\"alert\">" . $e->getMessage() . "<br><br><br><button id=\"alertbtn\">[ close ]</button></div>";
					} 
					mysqli_close($conn);
				}else{
					echo "</table></div>";
				}
				?>
				<script type="text/javascript">$("#alertbtn").click(function(){$("#alert").hide();});</script>
	</body>
</html>
