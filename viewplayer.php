<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
	<script>
		function validatePlayerForm() {
			var playerName = document.forms["playerForm"]["playerName"].value;
			var email = document.forms["playerForm"]["email"].value;
			var preferredGame = document.forms["playerForm"]["preferredGame"].value;
			if (playerName == "" || email == "" || preferredGame == "") {
				alert("All fields must be filled out");
				return false;
			}
		}
	</script>
</head>
<body>
	<a href="index.php">Return to home</a>
	<?php $getCoachByID = getCoachByID($pdo, $_GET['coach_id']); ?>
	<h1>Coach Name: <?php echo $getCoachByID['coach_name']; ?></h1>
	<h1>Add New Player</h1>
	<form name="playerForm" action="core/handleForms.php?coach_id=<?php echo $_GET['coach_id']; ?>" method="POST" onsubmit="return validatePlayerForm()">
		<p>
			<label for="playerName">Player Name</label> 
			<input type="text" name="playerName">
		</p>
		<p>
			<label for="email">Email</label> 
			<input type="email" name="email">
		</p>
		<p>
			<label for="preferredGame">Preffered Game</label> 
			<input type="text" name="preferredGame">
			<input type="submit" name="insertPlayerBtn">
		</p>
	</form>

	<table style="width:100%; margin-top: 50px;">
	  <tr>
	    <th>Player ID</th>
	    <th>Player Name</th>
	    <th>Email</th>
	    <th>Preffered Game</th>
	    <th>Date Added</th>
	    <th>Action</th>
	  </tr>
	  <?php 
	  $getPlayersByCoach = getPlayersByCoach($pdo, $_GET['coach_id']); 
	  if ($getPlayersByCoach) {
	      foreach ($getPlayersByCoach as $row) { ?>
	      <tr>
	      	<td><?php echo $row['player_id']; ?></td>	  	
	      	<td><?php echo $row['player_name']; ?></td>	  	
	      	<td><?php echo $row['email']; ?></td>	  	
	      	<td><?php echo $row['preferred_game']; ?></td>	  	
	      	<td><?php echo $row['date_added']; ?></td>
	      	<td>
	      		<a href="editplayer.php?player_id=<?php echo $row['player_id']; ?>&coach_id=<?php echo $_GET['coach_id']; ?>">Edit</a>

	      		<a href="deleteplayer.php?player_id=<?php echo $row['player_id']; ?>&coach_id=<?php echo $_GET['coach_id']; ?>">Delete</a>
	      	</td>	  	
	      </tr>
	  <?php } 
	  } else {
	      echo "<tr><td colspan='6'>No Players found for this Coach.</td></tr>";
	  }
	  ?>
	</table>

	
</body>
</html>
