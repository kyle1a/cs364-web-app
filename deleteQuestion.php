<?php

	$username = 'student';
	$password = "CompSci364";
	$database = "student"
	
	$conn = new mysqli("localhost", $username, $password, $database);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$question = $conn->real_escape_string($_POST['question']);
	
	$stmt = $conn->prepare("DELETE FROM Questions SET WHERE question = ?");
	$stmt->bind_param("sss", $unit, $question, $answer);
	
	if ($stmt->execute()) {
		echo "Question successfully deleted!";
	} else {
		echo "Error: " . $stmt->error;
	}
	
	$stmt->close();
	$conn->close();
?>
