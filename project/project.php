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
			<b>Projects retrived from Database</b> <br><br>
		</font>
		<?php
			
			$query = "SELECT * FROM proposal";
			$result = mysqli_query($conn,$query);
			$tot = mysqli_num_rows($result);

			if($tot>0){
				echo "<table> <tr>
					<th> Username </th>
					<th> Teammate </th>
					<th> Title </th>
					<th> Status </th>
					<th>Review</th>
					</tr>";

			while ($data = $result->fetch_assoc()) {
				echo ("<tr>
					<td>".$data["username"]."</td>
					<td>".$data["teammate"]."</td>
					<td>".$data["title"]."</td> 
					<td>".$data["status"]."</td>

					<td><form action=\"review.php\" method=\"post\">
						<input name=\"student\" type=\"hidden\" value=\"".$data["username"]."\"/>
						<input type=\"submit\" value=\"review\"/>
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
