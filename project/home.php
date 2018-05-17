<?php
session_start();
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
				echo '<li> <a href="investigation.php">Investigation</a> </li>';
				}
				else
				{
					echo '<li> <a href="ac_project.php">Accepted Projects</a> </li>';
					echo '<li> <a href="rejected.php">Rejected Ideas</a> </li>';
				}
			?>

			<li> <a href="profile.php"> <?php echo $_SESSION['fullname'] ?> </a> </li>
			<li> <a href="signout.php">Sign Out</a> </li>
		</ul>
	</div>


	<div id="body">
		<font size="5">
			Everything begins with an <b>!dea</b>
		</font>

		<br><br>

		<font size="7">
			Ideas into Action...
		</font>
	</div>


	<div id="footer">
		Copyright &copy; atmfaisal
	</div>

</body>
