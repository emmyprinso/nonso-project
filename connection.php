<?php
	$GLOBALS["servername"] = "localhost";  //"XpertProFresh";      //"localhost";
	$GLOBALS["serverUserName"] = "root";//"brightadmin";			//"root";
	$GLOBALS["serverPassword"] = "Apollos_234";
	$GLOBALS["dbname"] = "library";
	
	$conn = mysqli_connect($GLOBALS["servername"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["dbname"]);	
	
	
	if(!$conn){		//connecting to the database failed
	$conn = mysqli_connect($GLOBALS["servername"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"]);
	if(!$conn){
		die("Unable to connect to the server" . mysqli_connect_error($conn));
	}else{		//creating the database on the server
		$sql = "CREATE DATABASE " . $dbname;
		if(mysqli_query($conn, $sql)){
			echo "Successfully Created the Database " . $dbname;
		}else{
			echo "Unable to craete the database " . $dbname;
		}
	}
}
	
	
	
	
			createTable(array("admin", "firstname", 100, "lastname", 100, "username", 100, "password", 100, "address", 100, "phonenumber", 20, "email" , 100));
			//createTable(array("Allusers", "firstname", 100, "lastname", 100, "childFirstName", 100, "childLastName", 100, "childClass", 30, "username", 100, "password", 20, "address", 100, "phonenumber", 20, "email", 100));
			createTable(array("Allusers", "firstname", 100, "lastname", 100, "levelOfStudy", 30, "username", 100, "password", 20, "hostel", 100, "phonenumber", 20, "email", 100, "uniqueid", 100));
			//Table holding the seats and the id of the people on it
			createTable(array("seat", "StFirstname", 100, "StLastname", 100, "StLevelOfStudy", 30, "StUsername", 100, "StPassword", 20, "StHostel", 100, "StPhonenumber", 20, "StEmail", 100, "StUID", 100, "pressure", 100));
			//keep data here for some seconds 
			createTable(array("freshFetch", "StUID", 100, "pressure", 100));

			
function createTable($tableVal = array()){
$i = count($tableVal);
	$sql = "CREATE TABLE " . $tableVal[0] ."(id INT(6)  UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,";
	for($index=1;$index<$i;++$index){
			$sql .= $tableVal[$index] ." VARCHAR(" .$tableVal[$index+1]. ") NOT NULL,";
			$index = $index + 1;
		}
	$sql .= "reg_date TIMESTAMP)";
	
	//echo "<br>" .$sql ."<br>";
	$conn = mysqli_connect($GLOBALS["servername"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["dbname"]);	

	if(mysqli_query($conn, $sql)){
		//table was successfully created 
		//echo "<br>successfully created ".$tableVal[0]." table<br>";
	}else{
		//echo "<br> ".$tableVal[0]." table was not created";
		}
		
		mysqli_close($conn);
}



	function queryAndReturn($sql){
		$valToReturn = array();
		$conn = mysqli_connect($GLOBALS["servername"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["dbname"]);
		
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$valToReturn = $result;
			mysqli_close($conn);
			return $valToReturn;
		}else{
			mysqli_close($conn);
			return $valToReturn;
		}
	}


	
	
	/*
	for($i=0; $i<100;++$i){
		echo "successfully connected<br>";
	}
	*/

	
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	
	
	
	function checkForUser($user, $pass, $targetTable){			//this function receives the target username, password and table
	$i=0;
	$check = array("***","***","***");		//returns the array("username", "passwaord", "id") if the user exist
	$conn = mysqli_connect($GLOBALS["servername"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["dbname"]);
	if(!$conn){
		die("Connection Failed ".mysqli_connect_error);
	}else{
		$sql = "SELECT id, username, password FROM ".$targetTable;
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			
			while($row = mysqli_fetch_assoc($result)){
					if($row["username"] == $user and $row["password"] == $pass){
						$check[0] = $row["username"];
						$check[1] = $row["password"];
						$check[2] = $row["id"];

						break;
						}  //if the user exist check is exist
						++$i;
				}
			}else{
				$check = array("***","***","***");		//if the table is empty the check returns empty
				}
	}
	mysqli_close($conn);
	
	return $check;		//ends searching if a user is registered
}
	
	
	
	function checkForPair($TC1, $TC2, $VV1, $VV2, $targetTable){			//this function receives two table columns TC1 and TC2, the two variable to verify VV1 and VV2 which must be in TC1 and TC2 respectively then the Table to Search
	$i=0;
	$check = array("***","***","***");		//returns the array("VV1", "VV2", "id") if they exist
	$conn = mysqli_connect($GLOBALS["servername"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["dbname"]);
	if(!$conn){
		die("Connection Failed ".mysqli_connect_error);
	}else{
		$sql = "SELECT id, ".$TC1.", ".$TC2." FROM ".$targetTable;
		
		
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			
			while($row = mysqli_fetch_assoc($result)){
					if($row[$TC1] == $VV1 && $row[$TC2] == $VV2){
						$check[0] = $row[$TC1];
						$check[1] = $row[$TC2];
						$check[2] = $row["id"];

						break;
						}  //if the user exist check is exist
						++$i;
				}
			}else{
				$check = array("***","***","***");		//if the table is empty the check returns empty
				}
	}
	mysqli_close($conn);
	
	return $check;		//ends searching if a user is registered
}
	


	
	function updateNow($tabl, $column, $val, $id=1){
		// Create connection
		$conn = mysqli_connect($GLOBALS["servername"], $GLOBALS["serverUserName"], $GLOBALS["serverPassword"], $GLOBALS["dbname"]);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$sql = "UPDATE ".$tabl." SET ".$column."='" .$val. "' WHERE id=".$id."";
		if (mysqli_query($conn, $sql)) {

			//echo "Record updated successfully";

		} else {

			//echo "Error updating record: " . mysqli_error($conn);

		}

		mysqli_close($conn);
	}
	
	
?>