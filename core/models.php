<?php  

require_once 'dbConfig.php';

function insertNewUser($pdo, $username, $password, $first_name, $last_name, $address, $age, $phone_number) {
    $checkUserSql = "SELECT * FROM userLog WHERE username = ?";
    $checkUserSqlStmt = $pdo->prepare($checkUserSql);
    $checkUserSqlStmt->execute([$username]);

    if ($checkUserSqlStmt->rowCount() == 0) {
        $sql = "INSERT INTO userLog (username, password, first_name, last_name, address, age, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$username, $password, $first_name, $last_name, $address, $age, $phone_number]);

        if ($executeQuery) {
            $_SESSION['message'] = "User successfully registered";
            return true;
        } else {
            $_SESSION['message'] = "An error occurred during registration";
        }
    } else {
        $_SESSION['message'] = "Username already exists";
    }
}

function loginUser($pdo, $username, $password) {
    $sql = "SELECT * FROM userLog WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() == 1) {
        $userInfoRow = $stmt->fetch();
        $usernameFromDB = $userInfoRow['username']; 
        $passwordFromDB = $userInfoRow['password'];

        if (password_verify($password, $passwordFromDB)) {
            $_SESSION['username'] = $usernameFromDB;
            $_SESSION['user_id'] = $userInfoRow['user_id'];
            $_SESSION['message'] = "Login successful!";
            return true;
        } else {
            $_SESSION['message'] = "Password is invalid, but user exists";
        }
    } else {
        $_SESSION['message'] = "Username doesn't exist in the database. Please Register first";
    }
}


function insertCoach($pdo, $coach_name, $email, $experience, $specialization ,$website_url) {

	$sql = "INSERT INTO coachTable (coach_name, email, experience, specialization, website_url, date_added) VALUES(?,?,?,?,?,NOW())";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$coach_name, $email, $experience, $specialization, $website_url]);

	if ($executeQuery) {
		return true;
	}
}



function updateCoach($pdo, $coach_name, $email, $experience, $specialization, $website_url, $coach_id) {

	$sql = "UPDATE coachTable
				SET coach_name = ?,
					email = ?,
					experience = ?, 
					specialization =?,
					website_url = ?
				WHERE coach_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$coach_name, $email, $experience,$specialization, $website_url, $coach_id]);
	
	if ($executeQuery) {
		return true;
	}

}


function deletecoach($pdo, $coach_id) {
	$deleteCoachPlayer = "DELETE FROM coachTable WHERE coach_id = ?";
	$deleteStmt = $pdo->prepare($deleteCoachPlayer);
	$executeDeleteQuery = $deleteStmt->execute([$coach_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM coachTable WHERE coach_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$coach_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllCoach($pdo) {
	$sql = "SELECT * FROM coachTable";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getCoachByID($pdo, $coach_id) {
	$sql = "SELECT * FROM coachTable WHERE coach_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$coach_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}





function getPlayersByCoach($pdo, $coach_id) {
	
	$sql = "SELECT 
				playerTable.player_id AS player_id,
				playerTable.player_name AS player_name,
				playerTable.email AS email,
				playerTable.preferred_game AS preferred_game,
				playerTable.date_added AS date_added,
				coachTable.coach_name AS coach_name
			FROM playerTable
			JOIN coachTable ON playerTable.coach_id = coachTable.coach_id
			WHERE playerTable.coach_id = ? 
			GROUP BY playerTable.player_name;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$coach_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertPlayer($pdo, $player_name, $email, $preferred_game, $coach_id) {
	$sql = "INSERT INTO playerTable (player_name, email, preferred_game, coach_id, date_added) VALUES (?,?,?,?,NOW())";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$player_name, $email, $preferred_game, $coach_id]);
	if ($executeQuery) {
		return true;
	}

}

function getPlayerByID($pdo, $player_id) {
	$sql = "SELECT 
				playerTable.player_id AS player_id,
				playerTable.player_name AS player_name,
				playerTable.email AS email,
				playerTable.preferred_game AS preferred_game,
				playerTable.date_added AS date_added,
				coachTable.coach_name AS coach_name
			FROM playerTable
			JOIN coachTable ON playerTable.coach_id = coachTable.coach_id
			WHERE playerTable.player_id  = ? 
			GROUP BY playerTable.player_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$player_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updatePlayer($pdo, $player_name, $email, $preferred_game, $player_id) {
	$sql = "UPDATE playerTable
			SET player_name = ?,
				email = ?,
				preferred_game = ?
			WHERE player_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$player_name, $email, $preferred_game, $player_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteplayer($pdo, $player_id) {
	$sql = "DELETE FROM playerTable WHERE player_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$player_id]);
	if ($executeQuery) {
		return true;
	}
}

?>
