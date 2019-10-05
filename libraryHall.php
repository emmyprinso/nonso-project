	<link rel="stylesheet" type="text/css" href="style.css" />	
	<link href="css/font-awesome.min.css" rel="stylesheet"/>
<!--
<button id="1" class="Llogin">SEAT1</button>
-->
<div style="height:40px;"></div>

<?php
	include "connection.php";
	$seats = queryAndReturn("SELECT id FROM seat");
	$n = 0;
	while($row = mysqli_fetch_assoc($seats)){
		
		
		echo '<a href="detail.php?detail='.$row["id"].'" onmouseover="over(this)" id="'.$row["id"].'" class="Llogin">  SEAT'.$row["id"].' </a>';
		++$n;
	}

?>




<script>
var updatespeed = 50;
var seat = 1;
var stopAt = <?php echo $n; ?>;
var pull = setInterval(pullF, updatespeed);


function pullF(xread){
	clearInterval(pull);
	loadDoc(seat);
	seat = seat + 1;
	if(seat > stopAt)seat = 1;
	pull = setInterval(pullF, updatespeed);
	
}


function loadDoc(seatnum) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     var echoStr = this.responseText;
	 if(echoStr.length > 1){
		document.getElementById(seatnum).style.background = "#ff704d"; 
		document.getElementById(seatnum).style.border = "#6991AC solid 5px"; 
	 }else{
		 document.getElementById(seatnum).style.background = "#6991AC"; 
		document.getElementById(seatnum).style.border = "#ff704d solid 5px"; 
	}
     
    }
  };
  xhttp.open("GET", "ajaxReq.php?q="+seatnum, true);
  xhttp.send();
}

function over(x){
	x.style.background = "#a6ff4d";
}

</script>