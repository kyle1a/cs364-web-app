<?php
	/* Embedding account credentials isn't ideal...preferable to
	 * store in a separate file that is included by PHP (and not
	 * accessible to others)
	 */
	$username = "student";
	$password = "CompSci364";
	$database = "student";

	$connection = new mysqli("localhost", $username, $password, $database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$username = $conn->real_escape_string($_POST['username']);
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$firstName = $conn->real_escape_string($_POST['firstName']);
	$lastName = $conn->real_escape_string($_POST['lastName']);
	$type = $conn->real_escape_string($_POST['type']);

	$stmt = $conn->prepare("INSERT INTO users.sql (username, password, first_name, last_name, type) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("sssss", $username, $password, $firstName, $lastName, $type);
	
	if ($stmt->execute()) {
		echo "User successfully signed up!";
	} else {
		echo "Error: " . $stmt->error;
	}
	
	$stmt->close();
	$conn->close();
?>
