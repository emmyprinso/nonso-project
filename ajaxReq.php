<?php
	session_start();
	include "connection.php";
	$_SESSION["adminLogin"][0];
	
	$val = queryAndReturn("SELECT * FROM seat WHERE id=".$_GET["q"]);
	$val  = mysqli_fetch_assoc($val);
	echo $val["StUID"]."#".$val["pressure"];
?>