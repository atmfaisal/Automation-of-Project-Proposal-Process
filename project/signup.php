<?php

include 'connection.php';

if(isset($_POST['submit_button']))
{
	$name = $_POST['username'];
	$email = $_POST['email'];
	$fullname = $_POST['fullname'];
	$desig = $_POST['designation'];
	$pass = $_POST['password'];
	$pass2 = $_POST['Password2'];

	if( (!$name) or (!$pass) or ($pass != $pass2) or (!$desig) )
	{
		header("Location:signup.php?Field is empty!");
		exit();
	}

	$_SESSION['username'] = $_POST['username'];
	$_SESSION['fullname'] = $_POST['fullname'];
	$_SESSION['designation'] = $_POST['designation'];

	if($desig=="supervisor"){

		$sql = "SELECT * FROM 'supervisor' where username='$name' and password='$pass'";
		$rs = mysqli_query($conn, $sql);
		$rows=mysqli_num_rows($rs);


		if($rows==0)
    	{
        	$sql = "INSERT INTO supervisor(username, name, email, password) VALUES ('$name', '$fullname', '$email', '$pass')";
			mysqli_query($conn, $sql);

			
			header("Location: home.php?Successfullysignedup");
			exit();
    	}
    	else
    	{
        	header("Location: signin.php ? You have already registered. please Sign in...");
			exit();
    	}
	}
	else{
		$sql = "SELECT * FROM `student` where username='$name' and password='$pass'";
		$rs = mysqli_query($conn, $sql);
		$rows=mysqli_num_rows($rs);


		if($rows==0)
    	{
        	$sql = "INSERT INTO student(username, name, email, password) VALUES ('$name', '$fullname', '$email', '$pass')";
			mysqli_query($conn, $sql);

			header("Location: home.php?Successfullysignedup");
			exit();
    	}
    	else
    	{
        	header("Location: signin.php ? You have already registered. please Sign in...");
			exit();
    	}
	}
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Project Proposals</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<div id="header">
		<header>
			<font size="10">
				<b>Project Proposals</b>
			</font>
		</header>
	</div>


	<div id="navbar">
		<ul>
			<li> <a href="signin.php">Sign In</a> </li>
			<li> <a href="signup.php">Sign Up</a> </li>
		</ul>
	</div>


	<div align="center">
		
		<form  action="signup.php" method="post" enctype="multipart/form-data">

				<div class="row" style="text-align:left;">
					<label for="username">Username:</label><br />
					<input class="input" name="username" type="text" size="30" ><br />
				</div>

				<div class="row" style="text-align:left;">
					<label for="email">Email:</label><br />
					<input id="email" class="input" name="email" type="email" value="" size="30" ><br />
				</div>

				<div class="row" style="text-align:left;">
					<label for="fullname">Fullname:</label><br />
					<input id="fullname" class="input" name="fullname" type="text" value="" size="30" /><br />
				</div>

				<div class="row" style="text-align:left;">
					<label for="designation">Are you 'student' or 'supervisor' ?</label><br />
					<input id="designation" class="input" name="designation" type="text" value="" size="30" /><br />
				</div>

				<div class="row" style="text-align:left;">
					<label for="password">Password:</label><br />
					<input id="password" class="input" name="password" type="password" value="" size="30" ><br />
				</div>

				<div class="row" style="text-align:left;">
					<label for="password">Confirm Password:</label><br />
					<input id="password" class="input" name="Password2" type="password" value="" size="30" ><br />
				</div>

				<div  style="text-align: left;">
					<!-- <input type="hidden" name="action" value="submit"/> -->
					<input id="submit_button" name="submit_button" type="submit" value="Sign Up" >					
				</div>

				<div class="row" style="text-align: left;">
					Already have an account? <a href="signin.php">Sign In</a>
				</div>

			</form>
		

	</div>


	<div id="footer">
		Copright &copy; atmfaisal
	</div>

</body>