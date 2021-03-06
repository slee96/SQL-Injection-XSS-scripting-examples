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
		#bg{
			background-image: url("https://www.keycdn.com/img/blog/x-xss-protection.png");
			}
		</style>
	</head>
	<body>
		<div id="bg"></div>
		<h1>XSS - document.write() </h1>
		<div id="container">
			<form action="" method="get">
				<label>Search: </label>
				<input type="text" name="search" />
				<input type="submit" value="Try Me" />
			</form>
		</div>
		<div id="container" style="margin-top:10px;text-align:center;">
			<p style="width:600px;">You searched: <b><?php if (isset($_GET["search"])) echo htmlspecialchars($_GET["search"]); ?></b></p>
			<script type="text/javascript">
					function trackSearch(query) {
						document.write('<img height="1px" width="1px" src="/tracker.gif?search='+query+'">');
					}
					var query = (new URLSearchParams(window.location.search)).get('search');
					if(query) {
						trackSearch(query);
					}
			</script>
		</div>
		<div id="container2">
			<table>
				<tr style="font-size:18px; font-weight: 700;padding:8px">
					<th>Article</th>
					<th>Description</th>
					<th>Date</th>
				</tr>
				<?php
				/*
					"><iframe onload=alert(1)></iframe>
					"><svg onload=alert(1)>
					"><audio  src="temp.mp3" onerror="alert(1)">
					"><video  src="temp.mp3" onerror="alert(1)">
				*/
				function error($x){
					if ($x == 1){
						throw new Exception("Invalid Syntax:<br> SELECT article, description, date FROM search WHERE article LIKE 
							'<span style=\"color: red; \">" . $_GET["search"] . "</span>'
							or description LIKE 
							'<span style=\"color: red; \">" . $_GET["search"] . "</span>'
							or date LIKE 
							'<span style=\"color: red; \">" . $_GET["search"] . "</span>';");

					}else if ($x == 2){
						throw new Exception("Not Results Returned");
					}
				}

				if (isset($_GET["search"])){
					include "credentials/iss.php";
					$var = $_GET["search"];
					$counter=0;

					try {
						$var = '%' . $var . '%';
						$stmt = $conn->prepare("SELECT article, description, date FROM search WHERE article LIKE ? or description LIKE ? or date LIKE ? ;");
						$stmt->bind_param("sss", $var , $var, $var);
						$stmt->execute();

						$result = $stmt->get_result() or error(1);
						if($result->num_rows === 0) exit(error(2));
						while($row = $result->fetch_assoc()) {
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
						echo "</table></div><div id=\"alert\">" . $e->getMessage() . "<br><br><br><button id=\"alertbtn\" onclick=\"$(\"#alert\").remove();\">[ close ]</button></div>";
					} 
					mysqli_close($conn);
				}else{
					echo "</table></div>";
				}
				?>
				<script type="text/javascript">
					$("#alertbtn").click(function(){$("#alert").hide();});
				</script>
	</body>
</html>
