<?php

	session_start();

	$monthName = "";
	$dateDiv = "";

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

					if(array_key_exists("month",$_POST)){

						$month = $_POST['month'];

						if($month == 1){

							$monthName = "January";
						}

						else if($month == 2){

							$monthName = "February";
						}

						else if($month == 3){

							$monthName = "March";
						}

						else if($month == 4){

							$monthName = "April";
						}

						else if($month == 5){

							$monthName = "May";
						}

						else if($month == 6){

							$monthName = "June";
						}

						else if($month == 7){

							$monthName = "July";
						}

						else if($month == 8){

							$monthName = "August";
						}

						else if($month == 9){

							$monthName = "September";
						}

						else if($month == 10){

							$monthName = "October";
						}

						else if($month == 11){

							$monthName = "November";
						}

						else if($month == 12){

							$monthName = "December";
						}

						$tareek = 01;
						$date = '2019-'.$month.'-'.$tareek ;

						$query = "SELECT WEEKDAY('".mysqli_real_escape_string($link,$date)."')";
						$result = mysqli_query($link,$query);
						$row= mysqli_fetch_array($result);
						$day = $row['0'];

						if( $day == 0){
							
							$query = "SELECT `presence` FROM teacher".$id." WHERE `presence` = '".mysqli_real_escape_string($link,$date)."'";
							$result = mysqli_query($link,$query);

							if(mysqli_num_rows($result)>0){

								$dateDiv .= '<div class="date alert alert-success"><strong>1</strong></div>';
							
							}

							else{

								$dateDiv .= '<div class="date alert alert-danger"><strong>1</strong></div>';
							
							}
						}

						else if( $day == 1){
							
							$query = "SELECT `presence` FROM teacher".$id." WHERE `presence` = '".mysqli_real_escape_string($link,$date)."'";
							$result = mysqli_query($link,$query);

							if(mysqli_num_rows($result)>0){

								$dateDiv .= '<div style="margin-left:14.2%" class="date alert alert-success"><strong>1</strong></div>';
							
							}

							else{

								$dateDiv .= '<div style="margin-left:14.2%" class="date alert alert-danger"><strong>1</strong></div>';
							
							}
						}

						else if( $day == 2){
							
							$query = "SELECT `presence` FROM teacher".$id." WHERE `presence` = '".mysqli_real_escape_string($link,$date)."'";
							$result = mysqli_query($link,$query);

							if(mysqli_num_rows($result)>0){

								$dateDiv .= '<div style="margin-left:28.4%" class="date alert alert-success"><strong>1</strong></div>';
							
							}

							else{

								$dateDiv .= '<div style="margin-left:28.4%" class="date alert alert-danger"><strong>1</strong></div>';
							
							}
						}

						else if( $day == 3){
							
							$query = "SELECT `presence` FROM teacher".$id." WHERE `presence` = '".mysqli_real_escape_string($link,$date)."'";
							$result = mysqli_query($link,$query);

							if(mysqli_num_rows($result)>0){

								$dateDiv .= '<div style="margin-left:42.6%" class="date alert alert-success"><strong>1</strong></div>';
							
							}

							else{

								$dateDiv .= '<div style="margin-left:42.6%" class="date alert alert-danger"><strong>1</strong></div>';
							
							}
						}
						
						else if( $day == 4){
							
							$query = "SELECT `presence` FROM teacher".$id." WHERE `presence` = '".mysqli_real_escape_string($link,$date)."'";
							$result = mysqli_query($link,$query);

							if(mysqli_num_rows($result)>0){

								$dateDiv .= '<div style="margin-left:56.8%" class="date alert alert-success"><strong>1</strong></div>';
							
							}

							else{

								$dateDiv .= '<div style="margin-left:56.8%" class="date alert alert-danger"><strong>1</strong></div>';
							
							}
						}

						else if( $day == 5){
							
							$query = "SELECT `presence` FROM teacher".$id." WHERE `presence` = '".mysqli_real_escape_string($link,$date)."'";
							$result = mysqli_query($link,$query);

							if(mysqli_num_rows($result)>0){

								$dateDiv .= '<div style="margin-left:71%" class="date alert alert-success"><strong>1</strong></div>';
							
							}

							else{

								$dateDiv .= '<div style="margin-left:71%" class="date alert alert-danger"><strong>1</strong></div>';
							
							}
						}

						else if( $day == 6){
							
							
								$dateDiv .= '<div style="margin-left:85.2%" class="date alert alert-dark"><strong>1</strong></div>';
							
						}

						if( $month < 8){

							if($month == 2){

								$daysMonth = 27;
							}

							else if( $month%2 == 0){
								
								$daysMonth = 30;
							}

							else{

								$daysMonth = 31; 
							}
						}

						else{

							if($month%2 == 0){

								$daysMonth = 31;
							}

							else{

								$daysMonth = 30;
							}
						}
					
						$tareek = 2;

						while( $tareek <= $daysMonth ){

							$date = '2019-'.$month.'-'.$tareek ;
							$query = "SELECT WEEKDAY('".mysqli_real_escape_string($link,$date)."')";
							$result = mysqli_query($link,$query);
							$row= mysqli_fetch_array($result);
							$day = $row['0'];

							$query = "SELECT `presence` FROM teacher".$id." WHERE `presence` = '".mysqli_real_escape_string($link,$date)."'";
							$result = mysqli_query($link,$query);

							if($day == 6){

								$dateDiv .= '<div class="date alert alert-dark"><strong>'.$tareek.'</strong></div>';
							
							}

							else{
								 
							if(mysqli_num_rows($result)>0){

								$dateDiv .= '<div class="date alert alert-success"><strong>'.$tareek.'</strong></div>';
							
							}

							else{

								$dateDiv .= '<div class="date alert alert-danger"><strong>'.$tareek.'</strong></div>';
							
							}

							}
							
							$tareek ++;
						}
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
				<a href="teacher.php">
				<div class="item">
					Home
				</div>
            	</a>
				<hr>
            	<a href="register.php">
				<div class="item">
					Register
				</div>
            	</a>
				<hr>
                <a href= "viewAttendance.php">
				<div class="item">
					View Attendance
				</div>
                </a>
				<hr>
                <a href="updatePass.php">
				<div class="item">
					Change Password
				</div>
          		</a>
				

          </div>

          <div class="col-sm-9 right-slab">
			<form method="POST">
				 <input style="float:right" type="submit" class="btn btn-danger" name="logOut" value="Log Out!">
				</form>  
				 <h2>View Monthly Attendance</h2>
				 
				 <div class="container-fluid">
					 <div class="hi">
						 <?
							echo "Hi Teacher".$id;
						 ?>
					 </div>
					 
					 <div class="hi" style="float:right;">
						<span id="ct"></span>
					</div>
				 </div>
<br>
<br>
				 <div align="center" class="dropdown">
								
							<button class="btn btn-info dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							  Select Month
							</button>
							
							<div id="btnTeacher" class="dropdown-menu" aria-labelledby="dropdownMenu2">
										 
										<form method="POST">
											
											<button class="dropdown-item btn-secondary btn" name="month" type="submit" value="1"> January </button>
											<button class="dropdown-item btn-secondary btn" name="month" type="submit" value="2"> February </button>
											<button class="dropdown-item btn-secondary btn" name="month" type="submit" value="3"> March </button>
											<button class="dropdown-item btn-secondary btn" name="month" type="submit" value="4"> April </button>
											<button class="dropdown-item btn-secondary btn" name="month" type="submit" value="5"> May </button>
											<button class="dropdown-item btn-secondary btn" name="month" type="submit" value="6"> June </button>
											<button class="dropdown-item btn-secondary btn" name="month" type="submit" value="7"> July </button>
											<button class="dropdown-item btn-secondary btn" name="month" type="submit" value="8"> August </button>
											<button class="dropdown-item btn-secondary btn" name="month" type="submit" value="9"> September </button>
											<button class="dropdown-item btn-secondary btn" name="month" type="submit" value="10"> October </button>
											<button class="dropdown-item btn-secondary btn" name="month" type="submit" value="11"> November </button>
											<button class="dropdown-item btn-secondary btn" name="month" type="submit" value="12"> December </button>

										</form>	 
							</div>
					</div>
				
				<br>
				<br>
				
				<div class="container-fluid">

					<div class="calender">

						<div class="monthBar alert alert-warning">

							<strong>
								
								<?
									if($monthName != ""){

										echo $monthName;
									}

									else{
										
										echo "Month";
									}
								?>

							</strong>
						</div>

						<div class="weekBar">

							<div class="weekDay alert alert-info">
								<strong>Mon</strong>
							</div>

							<div class="weekDay alert alert-info">
								<strong>Tue</strong>
							</div>

							<div class="weekDay alert alert-info">
								<strong>Wed</strong>
							</div>

							<div class="weekDay alert alert-info">
								<strong>Thu</strong>
							</div>

							<div class="weekDay alert alert-info">
								<strong>Fri</strong>
							</div>
								
							<div class="weekDay alert alert-info">
								<strong>Sat</strong>
							</div>
							
							<div class="weekDay alert alert-dark">
								<strong>Sun</strong>
							</div>
								
						</div>

							<br>
						<div>

						<?

							if( $dateDiv != "" ){

								echo $dateDiv;
							}

						?>

						</div>

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
