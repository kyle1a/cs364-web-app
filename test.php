<!DOCTYPE html>
<html>
<head>
    <center>
        <img src="logo.png" width="300" height="250"/>
    </center>
    <title>Study Buddy Test</title>
    <link rel="stylesheet" href="csl.css" id="styleSheet">
</head>
<body>
    <center>
        <nav>
            <a href="index.html">Home Page</a> |
            <a href="flashcards.html">Flashcards</a> |
            <a href="questions.html">Create Questions</a> |
            <a href="testpage.html">Generate Test</a> |
            <a href="missedQuestions.html">Missed Questions</a> 
        </nav>
        <form action="missedQuestions.php", method="POST">
        <?php
            $servername = "localhost";
            $username = "student";
            $password = "CompSci364";
            $database = "student";
           
           
            $connect = new mysqli($servername, $username, $password, $database)
            or die("Could not connect to database;" . mysqli_error());
            $unit = $_POST["unit"];
            echo "<h2> Unit $unit Test</h2>";                
         
            $SQL = "SELECT * FROM Questions WHERE unit = $unit;";
            $result = $connect->query($SQL);
         
            
           
            $SQL_all_answers = "SELECT answer, question FROM Questions;";
            $result_all_answers = $connect->query($SQL_all_answers);
            $all_answers = [];
            while ($row = $result_all_answers->fetch_assoc()) {
                $all_answers[] = $row["answer"];
            }
         
            if ($result->num_rows > 0) {             
                // Output data for each row
                $a = 0;
                while ($row = $result->fetch_assoc()) { 

                    echo "<p>" . htmlspecialchars($row["question"]) . "</p>";
                    // Generate a set of answers for the question
                    $answers = [$row["answer"]];
                    while (count($answers) < 4) {
                        $random_answer = $all_answers[array_rand($all_answers)];
                        if (!in_array($random_answer, $answers)) {
                            $answers[] = $random_answer;
                        }
                    }
            
                    shuffle($answers);
                    
                    echo '<div class="inline-radio">';
                    for ($i = 0; $i < 4; $i++) {
                    	$thisanswer = htmlspecialchars($answers[$i]);
                 	$thisquestion = $row["question"];
                 	echo $thisquestion;
                        echo " <input type=\"hidden\" name=\"question\" value=\"$thisquestion\"><input type=\"radio\" id=\"q$a$i\" name=\"q$a\" value=\"$thisanswer\"> <label for=\"q$a$i\">" . htmlspecialchars($answers[$i]) . "</label><div>";  
                    }
                    echo '</div>';
                    $a++;
                }         
            }
        ?>
        <br><br><input type="submit" value="Submit test"><br><br><br>
        </form>
    </center>
</body>
</html>
