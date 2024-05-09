<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Study Buddy Flashcards</title>
	<link rel ="stylesheet" href="csl.css" id="styleSheet">
	<style>
		.card-wrapper {
			width: 300px;
			height: 200px; 
			margin: 20px;
			cursor: pointer;
			perspective: 1000px;
		}
		.card-body {
			width: 100%;
			height: 100%;
			transition: transform 0.6s;
			transform-style: preserve-3d;
			position: relative;
		}
		.card-wrapper:hover .card-body{
			transform: rotateY(180deg);
		}
		.card-front, .card-back {
			position: absolute;
			width: 100%;
			height: 100%;
			backface-visibility: hidden;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 16px;
			padding: 10px;
			color: #fff;
			border: 1px solid #ccc;
			background-color: #007BFF;
		}
		.card-back {
			background-color: #28A745;
			transform: rotateY(180deg);
		}
	</style>
</head>
<body>
	<div style="text-align: center;">
		<h1>Flashcards</h1>
		<?php
		
		$username = "student";
		$password = "CompSci364";
		$database = "student";
		
		$conn = new mysqli("localhost", $username, $password, $database);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = 'SELECT question, answer FROM Questions;
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo '<div class="card-wrapper">';
                		echo '  <div class="card-body">';
                		echo '    <div class="card-front">';
                		echo '      <p>' . htmlspecialchars($row['question']) . '</p>';
                		echo '    </div>';
                		echo '    <div class="card-back">';
                		echo '      <p>' . htmlspecialchars($row['answer']) . '</p>';
                		echo '    </div>';
                		echo '  </div>';
                		echo '</div>';
                	}
                } else {
                	echo '<p>No questions</p>;
                }
                
         	$conn->close();
         	?>
         </div>
</body>
</html>               		
                		
