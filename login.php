<?php
	/* Embedding account credentials isn't ideal...preferable to
	 * store in a separate file that is included by PHP (and not
	 * accessible to others)
	 */
	$username = "student";
	$password = "CompSci364";
	$database = "student";

	$conn = new mysqli("localhost", $username, $password, $database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$username = $conn->real_escape_string($_POST['username']);
	$password = $_POST['password'];

	$query = "SELECT username, pass FROM users WHERE username = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt->store_result();
	
	if ($stmt->num_rows > 0) {
	
		$stmt->bind_result($username, $passwordHash);
		$stmt->fetch();
		if (password_verify($pass, $passwordHash)) {
			echo "Welcome $username!";
		} else {
			echo "Invalid password";
		}
	} else { 
		echo "Invalid username";
	}
	
	$stmt->close();
	$conn->close();
?>
