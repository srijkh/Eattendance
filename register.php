<?php

	session_start();
	
	$success= "";
	$error = "";

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

					$query = "UPDATE `teacher` SET `time` = now()";
					mysqli_query($link,$query);

					$query = "UPDATE `teacher` SET `date` = now()";
					mysqli_query($link,$query);

                  	
						$query="Select `upper` FROM `teacher` LIMIT 1";
						$result = mysqli_query($link,$query);
						$row = mysqli_fetch_array($result);
						$upperTime = $row['0'];

						$query="Select `lower` FROM `teacher` LIMIT 1";
						$result = mysqli_query($link,$query);
						$row = mysqli_fetch_array($result);
						$lowerTime = $row['0'];
                  
					if(array_key_exists("submit",$_POST)){

						$query="SELECT `time` FROM `teacher` WHERE `id` = '".mysqli_real_escape_string($link,$id)."'";

						$result=mysqli_query($link,$query);
						$row= mysqli_fetch_array($result);
						$timestamp = strtotime($row['0']) + 16200; 
						$time = date('H:i:s', $timestamp);

						if($time >= $lowerTime AND $time <= $upperTime){    /*  for time checking */

							$query = "SELECT `date` FROM `teacher` ";
							$result = mysqli_query($link,$query);
							$row=mysqli_fetch_array($result);

							$date= $row['0'];

							$query = "SELECT MONTH ('".$date."')";
							$result= mysqli_query($link,$query);
							$row=mysqli_fetch_array($result);

							$month=  $row['0'];

							$query = "SELECT * FROM teacher".$id." WHERE `presence` = '".mysqli_real_escape_string($link,$date)."'";
							$result= mysqli_query($link,$query);
							
							if(mysqli_num_rows($result) > '0' ){

								$error =" Your presence has already been registered.";
							}
							  
							else{
					
								$tareek = $date;
								$dateFormat = '2019-'.$month.'-'.$tareek ;
								$query = "SELECT WEEKDAY('".mysqli_real_escape_string($link,$date)."')";
								$result = mysqli_query($link,$query);
								$row= mysqli_fetch_array($result);
								$day = $row['0'];

								if($day == 6){

									$error .= "Oops..!! Todays a holiday";
								}

								else{

								$query="INSERT INTO teacher".$id." (`id`, `month_id`, `presence`) VALUES ('', '".mysqli_real_escape_string($link,$month)."', '".mysqli_real_escape_string($link,$date)."')";
								mysqli_query($link,$query);

								$success = "Your attendence has successfully been registered";
								
								}

							}

						}

						else{

							$error .= " Attendance can only be registered between ".$lowerTime." hrs and ".$upperTime." hrs";

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
			position:relative;
			left:4%;
			font-family: 'Satisfy', cursive;
			font-size:3vw;
		}

		.hi{
			font-family: 'Raleway', sans-serif;
			float:left;
			font-size:1.5vw;
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
				 <h2>Register Your Attendance</h2>
				 
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
				 <div class="container-fluid" style="width:100%;text-align:center;margin-top:100px;">

				 <div style="margin:auto;width:40%;">
				 <div id="error">

					<?
                   			if($error == "" AND $success == ""){
                   				
                              	echo '<div class="alert alert-dark" role="alert"><strong>Details</strong></div>';
                            }
                   
							if($error != ""){

								echo '<div class="alert alert-dark" role="alert"><strong>'.$error.'</strong></div>';
							}

							if($success != ""){

								echo '<div class="alert alert-dark" role="alert"><strong>'.$success.'</strong></div>';
							}
					?>
				
				</div>
				</div>

				<div style="margin:auto;width:40%;margin-top:1vw;font-family:'Roboto',sans-serif;font-size:1vw;font-weight:50;">
					<div class="alert alert-secondary container-fluid" >
  
						<div class="row container-fluid">

							<div class="col-sm-5" style="text-align:left;">
								<?
									echo "Teacher ID<br>" ;
									echo "Time<br>";
									echo "Reporting Time<br>"; 
								?>  
							</div>

                          	<div class="col-sm-2" style="position:relative;left:4%;">
                              
                              	: <br> : <br> :
                             </div>
							
                          <div class="col-sm-5" style="text-align:right;">

								<?
									echo $id."<br>" ;
								?>
									<span id="at"></span><br>
                            	<?
									echo $upperTime ;
								?>	
							</div>
						</div> 
					 
  
				  </div>
				  </div>

				<form method="post">
              <input type="hidden" name="register">
              <input type="submit" class="btn btn-success btn-lg" name="submit" value="Register">
				</form>
				
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
