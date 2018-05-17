<?php
include 'connection.php';

if(isset($_POST['submit_button']))
{
	$question = $_POST['question'];
	$student = $_POST['student'];
		

	if( (!$question) )
	{
		header("Location:investigate.php?Field is empty!");
		exit();
	}

		$sql = "SELECT * FROM investigation where username='$student'";
		$rs = mysqli_query($conn, $sql);
		$rows=mysqli_num_rows($rs);


		if($rows==0)
    	{
        	$sql = "INSERT INTO investigation(username, question) VALUES ('$student', '$question')";
			mysqli_query($conn, $sql);

			
			header("Location: investigation.php?SuccessfullyAsked");
			exit();
    	}
    	else
    	{
        	mysqli_query($conn, "UPDATE investigation SET question='$question',  WHERE username='$student'");

			header("Location: Investigation.php?AlreadySuccessfullyReviewed");
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

				$query = "SELECT title, question, answer FROM proposal natural join investigation WHERE proposal.username='$student'";
				
				$result = mysqli_query($conn,$query);
				$tot = mysqli_num_rows($result);

				if($tot>0){
					echo "<table><tr>
						<th>Project Title</th>
						<th>Question</th>
						<th>Answer</th>
					</tr>";

					while ($data = $result->fetch_assoc()) {
						echo "<tr>
							<td>".$data["title"]."</td>
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
			Investigation for <?php echo $_POST['student']; ?>'s project: <br><br>
		</font>

		<form  action="investigate.php" method="post" enctype="multipart/form-data">

				<div class="row" style="text-align:left;">
					<label for="question">Question</label><br />
					<input id="question" class="input" name="question" type="text" value="" size="30" /><br />
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
