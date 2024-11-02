<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>EditCoach</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getCoachByID = getCoachByID($pdo, $_GET['coach_id']); ?>
	<h1>Edit the Coach Details</h1>
	<form action="core/handleForms.php?coach_id=<?php echo $_GET['coach_id']; ?>" method="POST">
		<p>
			<label for="coachName">Coach Name</label> 
			<input type="text" name="coachName" value="<?php echo $getCoachByID['coach_name']; ?>">
		</p>
		<p>
			<label for="email">Email</label> 
			<input type="email" name="email" value="<?php echo $getCoachByID['email']; ?>">
		</p>
		<p>
			<label for="experience">Experience</label> 
			<input type="text" name="experience" value="<?php echo $getCoachByID['experience']; ?>">
		</p>
		<p>
			<label for="specialization">Specialization</label> 
			<input type="text" name="specialization" value="<?php echo $getCoachByID['specialization']; ?>">
		</p>
		<p>
			<label for="websiteUrl">Website URL</label> 
			<input type="url" name="websiteUrl" value="<?php echo $getCoachByID['website_url']; ?>">
			<input type="submit" name="editCoachBtn">
		</p>
	</form>
</body>
</html>
