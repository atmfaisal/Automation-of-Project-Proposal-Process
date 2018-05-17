<?php
include 'connection.php';

if(isset($_POST['submit_button']))
{
	$status = $_POST['status'];
	$comment = $_POST['comment'];
	$student = $_POST['student'];
		

	if( (!$status) )
	{
		header("Location:review.php?Field is empty!");
		exit();
	}


	mysqli_query($conn, "UPDATE proposal SET status='$status', comment='$comment' WHERE username='$student'");

		header("Location: project.php?SuccessfullyReviewed");
		exit();

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
			?>

			<li> <a href="profile.php"> <?php echo $_SESSION['fullname'] ?> </a> </li>
			<li> <a href="signout.php">Sign Out</a> </li>
			
		</ul>
	</div>


	<div align="center" style="padding: 5em">
		<font size="5">
			Projects of <?php echo $_POST['student'] ?> <br><br>
		</font>
		<?php
			
			$student = $_POST['student'];

				$query = "SELECT * FROM proposal WHERE username='$student';";
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

		?>
<br> <br> <font size="5">
			Review for <?php echo $_POST['student']; ?>'s project: <br><br>
		</font>

		<form  action="review.php" method="post" enctype="multipart/form-data">

				<div class="row" style="text-align:left;">
					<label for="status">Status:</label><br />
					<input id="status" class="input" name="status" type="text" value="" size="30" /><br />
				</div>

				<div class="row" style="text-align:left;">
					<label for="comment">Comment</label><br />
					<input id="comment" class="input" name="comment" type="text" value="" size="30" /><br />
				</div>

				<div  style="text-align: left;">
					<!-- <input type="hidden" name="action" value="submit"/> -->
					<input name="student" type="hidden" value= <?php echo ('"'); echo $_POST['student']; echo ('"');?> />


					<input id="submit_button" name="submit_button" type="submit" value="Submit" >					
				</div>

			</form>

	</div>


	<div id="footer">
		Copright &copy; atmfaisal
	</div>

</body>
