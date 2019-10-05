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
	
	$username = "";
	$password = "";
	session_start()
	
	$username = $_SESSION["username"];
	$password = $_SESSION["password"];	

?>





	<header>
		<div id="header-inner">
			<a href="index.php" id="logo"></a>
			<nav>
				<a href="#" id="menu-icon"></a>
				<ul>
					<li><a href="index.php" class="current"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="gallery.php"><i class="fa fa-camera"></i> Gallery</a></li>
					<li><a href="calendar.php"><i class="fa fa-calendar"></i> Calendar</a></li>

				</ul>
			
			</nav>
		</div>
	</header>
<!--END OF HEADER-->
<section class="inner-wrapper newIndex" style="background-color:white;">
<section class="banner Image2">
	<div class="banner-inner Image"  align="center">
		<img src="img/banner/banner1.png" id="Image">
	</div>
	
</section>
</section>
<?php
	$images = queryAndReturn("SELECT images FROM bannerItems");			//bannerItems", "images", 100));
	$n = 0;
	while($row = mysqli_fetch_assoc($images)){
		$imageArray[$n] = $row["images"];
		++$n;
	}
	$script = '<script>
				var i = -1;
				var op = 0;
				var imageArray = [';
				
	for($i=0;$i<$n;++$i){
		if($i != 0){
			$script .= ",\"" . $imageArray[$i]."\"";
		}else{
		$script .= "\"" . $imageArray[$i]."\"";
		}
		
	}
	$script .= '];
	var elem = document.getElementById("Image");
	var interBig = setInterval(change, 5000);
	var interSmall;
	change();

	
	
	function change(){
		++i;
		if(i >= imageArray.length){ 
		i = 0;
		}
		
		elem.setAttribute("style","opacity:"+0);
		elem.setAttribute("src",imageArray[i]);
		clearInterval(interBig);
		interSmall = setInterval(shade, 100);
		return;
		}
		
		function shade(){
		op = op + 0.01;
		elem.setAttribute("style","opacity:"+op);
		if(op > 1){
			clearInterval(interSmall);
			elem.setAttribute("style","opacity:"+1);
			op = 0;
					interBig = setInterval(change, 5000);
				}
			}
		</script>';
		echo $script;

?>
<!--
<script>
	var i = -1;
	var op = 0;
	var imageArray = ["img/banner/banner1.png", "img/academicExcellence.jpg"];
	var elem = document.getElementById("Image");
	var interBig = setInterval(change, 5000);
	var interSmall;
	change();

	
	
	function change(){
		++i;
		if(i >= imageArray.length){ 
		i = 0;
		}
		
		elem.setAttribute("style","opacity:"+0);
		elem.setAttribute("src",imageArray[i]);
		clearInterval(interBig);
		interSmall = setInterval(shade, 100);
		return;
		}
		
	function shade(){
		op = op + 0.01;
		elem.setAttribute("style","opacity:"+op);
		if(op > 1){
			clearInterval(interSmall);
			elem.setAttribute("style","opacity:"+1);
			op = 0;
			interBig = setInterval(change, 5000);
		}
	}
</script>
-->

<?php
/*
		$acadImage;
		$acadHead;
		$acad;
		$fourSec1;
		$fourSec2;
		$fourSec3;
		$fourSec4;
		$anthemImage;
		$anthemHead;
		$anthem;
		$nursery;
		$PPrimary;
		$secondary;
		$fromPmanHead;
		$fromPman;
		$contactL1;
		$contactL2;
		$contactL3;
		$contactL4;


*/


	$indexP = queryAndReturn("SELECT * FROM iindex");
	$n = 0;
	while($row = mysqli_fetch_assoc($indexP)){
		$acadImage = $row["acadImage"];
		$acadHead = $row["acadHead"];
		$acad = $row["acad"];
		$fourSec1 = $row["fourSec1"];
		$fourSec2 = $row["fourSec2"];
		$fourSec3 = $row["fourSec3"];
		$fourSec4 = $row["fourSec4"];
		$anthemImage = $row["anthemImage"];
		$anthemHead = $row["anthemHead"];
		$anthem = $row["anthem"];
		$nursery = $row["nursery"];
		$PPrimary = $row["PPrimary"];
		$secondary = $row["secondary"];
		$fromPmanHead = $row["fromPmanHead"];
		$fromPman = $row["fromPman"];
		$contactL1 = $row["contactL1"];
		$contactL2 = $row["contactL2"];
		$contactL3 = $row["contactL3"];
		$contactL4 = $row["contactL4"];

	}
?>



<section class="inner-wrapper">
<article id="academic" align="center">
	<img src="<?php echo $acadImage?>">
</article>
<aside id="academic2">
	<h2><?php echo $acadHead?></h2>
	<p><?php echo $acad?></p>
</aside>
</section>



<!--END BANNER-->

	<a href="staff.php"><section class="one-fourth" id="staff">
		<td><i class="fa fa-briefcase"></i></td>
		<h3><?php echo $fourSec1?></h3>
		
	</section><a/>

	<a href="nursery.php"><section class="one-fourth" id="nursery">
		<td><i class="fa fa-child"></i></td>
		<h3><?php echo $fourSec2?></h3>
		
	</section><a>

	<a href="primary.php"><section class="one-fourth" id="primary">
		<td><i class="fa fa-users"></i></td>
		<h3><?php echo $fourSec3?></h3>
		
	</section></a>

	<a href="secondary.php"><section class="one-fourth" id="secondary">
		<td><i class="fa fa-graduation-cap"></i></td>
		<h3><?php echo $fourSec4?></h3>
		
	</section></a>

	
	
	<section class="inner-wrapper">
<article id="anthem" align="center">
	<img src="<?php echo $anthemImage?>">
</article>
<aside id="anthem2">
	<h2><?php echo $anthemHead?></h2>
	<p><?php echo $anthem?></p>
</aside>
</section>
	
	
<!--END FOUR COLUMN SECTION-->

<!--END OF THE TWO COLUMN SECTION-->
<section class="inner-wrapper-3">
	<section class="one-third" id="nurseryd">
		<h3>NURSERY</h3>
		<p class="level"><?php echo $nursery?></p>
	</section>

	<section class="one-third" id="primaryd">
		<h3>PRIMARY</h3>
		<p><?php echo $PPrimary?></p>
	</section>

	<section class="one-third" id="secondaryd">
		<h3>SECONDARY</h3>
		<p><?php echo $secondary?></p>
	</section>

	
</section>
<!--END OF THREE COLUMN-->

<section id="smiley">
	<h2><?php echo $fromPmanHead?></h2>
	<p><?php echo $fromPman?></p>
</section>
<!--END SMILEY-->

<section>
	<article class="accreditation">
		Accreditations: <span><img src="img/neco.jpg"></span> <span><img src="img/weac.png"></span>
	</article>
</section>

<footer>
<ul class="social">
	<li id="tele"><a href="tel:+2348071643029"><i class="fa fa-phone-square"></i></a></li>
	<li><a href="google.com" target="_blank"><i class="fa fa-facebook"></i></a></li>
	<li><a href="google.com" target="_blank"><i class="fa fa-google-plus"></i></a></li>
	<li><a href="google.com" target="_blank"><i class="fa fa-twitter"></i></a></li>
	<li><a href="google.com" target="_blank"><i class="fa fa-youtube"></i></a></li>
	<li><a href="google.com" target="_blank"><i class="fa fa-instagram"></i></a></li>
</ul>
</footer>
<!--END FOOTER SOCIALS-->

<footer class="second">
	<a href="index.php"><img src="img/logo.png" class="imgg"></a>
	<span><h3>CONTACT US</h3></span>
	<ul>
		<li><?php echo $contactL1?></li>
		<li><?php echo $contactL2?></li>
		<li><?php echo $contactL3?></li>
		<li><?php echo $contactL4?></li>
	</ul>
	<p>&copy Copyright of Brightway International Academy | All Rights Reserved</p>
</footer>
<!--END SECOND FOOTER-->

</body>
</html>
