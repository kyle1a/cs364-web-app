<!DOCTYPE html>
<head>
<center>
	<img src="logo.png" width="300" height="250"/>
</center>
    <title>Study Buddy Update Question</title>
    <link rel="stylesheet" href="csl.css" id="styleSheet">
    	<script src="script.js" defer></script>
    
  
  
</head>
<body>
    <header>
    	<center>
	<nav>
        	<a href="index.html">Home Page</a> |
        	<a href="flashcards.html">Flashcards</a> |
        	<a href="questions.html">Create Questions</a> |
        	<a href="testpage.html">Generate Test</a> |
        	<a href="missedQuestions.php">Missed Questions</a> | 
   		<a href="questionBank.php">Question Bank</a>
	</nav>
        </center>
    </header>
    
    <main>
		<center>
        <?php
            $username = 'student';
            $password = "CompSci364";
            $database = "student";
            
            $conn = new mysqli("localhost", $username, $password, $database);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }
        ?>
        <h2>Update Questions</h2>
        <form action="updateQuestion.php" method="post">
            <input type="hidden" name="prevquestion" <?php $question = $_POST["question"]; echo "value=$question"; ?> >
            
            <label for="unit">Unit:</label>
            <input type="text" id="unit" name="unit" <?php $unit = $_POST["unit"]; echo "value=$unit"; ?> required maxlength="50" pattern="[0-9]{1,25}"><br><br>
            
            <label for="question">Question:</label>
            <input style="height:100px; width:500px" type="text" id="question" name="question" <?php $question = $_POST["question"]; echo "value=$question"; ?> required maxlength="50" pattern="[A-Za-z.0-9\-]{1,150}">
            
            <label for="answer">Answer:</label>
            <input style="height:100px; width:500px" type="text" id="answer" name="answer" <?php $answer = $_POST["answer"]; echo "value=$answer"; ?> required maxlength="50" pattern="[A-Za-z._@0-9\-]{1,150}">
            
           
            </center>
            <center>
            
            
            <br><br><input type="submit" value="Submit">
            
            </center>
        </form>
    </main>
    
</body>
</html>
