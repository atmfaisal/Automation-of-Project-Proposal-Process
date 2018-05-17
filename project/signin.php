<?php

/*session_start();*/
if(isset($_SESSION['username'])){
    header("location: index.php");
}


include 'connection.php';


if(isset($_POST['submit_button']))
{
	$name = $_POST['username'];
	$pass = $_POST['password'];
	$desig = $_POST['designation'];

	if( (!$name) or (!$pass) or (!$desig) )
	{
		header("Location:signin.php?Field is empty!");
		exit();
	}

	$_SESSION['username'] = $_POST['username'];
	$_SESSION['designation'] = $_POST['designation'];

	if ($desig=="supervisor") {
		$sql = "SELECT * FROM supervisor where username='$name' and password='$pass'";
		$rs = mysqli_query($conn, $sql);
		$rows=mysqli_num_rows($rs);
		$info = mysqli_fetch_assoc($rs);

		if($rows != 0)
		{
			$_SESSION['fullname'] = $info['name'];

			header("Location: home.php?Successfullysignedin");
			exit();
		}
		else{
			header("Location: signin.php?Try again");
			exit();
		}
	}
	else{
		$sql = "SELECT * FROM student where username='$name' and password='$pass'";
		$rs = mysqli_query($conn, $sql);
		$rows=mysqli_num_rows($rs);
		$info = mysqli_fetch_assoc($rs);

		if($rows != 0)
		{

			$_SESSION['fullname'] = $info['name'];
			
			header("Location: home.php?Successfullysignedin");
			exit();
		}
		else{
			header("Location: signin.php?Here Try again");
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



	<div id="table">
<!-- <form id="contact_form"></form> -->
		<form  action="signin.php" method="POST" enctype="multipart/form-data"> 

			<div class="row" style="text-align:left;">
					<label for="name">Username:</label><br />
					<input id="name" class="input" name="username" type="text" value="" size="30" /><br /><br>
				</div>

				<div class="row" style="text-align:left;">
					<label for="password">Password:</label><br />
					<input id="password" class="input" name="password" type="password" value="" size="30" /><br /><br>
				</div>

				<div class="row" style="text-align:left;">
					<label for="designation">Are you 'student' or 'supervisor' ?</label><br />
					<input id="designation" class="input" name="designation" type="text" value="" size="30" /><br />
				</div>

				<br>

				<div  style="text-align: left;">
					<input type="hidden" name="action" value="submit"/>
					<input id="submit_button" type="submit" name="submit_button" value="Sign In" />					
				</div>

				<div class="row" style="text-align: left;">
					Not registered? <a href="signup.php">Create an account</a>
				</div>
			
		</form>

	</div>


	<div id="footer">
		Copyright &copy; atmfaisal
	</div>

</body>
