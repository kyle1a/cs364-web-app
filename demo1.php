<?php
$servername = "localhost";
$username = "student";
$password = "CompSci364";
$database = "student";

// Create connection
$connect = new mysqli($servername, $username, $password, $database)
  or die("Could not connect to database;" . mysqli_error());

// normally only a single query is executed, but batch table crea
$unit = $_POST["unit"];
$question = $_POST["question"];
$answer = $_POST["answer"];

// Prepare and bind an SQL statement
$stmt = $connect->prepare("INSERT INTO Questions (question, answer, unit, wrong, attempts) VALUES (?, ?, ?, FALSE, 0)");
$stmt->bind_param("sss", $question, $answer, $unit);

// Execute the statement
if ($stmt->execute()) {
    echo "Question added successfully!";
    header("Location: questionBank.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$connect->close();
?>

