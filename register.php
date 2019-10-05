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
	echo "";
	$errorUID = "PRESS THE REGISTRATION AND SWIPE CARD";
	$errorP = "";
	include "connection.php";
	session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$errorUID = "";

	$firstname = $_POST["fname"];
	$lastname = $_POST["lname"];
	$levelOfStudy = $_POST["level"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$hostel = $_POST["hostel"];
	$phonenumber = $_POST["phonenumber"];
	$email = $_POST["email"];
	$uniqueid = $_POST["uid"];

		
		foreach($_POST as $k => $v){
			echo "<br>".$k.":".$v."<br>";
		}
		
		
		$checkUIDandPassword = checkForPair("password", "uniqueid", $_POST["password"], $_POST["uid"], "allusers");
		
		for($i=0;$i<3;++$i){
			echo "<br>".$checkUIDandPassword[$i]."<br>";
		}
		
		
		if($_POST["uid"] != "***"){
		if($checkUIDandPassword[0] == "***"){
			$checkUIDandPassword = checkForPair("username", "password", $_POST["username"], $_POST["password"], "allusers");

				if($checkUIDandPassword[0] != "***"){
					$errorP = "username already exist";
				}
		}else{
			$errorUID = "";			//"UID in the Database";
		}
		}else{
			$errorP = "PLEASE REPEAT THE PROCESS";
		}

		
		////////////////////////////////////////////
		echo "----------------------------<br>"."errorP : ".$errorP."<br>----------------------------<br>";
		echo "----------------------------<br>"."errorUID : ".$errorUID."<br>----------------------------<br>";
		echo "----------------------------<br>"."_SESSION['adminLogin'][0] : ".$_SESSION["adminLogin"][0]."<br>----------------------------<br>";
		echo "----------------------------<br>"."_POST['uid'] : ".$_POST["uid"]."<br>----------------------------<br>";
		
		///////////////////////////////////////////////
		
		
		if($errorP == "" && $errorUID == "" && $_SESSION["adminLogin"][0] != "***" && $_POST["uid"] != "***"){
			
			


			
			
			
			$sql = "INSERT INTO allusers (firstname, lastname, levelOfStudy, username, password, hostel, phonenumber, email, uniqueid)
					VALUES ('$firstname', '$lastname', '$levelOfStudy', '$username', '$password', '$hostel', '$phonenumber', '$email', '$uniqueid')";
					queryAndReturn($sql);
					Header("Location:index.php");
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
	<?php echo '<h5 style="color:red;">' .$errorP."   "; ?>
	<?php echo $errorUID."</h5>"; ?>
	<br>	
	<input type="text" name="fname" placeholder="First Name" class="formInput" required>
	<br>
	<br>	
	<input type="text" name="lname" placeholder="Last Name" class="formInput" required>
	<br>
	<br>
	<input type="text" name="level" placeholder="Level of Study" class="formInput" required>
	<br>
	<br>


	<input type="text" name="username" placeholder="User Name" class="formInput" required>
	<br>
	<br>
	
	
	<input type="password" name="password" placeholder="Password" class="formInput" required>
	<br>
	<br>
		<input type="text" name="hostel" placeholder="Hostel" class="formInput">
	<br>
	<br>
			<input type="text" name="phonenumber" placeholder="Phone Number" class="formInput" required>
	<br>
	<br>
			<input type="text" name="email" placeholder="E-mail Address" class="formInput" required>
	<br>
	<br>
	
		<input style="background-color:yellow;" onclick="uidi(this)" type="text" name="uid" placeholder="Unique Identifier" class="formInput" value="<?php echo $errorUID; ?>" required><br>
		<h5 style="color:coral;font-size:150%;font-weight:700;outline-style:solid;outline-color:coral;">Click To Fetch UID</h5>
		

	
	
	<input type="submit" value="Register" class="login">
	<br>
	<br>	<br>
	<br>	<br>
	<br>	<br>
	<br>
</form>

</div>



</div>
</div>

</div>







<footer style="padding-top:30px;">
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




<script>

function uidi(elem){
	alert("Swipe your card over the RFID reader to enroll the New Student");
	
	
	
  var xhttp = new XMLHttpRequest();
 
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     var echoStr = this.responseText;
	 elem.setAttribute("value", echoStr);
    }
  };
  xhttp.open("GET", "getuid.php?act=registerPHP", true);
  xhttp.send();	
  
	
}

</script>







</body>
</html>
