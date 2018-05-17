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


	<div align="center" style="padding: 2em">
		<font size="7">
			<?php echo $_SESSION['fullname'] ?>
		</font><br><br><br>
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
				
				$name = $_SESSION['username'];

				$query = "SELECT * FROM proposal WHERE username='$name';";
				$result = mysqli_query($conn,$query);
				$tot = mysqli_num_rows($result);

				if($tot>0){
					echo "<table><tr><th>Username</th> <th>Teammate</th> <th>Title</th> <th>Summary</th> <th>Platform</th> <th>Status</th> <th>Comment</th></tr>";

					while ($data = $result->fetch_assoc()) {
						echo "<tr><td>".$data["username"]."</td> <td>".$data["teammate"]."</td> <td>".$data["title"]."</td> <td>".$data["summary"]."</td> <td>".$data["platform"]."</td> <td>".$data["status"]."</td> <td>".$data["comment"]."</td>
							</tr>";
					}
					echo "</table>";
				}
				else{
					echo "No results found!";
				}

				echo '<br><br>';

				echo ("<button onclick=\"location.href='profile.php'\">Go Back</button>");
			}

		?>
	</div>


	<div id="footer">
		Copright &copy; atmfaisal
	</div>

</body>
