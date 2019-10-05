<?php
//		listener.php?seatnum=**&UID=****&pressure=***
	
	include "connection.php";
	$userData = array();
	
	if($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["seatnum"])){
			echo "request received".$_GET["UID"];
			$UIDD = $_GET["UID"];
			$userData = queryAndReturn("SELECT * FROM allusers WHERE uniqueid LIKE '%$UIDD%'");
			$userData = mysqli_fetch_assoc($userData);
			
			if(strlen($UIDD) < 2)$userData = array("id"=>$_GET["seatnum"],"firstname"=>"","lastname"=>"","levelOfStudy"=>"","username"=>"","password"=>"","hostel"=>"","phonenumber"=>"","email"=>"","uniqueid"=>"");
				
			$iallusers =0;
			$fromallusers = array();
			$columnArray = array("id","StFirstname","StLastname","StLevelOfStudy","StUsername","StPassword","StHostel","StPhonenumber","StEmail","StUID","pressure");
			foreach($userData as $k => $v){
				echo "<br>".$k.":".$v."<br>";
				
				if($k == "reg_date")break;
				
				updateNow("seat", $columnArray[$iallusers], $v, $_GET["seatnum"]);
				$fromallusers[$iallusers] = $v;
				++$iallusers;
			}
			
			updateNow("seat", "pressure", $_GET["pressure"], $_GET["seatnum"]);
			
			
			/*for($i=0;$i<10;++$i){
				echo $fromallusers[$i]."<br>";
			}*/
			
			
			//updateNow($tabl, $column, $val, $id=1)
	}


?>