<?php

	$username = 'student';
	$password = "CompSci364";
	$database = "student";
	
	$conn = new mysqli("localhost", $username, $password, $database);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$unit = $_POST['unit'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];
	$prevquestion = $_POST['prevquestion'];
	
	$stmt = $conn->prepare("UPDATE Questions SET question = ?, answer = ?, unit = ? WHERE question = ?");
	$stmt->bind_param("ssss", $question, $answer, $unit, $prevquestion);
	
	if ($stmt->execute()) {
		echo "Question successfully updated!";
		header("Location: questionBank.php");
	} else {
		echo "Error: " . $stmt->error;
	}
	
	$stmt->close();
	$conn->close();
?>
