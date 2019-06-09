<?php
	
	session_start();
	
	$error="";

	if(array_key_exists("submit", $_POST)) {
	
		if (!$_POST['email']) {
            
            $error .= "An email address is required<br>";
            
        } 
        
        if (!$_POST['password']) {
            
            $error .= "A password is required<br>";
            
        } 
        
        if ($_POST['email'] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
            
            $error .= "The email address is invalid.<br>";
            
        }
		
		if ($error != "") {
            
            $error = "<div><p><strong>There were error(s) in your form:</strong></p>".$error."</div>";
            
        }
		
		else{
		
			$link = mysqli_connect("shareddb-n.hosting.stackcp.net","eattendance-313037e3ac","srijan1998","eattendance-313037e3ac");	
		
			if(mysqli_connect_error() != ""){
				
				die("The connection to the database failed");
				
			}
			
			$email = $_POST['email'];
			$password = $_POST['password'] ;
			$hash = password_hash($password , PASSWORD_DEFAULT);
			
			
			if($_POST['principal'] == 1){
				
				$query = "SELECT `id` FROM `user` WHERE `email` = '".mysqli_real_escape_string($link, $_POST['email'])."'" ; 
				
				$result = mysqli_query($link, $query) ;
				
				$row = mysqli_fetch_array($result);	
				
				if(mysqli_num_rows($result) >0) {

					$error = "This Email ID is already in use";
				}
				
				else{
				
					$query = "INSERT INTO `user` (`email` , `password`) VALUE ('".$email."','".$hash."')"; 

				
					if( mysqli_query($link, $query)) {
						
						$id = mysqli_insert_id($link);
					
						$_SESSION['id'] = $id;
						
						if(isset($_POST['check']) AND $_POST['check'] == 1){
			
						     setcookie('id',$id,time() + 60 * 60 * 24);
						}	

					header("Location: diary.php");
					}					
					
					else {
						
						$error = "<strong>Some error occurred </strong> <br> Try again after some time"; 
					}
					
				}
			
			}
			
			else{
				
				$query = "SELECT * FROM `user` WHERE `username` = '".mysqli_real_escape_string($link, $_POST['username'])."'" ; 
				
				$result = mysqli_query($link, $query) ;
				
				if(mysqli_num_rows($result) == 0) {

					$error = "This user doesnt exist";
				}
				
				else{ 
				
					$row = mysqli_fetch_array($result); 
				
					if (password_verify($password, $row['password'])){
					
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

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Stylish&display=swap" rel="stylesheet">
   
   <title>Hello, world!</title>
  </head>
  <body style="background-image:url('wallpaper.jpg');">
	<br>
	<br>
	<br>
	<br>
	
	<div class="h1 container"> E Attendance </div>
	<div class="h2 container"> Login to register your presence</div>
	
	<form class="container" method="post"> 

		<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
			
			<button type="button" id="btnTeacher" class="btn btn-primary" >Teachers Login!</button>
			<button type="button" id="btnPrincipal" class="btn btn-light" >Principals Login!</button>
		
		</div>

	</form>
	
	<br>
	
	<div class="container">
	<div id="error">
		
		<? 
			if( $error != ""){

				echo '<div id="error" class="alert alert-danger" role="alert" style="border-radius:15px; width:500px; margin:auto;">'.$error.'</div><br>' ; 
			}	 

		?>
		
	</div>
	</div>

	
	
	<div class="container" id="c1" style ="clear:left;">
	<div class="container" id="form1"style="width:500px; background-color:white;box-shadow: 5px 3px 15px 10px #595959; border:1px solid; ">
		
		<br>
		<br>
		<form method = "post">
		
		  <div class="form-group">
			
			<input name ="username"type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your username">	
		
		</div>
		  
		  <div class="form-group">
		  
			<input name="password"type="password" class="form-control" id="password" placeholder="Enter your Password">
		 
		 </div>
		  
		  <div class="form-check">
			
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
	<div class="container" id="form2" style="width:500px; background-color:white; box-shadow: 5px 3px 15px 10px #595959; border:1px solid; ">
		
		<br>
		<br>
		<form method = "post">
		
		  <div class="form-group">
			
			<input name="username"type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your username">		
		
		</div>
		  
		  <div class="form-group">
		  
			<input name="password"type="password" class="form-control" id="password" placeholder="Enter your Password">
		 
		 </div>
		  
		  <div class="form-check">
			
			<input name="check" type="checkbox" class="form-check-input" id="check" value=1>
			<label class="form-check-label" for="exampleCheck1">Keep me signed in</label>
		 
		 </div>
			
			<input type="hidden" name="principal" value=1>
		
			<button type="submit" name="submit" id="btnSubmit" class="btn btn-success ">Sign Up</button>
			
		</form>
		
		<br>

	</div>
	</div>
	
	
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
	<script type="text/javascript">
	
		$("#c2").hide();
		
		$("#btnPrincipal").click(function() {
		                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
			$("#btnPrincipal").removeClass("btn-light");
			$("#btnPrincipal").addClass("btn-primary");
			$("#btnTeacher").removeClass("btn-primary");
			$("#btnTeacher").addClass("btn-light");
			$("#c1").hide();
			$("#c2").show();
			
		})
		
		$("#btnTeacher").click(function() {
		                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
			$("#btnPrincipal").removeClass("btn-primary");
			$("#btnPrincipal").addClass("btn-light");
			$("#btnTeacher").removeClass("btn-light");
			$("#btnTeacher").addClass("btn-primary");
			$("#c2").hide();
			$("#c1").show();
			
		})
		
		
 	
	</script>

 </body>
</html>
