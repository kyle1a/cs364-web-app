<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Study Buddy Flashcards</title>
	<link rel ="stylesheet" href="csl.css" id="styleSheet">
	<style>
		body {
            		display: flex;
           		flex-direction: column;
            		align-items: center;
            		background-color: #f0f0f0; /* Light gray background */
            		margin: 0;
        	}

        	.flashcard-container {
            		display: flex;
            		flex-direction: column;
            		justify-content: center;
            		gap: 20px;
            		padding: 20px;
            		width: 100%;
            		max-width: 500px;
        	}
		.card-wrapper {
			width: 300px;
			height: 200px; 
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
			color: #000;
			border: 2px solid #ccc;
			border-radius: 8px;
			background-color: #fff;
			box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
		}
		.card-back {
			transform: rotateY(180deg);
		}
	</style>
</head>
<body>
	<center>
	<header>
		<a href="index.html">Home Page</a> |
        	<a href="flashcards.php">Flashcards</a> |
        	<a href="questions.html">Create Questions</a> |
        	<a href="testpage.html">Generate Test</a> |
        	<a href="missedQuestions.html">Missed Questions</a> | 
   		<a href="questionBank.html">Question Bank</a>
	</header>
	<div class="flashcard-container">
		<h1>Flashcards</h1>
		<?php
		
		$username = "student";
		$password = "CompSci364";
		$database = "student";
		
		$conn = new mysqli("localhost", $username, $password, $database);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = 'SELECT question, answer FROM Questions';
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
                	echo '<p>No questions</p>';
                }
                
         	$conn->close();
         	?>
         </div>
         </center>
</body>
</html>               		
                		
