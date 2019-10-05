<?php

	//ini_set("display_errors", false);

		
		
	include "connection.php";
	session_start();
	
	

	$secs = 0;
	$UID = "***";
	
	
	if($_GET['act'] == "registerPHP"){
		$useState = queryAndReturn("SELECT * FROM freshfetch WHERE id=1");	
		$row = mysqli_fetch_assoc($useState);
			$UID = $row["StUID"];
		
		updateNow("freshfetch", "StUID", "***","1");
	}elseif(!empty($_GET['act'])){											//http://localhost/nonso/getuid.php?act=EEEE
		updateNow("freshfetch", "StUID", $_GET['act'], "1");
	}
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	while(empty($_GET["hardwareUID"]) && $secs < 20){				//SET THE TIME TO WAIT FOR THE CARD 
		$countTime = date("s");
		while($countTime == date("s"));
		++$secs;
	}
	
	if(!empty($_GET["hardwareUID"])){
		$UID = $_GET["hardwareUID"];
	}
	*/
		if($_SESSION["adminLogin"][0] == "***"){
			$UID = "YOU ARE NOT AUTHORIZED";
		}	
		
echo $UID;

?>