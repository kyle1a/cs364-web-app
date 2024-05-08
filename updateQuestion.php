<?php

	$username = 'student';
	$password = "CompSci364";
	$database = "student"
	
	$conn = new mysqli("localhost", $username, $password, $database);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$unit = $conn->real_escape_string($_POST['unit']);
	$question = $conn->real_escape_string($_POST['question']);
	$answer = $conn->real_escape_string($_POST['answer']);
	
	$stmt = $conn->prepare("UPDATE Questions SET unit = ?, question = ?, answer = ? WHERE question = ?");
	$stmt->bind_param("sss", $unit, $question, $answer);
	
	if ($stmt->execute()) {
		echo "Question successfully updated!";
	} else {
		echo "Error: " . $stmt->error;
	}
	
	$stmt->close();
	$conn->close();
?>
