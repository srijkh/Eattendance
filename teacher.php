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

					$query = "UPDATE `teacher` SET `time` = now()";
					mysqli_query($link,$query);

					$query = "UPDATE `teacher` SET `date` = now()";
					mysqli_query($link,$query);

					$query = "SELECT `date` FROM `teacher` ";
					$result = mysqli_query($link,$query);
					$row=mysqli_fetch_array($result);

					$date= $row['0'];

					$query = "SELECT MONTH ('".$date."')";
					$result= mysqli_query($link,$query);
					$row=mysqli_fetch_array($result);
					
					$month = $row['0'] ;
					
				
					$query= "SELECT `presence` FROM `teacher1` WHERE `month_id` = '".mysqli_real_escape_string($link,$month)."'";
					$result= mysqli_query($link,$query);
					$t1 = mysqli_num_rows($result);

					$query= "SELECT `presence` FROM `teacher2` WHERE `month_id` = '".mysqli_real_escape_string($link,$month)."'";
					$result= mysqli_query($link,$query);
					$t2 = mysqli_num_rows($result);

					$query= "SELECT `presence` FROM `teacher3` WHERE `month_id` = '".mysqli_real_escape_string($link,$month)."'";
					$result= mysqli_query($link,$query);
					$t3 = mysqli_num_rows($result);

					$query= "SELECT `presence` FROM `teacher4` WHERE `month_id` = '".mysqli_real_escape_string($link,$month)."'";
					$result= mysqli_query($link,$query);
					$t4 = mysqli_num_rows($result);

					$month = $month - 1 ;

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
                  	
					$query= "SELECT `presence` FROM teacher".$id." WHERE `month_id` = '".mysqli_real_escape_string($link,$month)."'";
					$result= mysqli_query($link,$query);
					$present = mysqli_num_rows($result);
					$absent = $daysMonth - $present;
					
					$month = $month + 1 ; 
					$query= "SELECT `presence` FROM teacher".$id." WHERE `month_id` = '".mysqli_real_escape_string($link,$month)."'";
					$result= mysqli_query($link,$query);
					$npresent = mysqli_num_rows($result);

					$left = 5 - $absent ;
                  	$array = [$t1,$t2,$t3,$t4];
                  	rsort($array);
                  	while($att = current($array)){
                    
                      if($att == $npresent){
                        $rank = key($array) + 1;
                    }next($array);
                    }
                  
                  	$per = round((($present/$daysMonth) * 100), 2 ) ;
                  
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
				 <h2>Welcome to your Dashboard</h2>
				 
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
				 <div class="container-fluid" style="width:100%;text-align:center;margin-top:150px;background-color red;">

					<div style="width:83%; margin:auto;">

						<div style= "width:15vw; height:15vw;float:left; margin-left:1vw;">
							<canvas id="attChart1">
							</canvas>
						</div>

						
						<div style= "width:15vw; height:15vw; float:left; margin-left:1vw;">
								<canvas id="attChart3">
									</canvas>
						</div>

						<div style= "width:15vw; height:15vw; float:left;margin-left:1vw;">
								<canvas id="attChart2">
									</canvas>
						</div>

					</div>	
					
					<div style="width:83%; margin:auto;font-family: 'Raleway', sans-serif;font-size:2vw;">

							<div style= "width:15vw;float:left; margin-left:1vw;">
								<span style="position:relative;bottom:11.5vw;">
                              	
                                  <?
                                  		echo $per."%";
                                  	
								  ?>
                              
                              	</span>
							</div>
	
							
							<div style= "width:15vw; float:left; margin-left:1vw;">
								<span style="position:relative;bottom:11.5vw;">Rank:
                              	<?
      								echo $rank ;
      							?>
                              </span>
							</div>
	
							<div style= "width:15vw; float:left;margin-left:1vw;">
								<span style="position:relative;bottom:11.5vw;">Left:
		  							<?
										echo $left;
		  							?>
								</span>
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
       
       

var present = <? echo $present; ?> ;
var absent = <? echo $absent; ?> ;
var t1 = <? echo $t1; ?> ;
var t2 = <? echo $t2; ?> ;
var t3 = <? echo $t3; ?> ;
var t4 = <? echo $t4; ?> ;

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
var x3 = x.toDateString();

document.getElementById('ct').innerHTML = x3;
display_c();
}

var attChart1 = document.getElementById("attChart1");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.maintainAspectRatio = false;

var attData = {
	labels: [
		"Present",
		"Absent"
	],
	datasets: [
		{
				data: [present,absent],
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
		text: "Last Month's Stats",
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
				data: [t1,t2,t3,t4],
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
				data: [absent,5],
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
