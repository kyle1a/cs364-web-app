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
                        
                    // Retrieve submitted answers
                    $submittedAnswers = $_POST;
                    
$hiddenFieldValues = array();
foreach ($_POST as $key => $value) {
    if (strpos($key, 'question') === 0) {
        // This is a hidden field with the name starting with 'question'
        $hiddenFieldValues[$key] = $value;
    }
}

// Now $hiddenFieldValues contains the hidden field values
// You can use the values as needed
foreach ($hiddenFieldValues as $key => $value) {
    echo "Hidden field name: " . htmlspecialchars($key) . ", Value: " . htmlspecialchars($value) . "<br>";
}
                    
                    // Iterate through submitted answers
                    //as $questionId => $submittedAnswer
                    foreach ($submittedAnswers as $submittedAnswer) {
                    echo $submittedAnswer;
                        // Get the correct answer from the database
                        $sql = "SELECT question, answer FROM Questions WHERE answer = '$submittedAnswer'";
                        $result = $connect->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $correctAnswer = $row["answer"];
                            
                            // Check if the submitted answer is incorrect
                            if ($submittedAnswer !== $correctAnswer) {
                                // Update the 'wrong' field to true
                                $sql = "UPDATE Questions SET wrong = true WHERE answer = '$submittedAnswer'";
                                $connect->query($sql);
                            } else {
                                // Update the 'wrong' field to false
                                $sql = "UPDATE Questions SET wrong = false WHERE answer = '$submittedAnswer'";
                                $connect->query($sql);
                            }
                        }
                    }
                    
                    // Retrieve the missed questions with the 'wrong' field set to true
                    $sql = "SELECT * FROM Questions WHERE wrong = true ORDER BY unit ASC";
                    $result = $connect->query($sql);

                    if ($result->num_rows > 0) {             
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr> <td>" . htmlspecialchars($row["question"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["answer"]) . "</td>";   
                            echo "<td>" . htmlspecialchars($row["unit"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["attempts"]) . "</td></tr>";
                        }         
                    } else {
                        echo "<tr><td colspan='4'>No missed questions found.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    
    </center>
</body>
</html>
