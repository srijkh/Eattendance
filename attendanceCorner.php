<?php

	session_start();

	$mssgTeacher = "";
	$mssgMonth = "";

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

					$id = 1;

					if(array_key_exists("month",$_POST)){

						$month = $_POST['month'];

						while($id < 5){

						$query= "SELECT `presence` FROM teacher".$id." WHERE `month_id` = '".mysqli_real_escape_string($link,$month)."'";
						$result= mysqli_query($link,$query);
						$present = mysqli_num_rows($result);
	
						$att = round((($present / 30)	* 100),2) ;  	
						
						$mssgTeacher .= "<li>Teacher<strong>".$id."</strong> : ".$att."%</li>"; 
						$id++ ;
						}
					}

					if(array_key_exists("teacher",$_POST)){

						$id = $_POST['teacher'];

						$month = 1;

						while($month < 13){

						$query= "SELECT `presence` FROM teacher".$id." WHERE `month_id` = '".mysqli_real_escape_string($link,$month)."'";
						$result= mysqli_query($link,$query);
						$present = mysqli_num_rows($result);
	
						$att = round((($present / 30)	* 100),2) ;  	

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
							
						$mssgMonth .= "<li><strong>".$monthName."</strong> : ".$att."%</li>"; 
						$month++ ;
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
			left:5%;
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
				 <h2>View Attendance</h2>
				 
				 <div class="container-fluid">
					 <div class="hi">
						Hi Principal
					 </div>
					 
					 <div class="hi" style="float:right;">
						<span id="ct"></span>
					</div>
				 </div>
				 <div class="container-fluid" style="width:100%;text-align:center;margin-top:100px;">

					<div style="margin:auto;width:40%;font-family:'Raleway',sans-serif;font-size:1vw;">
					<div>
					<strong>All Teachers for a specific month</strong>
					
					<div class="dropdown" style="float:right;position:relative;bottom:0.4vw;right:0.4vw;">
								
							<button class="btn btn-secondary dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

					<div id="teacher" style="margin-top:2vw;">

                  	<ul>
					<?
						
						if($mssgTeacher != ""){

							
									echo '<div class="alert alert-secondary" role="alert" style="text-align:left;padding-left:7vw;">'.$mssgTeacher.'</div>' ;
						
						}
                  		
					?>
                    </ul>
					
				</div>


				 </div>
					</div>
					  
					

					<div style="margin:auto;width:40%;font-family:'Raleway',sans-serif;font-size:1vw;margin-top:2vw;">
					<div>

						<strong> Attendance Of a specific teacher</strong>

						<div id="dMonth" class="dropdown" style="float:right;position:relative;bottom:0.4vw;">
						
								<button class="btn btn-secondary dropdown-toggle" type="button" id="btnMonth" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Select Teacher
								</button>
								
								<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
											
											<form method="POST">
												
												<button class="dropdown-item btn-secondary btn" name="teacher" type="submit" value="1"> Teacher1 </button>
												<button class="dropdown-item btn-secondary btn" name="teacher" type="submit" value="2"> Teacher2 </button>
												<button class="dropdown-item btn-secondary btn" name="teacher" type="submit" value="3"> Teacher3 </button>
												<button class="dropdown-item btn-secondary btn" name="teacher" type="submit" value="4"> Teacher4 </button>

											</form>	 
								</div>
						</div>
						
						<div id="month" style="margin-top:2vw;">

                  	<ul>
					<?
						
						if($mssgMonth != ""){
							
									echo '<div class="alert alert-secondary" role="alert" style="text-align:left;padding-left:9vw;">'.$mssgMonth.'</div>' ;
						
						}
                  		
					?>
                    </ul>
					
				</div>

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
		var x3 = x.toDateString();

		document.getElementById('ct').innerHTML = x3;
		display_c();
		}


    </script>
	
	</body>
</html>
