<?php

	session_start();
	

	if(array_key_exists("id",$_COOKIE) ){

		$_SESSION['id'] = $_COOKIE['id'];
	}

	if(!array_key_exists("id",$_SESSION)){

		header("Location: index.php");
	}


	else{

		$link = mysqli_connect("shareddb-n.hosting.stackcp.net","eattendance-313037e3ac","srijan1998","eattendance-313037e3ac");

				if(mysqli_connect_error() != ""){

					die("The connection to the database failed");

				}

				else {

					$id = $_SESSION['id'];

						$query="Select `upper` FROM `teacher` LIMIT 1";
						$result = mysqli_query($link,$query);
						$row = mysqli_fetch_array($result);
						$upperTime = $row['0'];

						$query="Select `lower` FROM `teacher` LIMIT 1";
						$result = mysqli_query($link,$query);
						$row = mysqli_fetch_array($result);
						$lowerTime = $row['0'];

					if(array_key_exists("update",$_POST)){

						$query="UPDATE teacher SET `upper` = '".mysqli_real_escape_string($link,$_POST['finalTime'])."', `lower` = '".mysqli_real_escape_string($link,$_POST['initialTime'])."'";
						mysqli_query($link,$query);

						$query="Select `upper` FROM `teacher` LIMIT 1";
						$result = mysqli_query($link,$query);
						$row = mysqli_fetch_array($result);
						$upperTime = $row['0'];

						$query="Select `lower` FROM `teacher` LIMIT 1";
						$result = mysqli_query($link,$query);
						$row = mysqli_fetch_array($result);
						$lowerTime = $row['0'];
					}

			}
		}
		if(array_key_exists("logOut",$_POST)){
	
				unset($_SESSION);
				  setcookie("id", "", time() - 60*60);
				  $_COOKIE["id"] = "";  
				  
				  session_destroy();
				
				header("Location: index.php");
			}
?>


<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <link href="https://fonts.googleapis.com/css?family=Satisfy&display=swap" rel="stylesheet">
	 <link href="https://fonts.googleapis.com/css?family=Raleway:500&display=swap" rel="stylesheet">
	 <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300&display=swap" rel="stylesheet">
    
	<style type="text/css">

		.frontPanel{
			
			margin:auto;
			width:90%;
			margin-top:5vh;
			background : linear-gradient(to right bottom,#ffffff,#d4d9de);
			height:90vh;
			box-shadow: 0px 36px 22px -24px #000000;
		}

		body{

			background-image:url("bgimg.jpg");
			background-size:cover;
		}

		.left-slab{

			background-color:#0d0d0d;
			padding:0;
			text-align:center;
			height:90vh;
		}

		.right-slab{

			text-align:center;
			padding-top:2vw;
		}

		.imgContainer{

			margin:auto;
			width:80%;
		}		

		.item{
			
			color:rgb(130,130,130);
			text-align:center;
			font-size:1vw;;
			width:70%;
			float:center;
			margin:auto;
			height:2vw;
			padding-top:4px;
			border-radius:15px;
		}

		.hover{

			background: linear-gradient(to right, #7e158b,#ca097c);
			color:white;
		}

		hr{
			background-color:white;
			width:70%;
		}

		h2{

			font-family: 'Satisfy', cursive;
			font-size:3vw;
position:relative;
left:4%;
		}

		.hi{
			font-family: 'Raleway', sans-serif;
			float:left;
			font-size:1.5vw;
		}
		
		.calender{

			width:60%;
			margin:auto;
		}

		.monthBar{

			height:2.5vw;
			font-weight: :200;
			text-align:center;
			font-size:1vw;
		}

		.weekBar{

			height:2vw;
		}

		.weekDay{

			float:left;
			clear:none;
			width:14.2%;
		}

		.date{

			float:left;
			clear:none;
			width:14.2%; 
		}

		.alert{

			margin:0;
		}
		
		a:link { 
            text-decoration: none; 
        } 
        a:hover { 
            text-decoration: none; 
        }


	</style>
    <title>Hello, world!</title>
  </head>
  <body onload=display_ct();>
	  <div class="container-fluid"> 

    	<div class="frontPanel row">
       
       

          <div class="col-sm-3 left-slab">
				
				<div class="container-fluid">
					<div class="imgContainer"><img src="logo.png" width="100%" height="auto"></div>
				</div>
				<a href="principal.php">
				<div class="item">
					Home
				</div>
            	</a>
				<hr>
            	<a href="attendanceCorner.php">
				<div class="item">
					View Attendance
				</div>
            	</a>
				<hr>
                <a href= "detailAttendance.php">
				<div class="item">
					View Detailed Attendance
				</div>
                </a>
				<hr>
                <a href="updateTime.php">
				<div class="item">
					Change Timings
				</div>
          		</a>
				

          </div>

          <div class="col-sm-9 right-slab">
			<form method="POST">
				 <input style="float:right;" type="submit" class="btn btn-danger" name="logOut" value="Log Out!">
				</form>  
				 <h2>Update Timings</h2>
				 
				 <div class="container-fluid">
					 <div class="hi">
						 Hi Principal
					 </div>
					 
					 <div class="hi" style="float:right;">
						<span id="ct"></span>
					</div>
				 </div>

<div class="container-fluid" style="width:100%;text-align:center;margin-top:100px;">
<div style="margin:auto;width:40%;">
<div id="error">

<? 

		echo "<div id='error' class= 'alert alert-dark' role='alert'> <strong>Current Reporting Time : ".$lowerTime." to ".$upperTime."</strong></div>";
	
?>

</div>
</div>
</div>
<br>

<div class="container-fluid" style="width:100%;text-align:center;">
	<div style="margin:auto;width:40%;font-family: 'Raleway', sans-serif;">
		<form id="update" method="POST">

			<div class="form-group" style="text-align:left;">
				<label for="currentPass"><strong>Initial Time</strong></label>
				<input type="time" class="form-control" id="initialTime" name="initialTime">
			</div>
			<div class="form-group" style="text-align:left;>
				<label for="newPass"><strong>Final Time</strong></label>
				<input type="time" class="form-control" id="finalTime" name="finalTime">
			</div>

		<input type="submit" class="bnt btn-success btn-lg" value="Update" name="update"> 

		</form>
	</div>
</div>			
				</div>
		</div>

          

   </div>
	 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
	 <script type="text/javascript">

		$("#update").submit(function(e) {

		var error = "" ;

		if ($("#initialTime").val() == "") {

			error += "The initial Time field must have a value<br>" 
		}		

		if ($("#finalTime").val() == "") {

			error += "The final Time field must have a value<br>" 
		}

		if( error != ""){
			
			$("#error").html('<div class="alert alert-dark"> <p><strong> There are error(s) in your initials </strong></p>' + error + '</div>' )

			return false;
		}

		else {
			
			return true;
		}
		})


       $(".item").hover(function(){

	$(this).addClass("hover");
},
function(){

	$(this).removeClass("hover");
});

      
function display_c(){
	var refresh=1000;
	mytime=setTimeout('display_ct()',refresh)
	}

	function display_ct() {
	var x = new Date()
	var x2 = x.toDateString();
	
	var hour=x.getHours();
	var minute=x.getMinutes();
	var second=x.getSeconds();
	if(hour <10 ){hour='0'+hour;}
	if(minute <10 ) {minute='0' + minute; }
	if(second<10){second='0' + second;}
	var x3 = hour+':'+minute+':'+second;

	document.getElementById('ct').innerHTML = x2;
	document.getElementById('at').innerHTML = x3;
	display_c();
	}


var attChart1 = document.getElementById("attChart1");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.maintainAspectRatio = false;

var attData = {
	labels: [
		"Presence",
		"Absence"
	],
	datasets: [
		{
				data: [80,20],
				backgroundColor: [
					"#ca097c",
					"#d4d9de"
				],

				borderColor: [
					"#ca097c",
					"#d4d9de"
				]
		}]
};

var chartOptions = {

	title: {
		display: true,
		position: "bottom",
		padding: 30,
		text: "Current Attendance",
		fontSize: 25,
		fontColor: "#111",
		fontFamily: "Titillium Web"

	},

	legend: {
		
		display: false,
	 
  },

	rotation: (Math.PI/2),
	cutoutPercentage: 80,
	};

var doughChart = new Chart(attChart1, {
type: 'doughnut',
data: attData,
options: chartOptions,

});

var attchart3 = document.getElementById("attChart3");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;


var attData = {
	labels: [
		"Teacher1",
		"Teacher2",
		"Teacher3",
		"Teacher4"
	],
	datasets: [
		{
				data: [25,20,27,28],
				backgroundColor: [
					"#70178d",
					"#f524a1",
					"#ca0a7b",
					"#d4d9de"
				],

				borderColor: [
					"#70178d",
					"#f524a1",
					"#ca0a7b",
					"#d4d9de"
				]
		}]
};

var chartOptions = {

	title: {
		display: true,
		position: "bottom",
		padding: 30,
		text: "Ranking",
		fontSize: 25,
		fontColor: "#111",
		fontFamily: "Titillium Web"

	},

	legend: {
		
		display: false,
	},

	rotation: (Math.PI/2),
	cutoutPercentage: 80,
	};

var doughChart = new Chart(attChart3, {
type: 'doughnut',
data: attData,
options: chartOptions,

});


var attchart2 = document.getElementById("attChart2");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var attData = {
	labels: [
		"Leaves Used",
		"Leaves Alloted"
	],
	datasets: [
		{
				data: [3,5],
				backgroundColor: [
					"#ca097c",
					"#d4d9de"
				],

				borderColor: [
					"#ca097c",
					"#d4d9de"
				]
		}]
};

var chartOptions = {

	title: {
		display: true,
		position: "bottom",
		padding: 30,
		text: "Leave Status",
		fontSize: 25,
		fontColor: "#111",
		fontFamily: "Titillium Web"

	},

	legend: {
		
		display: false,
	 
  },

	rotation: (Math.PI/2),
	cutoutPercentage: 80,
	};

var doughChart = new Chart(attChart2, {
type: 'doughnut',
data: attData,
options: chartOptions,

});


    </script>
	</body>
</html>
