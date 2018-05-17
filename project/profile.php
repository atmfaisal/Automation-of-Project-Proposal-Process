<?php
/* session_start(); */
include 'connection.php';
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
			<font size="7">
				<b>PROJECT PROPOSALS</b>
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


	<div align="center" style="padding: 5em">
		<font size="7">
			<?php echo $_SESSION['fullname'] ?>
		</font><br>
		<?php
			
			$desig = $_SESSION['designation'];
			if($desig=="supervisor"){

				$query = "SELECT * FROM student;";
				$result = mysqli_query($conn,$query);
				$tot = mysqli_num_rows($result);
				
				
				echo 'Currently supervising ';
				echo $tot;
				echo ' students';
			}
			else{
				echo '<font size="5">Project Status</font><br><br>';
				
				$name = $_SESSION['username'];


				$query = "SELECT * FROM proposal WHERE username='$name';";
				$result = mysqli_query($conn,$query);
				$tot = mysqli_num_rows($result);

				if($tot==0)
				{
					echo ("<button onclick=\"location.href='proposal.php'\">Proposal Submission</button>");
					echo "<br><br>";
				}
				else
				{
					echo "<b>Proposal:</b> Submitted. || ";
					echo '<font>     <b>Status:</b> </font>';
					$que = "SELECT status FROM proposal WHERE username='$name';";
					$res = mysqli_query($conn,$que);
					while ($data = $res->fetch_assoc()) {
						//print_r($data);
						if($data["status"])
						{
							echo $data["status"];
						}
						else
						{
							echo "Pending";
						}
						//printf("%s \n",$data["status"]);
					}
					echo '<br><br>';
				}


				$result2 = "SELECT answer FROM investigation WHERE username='$name';";
				$res2 = mysqli_query($conn, $result2);
				while($data2 = $res2->fetch_assoc()){
					if($data2["answer"])
					{
							echo "<b>Investigation Phase Status: </b> Completed.";
							echo '<br><br>';
					}
					else
					{
						echo ("<button onclick=\"location.href='investigation_std.php'\">Investigation Phase</button>");
						echo "<br><br>";
					}
				}

				echo ("<button onclick=\"location.href='overview.php'\">Let Me See My Project</button>");
			}

		?>
	</div>


	<div id="footer">
		Copright &copy; atmfaisal
	</div>

</body>
