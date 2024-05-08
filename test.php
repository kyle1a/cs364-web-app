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
                
                // Create connection
                $connect = new mysqli($servername, $username, $password, $database)
                    or die("Could not connect to database;" . mysqli_error());
                
                $unit = $_POST["unit"];
                echo "<h2> Unit $unit Test</h2>";                

                $SQL = "SELECT * FROM Questions WHERE unit = $unit;";
                $result = $connect->query($SQL);

                if ($result->num_rows > 0) {             
                    // Output data for each row
                    $a = 0;
                    while ($row = $result->fetch_assoc()) { 
                        echo "<p>" . htmlspecialchars($row["question"]) . "</p>";
                        for ($i = 0; $i < 4; $i++) {
                            if($i == 0){
                                #make sure the answer is answer as $i == 0
                            }
                            echo "<input type=\"radio\" id=\"q$a$i\" name=\"q$a\" value=\"q$a$i\"> <label for=\"q$a$i\">" . htmlspecialchars($row["answer"]) . "</label>$a$i ";   
                        }
                        $a++;
                    }         
                } 

            ?>
            <br><br><input type="submit" value="Submit test"><br><br><br>
            </form>
        </center>

    </body>
</html>
