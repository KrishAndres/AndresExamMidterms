<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DeletePlayer</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getPlayerByID = getPlayerByID($pdo, $_GET['player_id']); ?>
	<h1>Are you sure you want to delete this player?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Player Name: <?php echo $getPlayerByID['player_name'] ?></h2>
		<h2>Email: <?php echo $getPlayerByID['email'] ?></h2>
		<h2>Preffered Game: <?php echo $getPlayerByID['preferred_game'] ?></h2>
		<h2>Date Added: <?php echo $getPlayerByID['date_added'] ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">

			<form action="core/handleForms.php?player_id=<?php echo $_GET['player_id']; ?>&coach_id=<?php echo $_GET['coach_id']; ?>" method="POST">
				<input type="submit" name="deletePlayerBtn" value="Delete">
			</form>			
			
		</div>	

	</div>
</body>
</html>
