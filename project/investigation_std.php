<?php

	include 'connection.php';

	if(isset($_POST['submit_button']))
	{
		$answer = $_POST['answer'];
		$student = $_POST['student'];
			

		if( (!$answer) )
		{
			header("Location:investigation_std.php?Field is empty!");
			exit();
		}

			mysqli_query($conn, "UPDATE investigation SET answer='$answer' WHERE username='$student'");

			header("Location: profile.php?SuccessfullyAnswered");
				
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
		<font size="5"> 
			Projects of <?php echo $_SESSION['fullname']  ?> <br><br>
		</font>
		<?php
			
			$student = $_SESSION['username'];

				$query = "SELECT * FROM investigation WHERE username='$student'";
				$result = mysqli_query($conn,$query);
				$tot = mysqli_num_rows($result);

				if($tot>0){
					echo "<table><tr>
						<th>Question</th>
						<th>Answer</th>
					</tr>";

					while ($data = $result->fetch_assoc()) {
						echo "<tr>
							<td>".$data["question"]."</td>
							<td>".$data["answer"]."</td>
						</tr>";
					}
					echo "</table>";
				}
				else{
					echo "No results found!";
				}

		?>
<br> <br> <font size="5">
			Investigation for <?php echo $_SESSION['fullname'] ?>'s project: <br><br>
		</font>

		<form  action="investigation_std.php" method="post" enctype="multipart/form-data">

				<div class="row" style="text-align:left;">
					<label for="answer">Answer</label><br />
					<input id="answer" class="input" name="answer" type="text" value="" size="30" /><br />
				</div>

				<div  style="text-align: left;">
					<!-- <input type="hidden" name="action" value="submit"/> -->
					<input name="student" type="hidden" value= <?php echo ('"'); echo $_SESSION['username']; echo ('"');?> />

					<input id="submit_button" name="submit_button" type="submit" value="Submit" >					
				</div>

			</form>

	</div>


	<div id="footer">
		Copright &copy; atmfaisal
	</div>

</body>
