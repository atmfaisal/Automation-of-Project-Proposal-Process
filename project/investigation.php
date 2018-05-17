<?php
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


	<div align="center" style="padding: 5em">
		<font size="5">
			<b>Accepted Projects</b> <br><br>
		</font>
		<?php

			$query = "SELECT * FROM proposal WHERE status='Accepted'";
			$result = mysqli_query($conn,$query);
			$tot = mysqli_num_rows($result);

			if($tot>0){
				echo "<table> <tr>
					<th> Username </th>
					<th> Teammate </th>
					<th> Title </th>
					<th>Investigate</th>
					</tr>";

			while ($data = $result->fetch_assoc()) {
				echo ("<tr>
					<td>".$data["username"]."</td>
					<td>".$data["teammate"]."</td>
					<td>".$data["title"]."</td> 

					<td><form action=\"investigate.php\" method=\"post\">
						<input name=\"student\" type=\"hidden\" value=\"".$data["username"]."\"/>
						<input type=\"submit\" value=\"Investigate\"/>
					</form> </td>
					 </tr>");
					}
				echo "</table>";
			}
			else{
					echo "No results found!";
				}

		?>
	</div>


	<div id="footer">
		Copright &copy; atmfaisal
	</div>

</body>
