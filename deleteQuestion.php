<?php

	$username = 'student';
	$password = "CompSci364";
	$database = "student";
	
	$conn = new mysqli("localhost", $username, $password, $database);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$question = $_POST["question"];

	$SQL = "DELETE FROM Questions WHERE question = '$question';";
    $result = $conn->query($SQL);
	
	$stmt = $conn->prepare("DELETE FROM Questions WHERE question = ?");
	$stmt->bind_param("s", $question);
	
	if ($stmt->execute()) {
		echo "Question successfully deleted!";
		header("Location: questionBank.php");
	} else {
		echo "Error: " . $stmt->error;
	}
	
	$stmt->close();
	$conn->close();
?>
