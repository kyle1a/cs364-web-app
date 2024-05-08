<!DOCTYPE html>
<html>
<head>
    <center>
        <img src="logo.png" width="300" height="250"/>
    </center>
    <title>Study Buddy Question Bank</title>
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
    
    <h2>Question Bank</h2>
    
    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Correct Answer</th>
                <th>Unit</th>
                <th>Actions</th>
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
                while ($row = $result->fetch_assoc()) { 
                    $a = 1;
                    $thisquestion = $row["question"];
                    $thisanswer = $row["answer"];
                    $thisunit = $row["unit"];

                    echo "<tr> <td>" . htmlspecialchars($row["question"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["answer"]) . "</td>";   
                    echo "<td>" . htmlspecialchars($row["unit"]) . "</td>";
                    
                    echo "<td>
                    <form action=\"updateQuestionPage.php\" method=\"post\">
                        <input type=\"hidden\" name=\"question\" value=\"$thisquestion\">
                        <input type=\"hidden\" name=\"answer\" value=\"$thisanswer\">
                        <input type=\"hidden\" name=\"unit\" value=\"$thisunit\">
                        <input type=\"submit\" value=\"Update\">
                    </form>
                    <form action=\"deleteQuestion.php\" method=\"post\">
                        <input type=\"hidden\" name=\"question\" value=\"$thisquestion\">
                        <input type=\"submit\" value=\"Delete\">
                    </form>
                    </td>
                    </tr>";
                    $a++;
                }         
            } 
            ?>
        </tbody>
    </table>
    </center>
</body>
</html>

