

CREATE TABLE userLog (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    address VARCHAR(255),
    age INT,
    phone_number VARCHAR(15),
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE coachTable (
    coach_id INT PRIMARY KEY AUTO_INCREMENT,
    coach_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    experience INT NOT NULL,
    specialization VARCHAR(100) NOT NULL,
    website_url VARCHAR(100),
    date_added DATE NOT NULL,
    added_by INT,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_updated_by INT,
    FOREIGN KEY (added_by) REFERENCES userLog(user_id),
    FOREIGN KEY (last_updated_by) REFERENCES userLog(user_id)
);

CREATE TABLE playerTable (
    player_id INT PRIMARY KEY AUTO_INCREMENT,
    player_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    preferred_game VARCHAR(100) NOT NULL,
    coach_id INT,
    date_added DATE NOT NULL,
    FOREIGN KEY (coach_id) REFERENCES coachTable(coach_id),
    added_by INT,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_updated_by INT,
    FOREIGN KEY (coach_id) REFERENCES coachTable(coach_id),
    FOREIGN KEY (added_by) REFERENCES userLog(user_id),
    FOREIGN KEY (last_updated_by) REFERENCES userLog(user_id)
);


