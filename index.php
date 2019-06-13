<?php
	
	session_start();
	
	$error="";

	if(array_key_exists("submit", $_POST)) {
	
		if (!$_POST['username']) {
            
            $error .= "A username is required<br>";
            
        } 
        
        if (!$_POST['password']) {
            
            $error .= "A password is required<br>";
            
        } 
       
		
		if ($error != "") {
            
            $error = "<div><p><strong>There were error(s) in your form:</strong></p>".$error."</div>";
            
        }
		
		else{
		
			$link = mysqli_connect("shareddb-n.hosting.stackcp.net","eattendance-313037e3ac","srijan1998","eattendance-313037e3ac");	
		
			if(mysqli_connect_error() != ""){
				
				die("The connection to the database failed");
				
			}
			
			$username = $_POST['username'];
			$password = $_POST['password'] ;

			if($_POST['principal'] == 1){
				
				$query = "SELECT * FROM `teacher` WHERE `username` = '".mysqli_real_escape_string($link, $_POST['username'])."'" ; 
				
				$result = mysqli_query($link, $query) ;
				
				if(mysqli_num_rows($result) == 0) {

					$error = "This user doesnt exist";
				}
				
				else{ 
				
					$row = mysqli_fetch_array($result); 
				
					if ($password == $row['password']){
					
						$id = $row['id'];
					
						$_SESSION['id'] = $id;
						
						if(isset($_POST['check']) AND $_POST['check'] == 1){
						
							setcookie('id',$id,time() + 60 * 60 *24);
							
						}

						header("Location: principal.php");
					}
					
					else{
						
						$error = "The Password is incorrect";
					}
				}
			
			}
			
			else{
				
				$query = "SELECT * FROM `teacher` WHERE `username` = '".mysqli_real_escape_string($link, $_POST['username'])."'" ; 
				
				$result = mysqli_query($link,$query) ;
				
				if(mysqli_num_rows($result) == 0) {

					$error = "This user doesnt exist";
				}
				
				else{ 
				
					$row = mysqli_fetch_array($result); 
				
					if ($password == $row['password']){
					
						$id = $row['id'];
					
						$_SESSION['id'] = $id;
						
						if(isset($_POST['check']) AND $_POST['check'] == 1){
						
							setcookie('id',$id,time() + 60 * 60 *24);
							
						}

						header("Location: teacher.php");
					}
					
					else{
						
						$error = "The Password is incorrect";
					}
				}
			
			}
		}
		
	
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
			height:50vh;
			box-shadow: 0px 36px 22px -24px #000000;
			margin-top:20vh;
		}

		body{

			background-image:url("bgimg.jpg");
			background-size:cover;
		}

		.container{

			width:100%;
			text-align:center;
		}

		.content{
			margin:auto;
		}

		.title{

			font-family: 'Satisfy', cursive;
			font-size:4vw;
		}

	</style>
    <title>Hello, world!</title>
  </head>
  <body onload=display_ct();>
	  <div class="container-fluid"> 

    		<div class="row">
		
				<div class="col-sm-4">
				</div>

				<div class="col-sm-4 frontPanel">

					<div class="container" style="margin-top:2vh;">
						<span class="title content"> E Attendance </span>
					</div>

					<div class="container" style="margin-top:1vh;">
						<form class="content" method="post"> 

								<div class="btn-group" role="group" aria-label="Basic example">
									
									<button type="button" id="btnTeacher" class="btn btn-dark" >Teachers Login!</button>
									<button type="button" id="btnPrincipal" class="btn btn-light" >Principals Login!</button>
								
								</div>
						
						</form>
					</div>

				

					<div class="container" id="c1" style ="clear:left;">
						<div class="container" id="form1" style="width:70%;font-family: 'Raleway', sans-serif; ">
								
								<br>
								<form method = "post">
								
								  <div class="form-group">
									
									<input name ="username"type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your username">	
								
								</div>
								  
								  <div class="form-group">
								  
									<input name="password"type="password" class="form-control" id="password" placeholder="Enter your Password">
								 
								 </div>
								  
								  <div class="form-check" style="margin-bottom:1vh;">
									
									<input name="check" type="checkbox" class="form-check-input" id="check" value=1>
									<label class="form-check-label" for="exampleCheck1">Keep me signed in</label>
									
								 </div>
								
									<input type="hidden" name="principal" value=0>
									
									<button type="submit" name="submit" id="btnSubmit" class="btn btn-success ">Log In</button>
									
								</form>
								
								<br>
						</div>
					</div>

					<div class="container" id="c2" style ="clear:left;">
						<div class="container" id="form2" style="width:70%;font-family: 'Raleway', sans-serif;">
								
								<br>
								<form method = "post">
								
								  <div class="form-group">
									
									<input name="username" type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your username">		
								
								</div>
								  
								  <div class="form-group">
								  
									<input name="password"type="password" class="form-control" id="password" placeholder="Enter your Password">
								 
								 </div>
								  
								  <div class="form-check" style="margin-bottom:1vh;">
									
									<input name="check" type="checkbox" class="form-check-input" id="check" value=1>
									<label class="form-check-label" for="exampleCheck1">Keep me signed in</label>
								 
								 </div>
									
									<input type="hidden" name="principal" value=1>
								
									<button type="submit" name="submit" id="btnSubmit" class="btn btn-success ">Log In</button>
									
								</form>
								
								<br>
						
						</div>
					</div>

				</div>
				
				<div class="col-sm-4">
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

		$("#c2").hide();
		
		$("#btnPrincipal").click(function() {
																																																																																																																																																																																																																																																			
			$("#btnPrincipal").removeClass("btn-light");
			$("#btnPrincipal").addClass("btn-dark");
			$("#btnTeacher").removeClass("btn-dark");
			$("#btnTeacher").addClass("btn-light");
			$("#c1").hide();
			$("#c2").show();
			
		})
		
		$("#btnTeacher").click(function() {
																																																																																																																																																																																																																																																		
			$("#btnPrincipal").removeClass("btn-dark");
			$("#btnPrincipal").addClass("btn-light");
			$("#btnTeacher").removeClass("btn-light");
			$("#btnTeacher").addClass("btn-dark");
			$("#c2").hide();
			$("#c1").show();
			
		})
       
    </script>
	
	</body>
</html>
