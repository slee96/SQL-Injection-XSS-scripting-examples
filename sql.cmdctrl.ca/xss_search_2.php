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
			<form action="" method="post" id="form">
				<label>Search: </label>
				<input type="text" name="search" />
				<input type="submit" name="submit" value="Try Me" />
			</form>
		</div>
		<div id="container" style="margin-top:10px;text-align:center;">
			<p style="width:600px;">You searched: <b id="searched"> </b></p>
		</div>
		<div id="container2">
			<table id="table">
				<tr style="font-size:18px; font-weight: 700;padding:8px">
					<th>Article</th>
					<th>Description</th>
					<th>Date</th>
				</tr>
				<script type="text/javascript">$("#alertbtn").click(function(){$("#alert").hide();});
				
				$("#form").submit(function(event){
				  event.preventDefault();
				  $.post( "template/xss_search_logic.php", { search: $("input[name='search']").val()}).done(function( data ) {
					  	$(".row").remove();
					    document.getElementById("searched").innerHTML = $("input[name='search']").val();
					    $("input[name='search']").val("");
					  	if(data == "error1") {
							alert("Invalid Syntax");
						}else if (data == "error2"){
							alert("No rows found");
						}else if(data != ""){
							$("#table").append($(data));
						}
						
				  	});
				});
				
					
				</script>
	</body>
</html>


