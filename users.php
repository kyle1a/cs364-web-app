<?php
	/* Embedding account credentials isn't ideal...preferable to
	 * store in a separate file that is included by PHP (and not
	 * accessible to others)
	 */
	$username = "student";
	$password = "CompSci364";
	$database = "student";

	$conn = new mysqli("localhost", $username, $password, $database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	
	$username = $conn->real_escape_string($_POST['username']);
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
	$firstName = $conn->real_escape_string($_POST['firstName']);
	$lastName = $conn->real_escape_string($_POST['lastName']);

	$stmt = $conn->prepare("INSERT INTO users (username, pass, firstName, lastName) VALUES (?, ?, ?, ?)");
	$stmt->bind_param("ssss", $username, $password, $firstName, $lastName);
	

	$stmt = $conn->prepare("INSERT INTO users (username, pass, firstName, lastName) VALUES (?, ?, ?, ?)");
	$stmt->bind_param("ssss", $username, $password, $firstName, $lastName);
    
	if ($stmt->execute()) {
		echo "Question successfully updated!";
		header("Location: login.php");
	} else {
		echo "Error: " . $stmt->error;
	}
	
	$stmt->close();
	$conn->close();
?>
<!DOCTYPE html>
<html>
<body>
<center>
