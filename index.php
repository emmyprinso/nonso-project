<!DOCTYPE html> 
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bright Way Academy International</title>
	<link rel="stylesheet" type="text/css" href="style.css" />	
	<link href="css/font-awesome.min.css" rel="stylesheet"/>
	<link rel="shortcut icon" type="image/png" href="img/logo.png"/>
	
	
</head>

<body>

<?php
	//ini_set("display_errors", false);					//REMEMBER TO ALLOW ERROR WHEN NECESSARY

	include "connection.php";
	
	$errorUN = "Username";
	$errorPW = "Password";
	
	
	$username = NULL;
	$password = NULL;
	session_start();
	$_SESSION["adminLogin"] = array("***","***","***");
	$_SESSION["userLogin"] = array("***","***","***");
	
	
		

	
	

try {
	if ($_SESSION["username"] == NULL or $_SESSION["password"] == NULL){
		throw new Exception("there is no password");
	}else{
		$username = $_SESSION["username"];
		$password = $_SESSION["password"];	
	}

	//echo "<br>No error";
}
catch(Exception $e){
	$username = NULL;
	$password = NULL;
	//echo "<br>Exception caught: ".$e->getMessage();
}




	if($_SERVER["REQUEST_METHOD"] == "POST" || ($username != NULL && $password != NULL)){	
		
		
		if($username == NULL){
		$username = test_input($_POST["username"]);
		$password = test_input($_POST["password"]);
		}
		$adminLogin = checkForUser($username, $password, "admin");
		$userLogin = checkForUser($username, $password, "allusers");
		
		if($adminLogin[0] != "***"){
			$_SESSION["username"] = $adminLogin[0];
			$_SESSION["password"] = $adminLogin[1];
			$_SESSION["adminLogin"] = $adminLogin;
			$_SESSION["userLogin"] = array("***","***","***");
			Header("Location:adminIndex.php");
		}else if($userLogin[0] != "***"){
			$_SESSION["username"] = $userLogin[0];
			$_SESSION["password"] = $userLogin[1];
			$_SESSION["userLogin"] = $userLogin;
			$_SESSION["adminLogin"] = array("***","***","***");
			Header("Location:allusersIndex.php");
		}else if($userLogin[0] == "***" || $adminLogin[0] == "***"){
			$errorUN = "Wrong Credential";
			$errorPW = "Wrong Credential";
		}
		
	
	}
?>





	<header>
		<div id="header-inner">
			<a href="index.php" id="logo"></a>
			<nav>
				<a href="#" id="menu-icon"></a>
				<ul>
					<li><a href="index.php" class="current"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="index.php"><i class="fa fa-at"></i> Login</a></li>

				</ul>
			
			</nav>
		</div>
	</header>
<!--END OF HEADER-->





<div class="bigBody">


<div class="indexOuter">
<div class="indexInner">


<div class="landing">
<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<br>
	<br>	
	<input type="text" name="username" placeholder="<?php echo $errorUN; ?>" class="formInput" required>
	<br>
	<br>
	<input type="password" name="password" placeholder="<?php echo $errorPW; ?>" class="formInput" required>
	<br>
	<br>	
	<input type="submit" value="Login" class="login">
	<br>
	<br>
</form>

</div>


</div>
</div>

</div>







<footer>
<ul class="social">
	<li id="tele"><a href="tel:+2347030982027"><i class="fa fa-phone-square"></i></a></li>
	<li><a href="google.com" target="_blank"><i class="fa fa-facebook"></i></a></li>
	<li><a href="google.com" target="_blank"><i class="fa fa-google-plus"></i></a></li>
	<li><a href="google.com" target="_blank"><i class="fa fa-twitter"></i></a></li>
	<li><a href="google.com" target="_blank"><i class="fa fa-youtube"></i></a></li>
	<li><a href="google.com" target="_blank"><i class="fa fa-instagram"></i></a></li>
</ul>
</footer>
<!--END FOOTER SOCIALS-->

<footer class="second">
	<span><h3>CONTACT US</h3></span>
	<ul>
		<li>say something</li>
		<li>something else</li>
		<li>another sonthing else</li>
		<li>yet another sonthing else</li>
	</ul>
	<p>&copy Copyright of nonso | All Rights Reserved</p>
</footer>
<!--END SECOND FOOTER-->

</body>
</html>
