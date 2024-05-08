<!DOCTYPE html>
<html>
<head>
<center>
	<img src="logo.png" width="300" height="250"/>
</center>
	<title>Study Buddy Missed Questions</title>
	<link rel="stylesheet" href="csl.css" id="styleSheet">
    	
</head>
<body>
	<center>
	<nav>
        	<a href="index.html">Home Page</a> |
        	<a href="flashcards.html">Flashcards</a> |
        	<a href="questions.html">Create Questions</a> |
        	<a href="testpage.html">Generate Test</a> |
        	<a href="missedQuestions.php">Missed Questions</a> | 
   			<a href="questionBank.php">Question Bank</a>
	</nav>
    	
    	<h2>Missed Questions</h2>	    
    	<table>
        	<thead>
           	<tr>
                	<th>Missed Question</th>
               		<th>Correct Answer</th>
               		<th>Unit</th>
               		<th>Attempts</th>
            	</tr>
        	</thead>
        	<tbody>
				<?php
					$servername = "localhost";
					$username = "student";
					$password = "CompSci364";
					$database = "student";
					
					// Create connection
					$connect = new mysqli($servername, $username, $password, $database)
						or die("Could not connect to database;" . mysqli_error());
						
					$SQL = "SELECT * FROM Questions ORDER BY unit ASC";
					$result = $connect->query($SQL);

					if ($result->num_rows > 0) {             
						// Output data for each row
						#k = 0;
						while ($row = $result->fetch_assoc()) {
							#$name = $_POST["name$k"];
							#if ($name != q$k0) attempts++;
							#k++

							echo "<tr> <td>" . htmlspecialchars($row["question"]) . "</td>";
							echo "<td>" . htmlspecialchars($row["answer"]) . "</td>";   
							echo "<td>" . htmlspecialchars($row["unit"]) . "</td>";
							echo "<td>" . htmlspecialchars($row["attempts"]) . "
							</td>
							</tr>";
						}         
					} 
				?>
        	</tbody>
    	</table>
	
	</center>
</body>
</html>
