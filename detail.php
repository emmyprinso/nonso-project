	<link rel="stylesheet" type="text/css" href="style.css" />	
	<link href="css/font-awesome.min.css" rel="stylesheet"/>
<!--
<button id="1" class="Llogin">SEAT1</button>
-->
<div style="height:40px;"></div>

<?php
	include "connection.php";
	session_start();
	
	if($_SESSION["adminLogin"][0] != "***"){
		
		
	$seats = queryAndReturn("SELECT * FROM seat WHERE id=".$_GET["detail"]);

	$row = mysqli_fetch_assoc($seats);
	 //"", 100, "", 30, "", 100, "", 20, "", 100, "", 20, "", 100, "", 100, "pressure", 100));

	echo '<h5 style="color:#6991AC;font-size:150%;font-weight:700; margin-left:10%;"> First Name : '.strtoupper($row["StFirstname"]).'</h5><br>'; 
	echo '<h5 style="color:#6991AC;font-size:150%;font-weight:700; margin-left:10%;"> Last Name : '.strtoupper($row["StLastname"]).'</h5><br>'; 
	echo '<h5 style="color:#6991AC;font-size:150%;font-weight:700; margin-left:10%;"> Level of Study : '.$row["StLevelOfStudy"].'</h5><br>'; 
	echo '<h5 style="color:#6991AC;font-size:150%;font-weight:700; margin-left:10%;"> User Name : '.$row["StUsername"].'</h5><br>'; 
	echo '<h5 style="color:#6991AC;font-size:150%;font-weight:700; margin-left:10%;"> Password : '.$row["StPassword"].'</h5><br>'; 
	echo '<h5 style="color:#6991AC;font-size:150%;font-weight:700; margin-left:10%;"> Hostel : '.strtoupper($row["StHostel"]).'</h5><br>'; 
	echo '<h5 style="color:#6991AC;font-size:150%;font-weight:700; margin-left:10%;"> Phone Number : '.$row["StPhonenumber"].'</h5><br>'; 
	echo '<h5 style="color:#6991AC;font-size:150%;font-weight:700; margin-left:10%;"> E-mail Address : '.$row["StEmail"].'</h5><br>'; 
	echo '<h5 style="color:#6991AC;font-size:150%;font-weight:700; margin-left:10%;"> Student UID : '.$row["StUID"].'</h5><br>'; 
	 
	$seatVal = "";
	if(strlen($row["StUID"]) >= 3){
		$seatVal = "YES SEATED";
	}elseif(strlen($row["pressure"]) >= 3){
		$seatVal = "YES SEATED";
	}else{
		$seatVal = "NOT SEATED";
	}
	
	echo '<h5 style="color:#6991AC;font-size:150%;font-weight:700; margin-left:10%;"> SEATED? : '.$seatVal.'</h5><br>';	
		

	
	
	}else{
		echo '<h5 style="color:#6991AC;font-size:150%;font-weight:700; margin-left:10%;">FOR ADMIN ONLY <br> CLICK ON HOME TO RETURN TO THE HOME PAGE</h5><br>';	
	}
?>



