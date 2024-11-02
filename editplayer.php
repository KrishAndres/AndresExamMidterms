<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>EditPlayer</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="viewplayer.php?coach_id=<?php echo $_GET['coach_id']; ?>">
	View The Players</a>
	<h1>Edit the Player Details</h1>
	<?php $getPlayerByID = getPlayerByID($pdo, $_GET['player_id']); ?>
	<form action="core/handleForms.php?player_id=<?php echo $_GET['player_id']; ?>&coach_id=<?php echo $_GET['coach_id']; ?>" method="POST">
		<p>
			<label for="playerName">Player Name</label> 
			<input type="text" name="playerName" value="<?php echo $getPlayerByID['player_name']; ?>">
		</p>
		<p>
			<label for="email">Email</label> 
			<input type="email" name="email" value="<?php echo $getPlayerByID['email']; ?>">
		</p>
		<p>
			<label for="preferredGame">Preferred Game </label> 
			<input type="text" name="preferredGame" value="<?php echo $getPlayerByID['preferred_game']; ?>">
			<input type="submit" name="editPlayerBtn">
		</p>
	</form>
</body>
</html>
