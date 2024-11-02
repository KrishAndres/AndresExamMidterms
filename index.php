<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gaming Coach Service</title>
	<link rel="stylesheet" href="styles.css">
	<script>
		function validateCoachForm() {
			var coachName = document.forms["coachForm"]["coachName"].value;
			var email = document.forms["coachForm"]["email"].value;
			var experience = document.forms["coachForm"]["experience"].value;
			var specialization = document.forms["coachForm"]["specialization"].value;
			var websiteUrl = document.forms["coachForm"]["websiteUrl"].value;
			if (coachName == "" || email == "" || experience == "" || specialization == "" || websiteUrl == "") {
				alert("All fields must be filled out");
				return false;
			}
		}
	</script>
</head>
<body>
<div class="header">
        <div class="right">
            <a href="core/handleForms.php?logoutAUser=1" class="logoutBtn">Logout</a>
        </div>
    </div>
	<h1>Welcome To Gaming Coach Service. Add new Coachs!</h1>
	<form name="CoachForm" action="core/handleForms.php" method="POST" onsubmit="return validateCoachForm()">
		<p>
			<label for="coachName">Coach Name</label> 
			<input type="text" name="coachName">
		</p>
		<p>
			<label for="email">Email</label> 
			<input type="email" name="email">
		</p>
		<p>
			<label for="experience">Experience</label> 
			<input type="text" name="experience">
		</p>
		<p>
			<label for="specialization">Specialization</label> 
			<input type="text" name="specialization">
		</p>
		<p>
			<label for="websiteUrl">Website URL</label> 
			<input type="url" name="websiteUrl">
			<input type="submit" name="insertCoachBtn">
		</p>
	</form>
	<?php $getAllCoach = getAllCoach($pdo); ?>
	<?php foreach ($getAllCoach as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 300px; margin-top: 20px;">
		<h3>Coach Name: <?php echo $row['coach_name']; ?></h3>
		<h3>Email: <?php echo $row['email']; ?></h3>
		<h3>Experience: <?php echo $row['experience']; ?></h3>
		<h3>Specialization: <?php echo $row['specialization']; ?></h3>
		<h3>Website URL: <?php echo $row['website_url']; ?></h3>
		<h3>Date Added: <?php echo $row['date_added']; ?></h3>


		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewplayer.php?coach_id=<?php echo $row['coach_id']; ?>">View Clients</a>
			<a href="editcoach.php?coach_id=<?php echo $row['coach_id']; ?>">Edit</a>
			<a href="deletecoach.php?coach_id=<?php echo $row['coach_id']; ?>">Delete</a>
		</div>


	</div> 
	<?php } ?>
</body>
</html>
