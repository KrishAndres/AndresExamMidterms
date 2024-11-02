<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';


function validateFields($fields) {
	foreach ($fields as $field) {
		if (empty($field)) {
			return false;
		}
	}
	return true;
}



if (isset($_POST['registerUserBtn'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $phone_number = $_POST['phone_number'];

    if (validateFields([$username, $password, $first_name, $last_name, $address, $age, $phone_number])) {
        $insertQuery = insertNewUser($pdo, $username, $password, $first_name, $last_name, $address, $age, $phone_number);
        if ($insertQuery) {
            header("Location: ../login.php");
        } else {
            header("Location: ../register.php");
        }
    } else {
        $_SESSION['message'] = "Please make sure all input fields are filled out for registration!";
        header("Location: ../register.php");
    }
}

if (isset($_POST['loginUserBtn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (validateFields([$username, $password])) {
        $loginQuery = loginUser($pdo, $username, $password);
        if ($loginQuery) {
            header("Location: ../index.php");
        } else {
            header("Location: ../login.php");
        }
    } else {
        $_SESSION['message'] = "Please make sure all input fields are filled out for login!";
        header("Location: ../login.php");
    }
}

if (isset($_GET['logoutAUser'])) {
    unset($_SESSION['username']);
    unset($_SESSION['user_id']);
    header('Location: ../login.php');
    exit();
}



if (isset($_POST['insertCoachBtn'])) {
	$fields = [$_POST['coachName'], $_POST['email'], $_POST['experience'],$_POST['specialization'], $_POST['websiteUrl']];
	if (validateFields($fields)) {
		$query = insertCoach($pdo, $_POST['coachName'], $_POST['email'], $_POST['experience'],$_POST['specialization'], $_POST['websiteUrl']);
		if ($query) {
			header("Location: ../index.php");
		} else {
			echo "Insertion failed";
		}
	} else {
		echo "All fields must be filled out";
	}
}

if (isset($_POST['editCoachBtn'])) {
	$fields = [$_POST['coachName'], $_POST['email'], $_POST['experience'],$_POST['specialization'], $_POST['websiteUrl']];
	if (validateFields($fields)) {
		$query = updateCoach($pdo, $_POST['coachName'], $_POST['email'], $_POST['experience'],$_POST['specialization'], $_POST['websiteUrl'], $_GET['coach_id']);
		if ($query) {
			header("Location: ../index.php");
		} else {
			echo "Edit failed";
		}
	} else {
		echo "All fields must be filled out";
	}
}

if (isset($_POST['deleteCoachBtn'])) {
	$query = deletecoach($pdo, $_GET['coach_id']);
	if ($query) {
		header("Location: ../index.php");
	} else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertPlayerBtn'])) {
	$fields = [$_POST['playerName'], $_POST['email'], $_POST['preferredGame']];
	if (validateFields($fields)) {
		$query = insertPlayer($pdo, $_POST['playerName'], $_POST['email'], $_POST['preferredGame'], $_GET['coach_id']);
		if ($query) {
			header("Location: ../viewplayer.php?coach_id=" . $_GET['coach_id']);
		} else {
			echo "Insertion failed";
		}
	} else {
		echo "All fields must be filled out";
	}
}

if (isset($_POST['editPlayerBtn'])) {
	$fields = [$_POST['playerName'], $_POST['email'], $_POST['preferredGame']];
	if (validateFields($fields)) {
		$query = updatePlayer($pdo, $_POST['playerName'], $_POST['email'], $_POST['preferredGame'], $_GET['player_id']);
		if ($query) {
			header("Location: ../viewplayer.php?coach_id=" . $_GET['coach_id']);
		} else {
			echo "Update failed";
		}
	} else {
		echo "All fields must be filled out";
	}
}

if (isset($_POST['deletePlayerBtn'])) {
	$query = deleteplayer($pdo, $_GET['player_id']);
	if ($query) {
		header("Location: ../viewplayer.php?coach_id=" . $_GET['coach_id']);
	} else {
		echo "Deletion failed";
	}
}

?>
