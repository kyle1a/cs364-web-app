USE student;

-- DROP TABLE users;
CREATE TABLE IF NOT EXISTS users (
	username VARCHAR(50) NOT NULL,
	pass VARCHAR(100) NOT NULL,
	firstName VARCHAR(50) NOT NULL,
	lastName VARCHAR(50) NOT NULL, 
	type ENUM('student', 'teacher') NOT NULL,
	
	PRIMARY KEY(username)
);
	

