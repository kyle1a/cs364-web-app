<?php
session_start(); // Start (or resume) session

// Create database connection ($connection)
$connection = new mysqli("localhost", "student", "CompSci364", "student");

$error = false;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"], $_POST["password"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        // Username or password is empty
        $error = true;
    } else {
        // Query database for account information
        $statement = $connection->prepare("SELECT pass FROM users WHERE username = ?;");
        $statement->bind_param("s", $_POST["username"]);

        $statement->execute();
        $statement->bind_result($password_hash);
        
        if ($statement->fetch() && password_verify($_POST["password"], $password_hash)) {
            // Password is correct, store the username to indicate authentication
            $_SESSION["username"] = $_POST["username"];
            
            // Redirect to index.html upon successful login
            header("Location: index.html");
            exit;
        } else {
            // Invalid username or password
            $error = true;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<?php
if ($error) {
    echo "<p style='color: red;'>Username or password incorrect.</p>";
}
?>
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
    <label for="username">Username</label>
    <input name="username" type="text" value="<?php if (isset($_POST["username"])) echo $_POST["username"]; ?>" />
    <label for="password">Password</label>
    <input name="password" type="password" />
    <input type="submit" value="Log in" />
</form>
</body>
</html>
