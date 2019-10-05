<?php
session_start();
			$_SESSION["username"] = NULL;
			$_SESSION["password"] = NULL;
			$_SESSION["adminLogin"] = array();
			$_SESSION["userLogin"] = array();
			Header("Location:index.php");

?>