<?php

include 'connection.php';

if(isset($_POST['submit_button']))
{
	$teammate = $_POST['teammate'];
	$title = $_POST['title'];
	$summary = $_POST['summary'];
	$platform = $_POST['platform'];
	

	if( (!$teammate) or (!$title) or (!$summary) or (!$platform) )
	{
		header("Location:signup.php?Field is empty!");
		exit();
	}


	$sql = "SELECT * FROM 'proposal' where title='$title'";
	$rs = mysqli_query($conn, $sql);
	$rows=mysqli_num_rows($rs);

	$name = $_SESSION['username'];

	if($rows==0)
    {
        $sql = "INSERT INTO proposal(username, teammate, title, summary, platform) VALUES ('$name', '$teammate', '$title', '$summary', '$platform')";
		mysqli_query($conn, $sql);
	
		header("Location: profile.php?SuccessfullySubmitted");
		exit();
    }
    else{
       header("Location: proposal.php ? Already exists...");
		exit();
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
			<li> <a href="home.php">Home</a> </li>
			<li> <a href="about.php">About</a> </li>

			<?php
			$desig = $_SESSION['designation'];
			if($desig=="supervisor"){
				echo '<li> <a href="project.php">Projects</a> </li>';
				}
			?>

			<li> <a href="profile.php"> <?php echo $_SESSION['fullname'] ?> </a> </li>
			<li> <a href="signout.php">Sign Out</a> </li>
			
		</ul>
	</div>


	<div align="center">
		<font size="7">
			Proposal Submission
		</font><br><br>
		

		<form  action="proposal.php" method="post" enctype="multipart/form-data">

				<div class="row" style="text-align:left;">
					<label for="teammate">Teammate Name:</label><br />
					<input class="input" name="teammate" type="text" size="30" ><br />
				</div>

				<div class="row" style="text-align:left;">
					<label for="title">Project Title:</label><br />
					<input id="title" class="input" name="title" type="text" value="" size="30" ><br />
				</div>

				<div class="row" style="text-align:left;">
					<label for="summary">Project Summary:</label><br />
					<input id="summary" class="input" name="summary" type="text" value="" size="30" /><br />
				</div>

				<div class="row" style="text-align:left;">
					<label for="platform">Platform</label><br />
					<input id="platform" class="input" name="platform" type="text" value="" size="30" /><br />
				</div>

				<div  style="text-align: left;">
					<!-- <input type="hidden" name="action" value="submit"/> -->
					<input id="submit_button" name="submit_button" type="submit" value="Submit" >					
				</div>

			</form>

			<br><br>
		<?php
			echo ("<button onclick=\"location.href='profile.php'\">Go back</button>");
		?>

	</div>


	<div id="footer">
		Copright &copy; atmfaisal
	</div>

</body>
