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

		  
		.select-css {
			display: block;
			font-size: 16px;
			font-family: sans-serif;
			font-weight: 700;
			color: #444;
			line-height: 1.3;
			padding: .6em 1.4em .5em .8em;
			width: 100%;
			max-width: 100%; 
			box-sizing: border-box;
			margin: 0;
			border: 1px solid #aaa;
			box-shadow: 0 1px 0 1px rgba(0,0,0,.04);
			border-radius: .5em;
			-moz-appearance: none;
			-webkit-appearance: none;
			appearance: none;
			background-color: #fff;
			background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
				linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
			background-repeat: no-repeat, repeat;
			background-position: right .7em top 50%, 0 0;
			background-size: .65em auto, 100%;
		}

		.select-css::-ms-expand {
			display: none;
		}

		.select-css:hover {
			border-color: #888;
		}

		.select-css:focus {
			border-color: #aaa;
			box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
			box-shadow: 0 0 0 3px -moz-mac-focusring;
			color: #222; 
			outline: none;
		}

		.select-css option {
			font-weight:normal;
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
				 <input style="float:right" type="submit" class="btn btn-danger" name="logOut" value="Log Out!">
				</form>  
				 <h2>View Monthly Attendance</h2>
				 
				 <div class="container-fluid">
					 <div class="hi">
						 Hi Principal
					 </div>
					 
					 <div class="hi" style="float:right;">
						<span id="ct"></span>
					</div>
				 </div>
<br>
<br>
<form method="POST">

		<div align="center" class="dropdown">
						
				<select class="select-css" name="teacher" style="width:200px;">
					<option value="0">Select Teacher</option>
					<option value="1">Teacher1</option>
					<option value="2">Teacher2</option>
					<option value="3">Teacher3</option>
					<option value="4">Teacher4</option>
				</select>
					<br>	
				<select class="select-css" name="month" style="width:200px;">
					<option value="0">Select Month</option>
					<option value="1">January</option>
					<option value="2">February</option>
					<option value="3">March</option>
					<option value="4">April</option>
					<option value="5">May</option>
					<option value="6">June</option>
					<option value="7">July</option>
					<option value="8">August</option>
					<option value="9">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
					<br>
				<input type="submit" name="submit" class="btn btn-dark">
		</div>
		
	  </form>	
				
				
				<div style="text-align:center;" class="container-fluid">

				<?
					if($monthName != ""){

						echo '<div class="alert alert-dark" role="alert" style="width:60%;margin:auto;"> <strong>Teacher : '.$id.'</strong></div>';
					}
				?>

				</div>

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
