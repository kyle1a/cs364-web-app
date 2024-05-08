<?php
	/* Embedding account credentials isn't ideal...preferable to
	 * store in a separate file that is included by PHP (and not
	 * accessible to others)
	 */
	$username = "student";
	$password = "CompSci364";
	$database = "student";

	$connection = new mysqli("localhost", $username, $password, $database);

	$tables = <<<SQL

	DROP TABLE Example;  
	CREATE TABLE IF NOT EXISTS Example  
	(
	  firstName VARCHAR(20) NOT NULL,  
	  lastName VARCHAR(20) NOT NULL,
	  username VARCHAR(20) NOT NULL,
	  passwords VARCHAR(20) NOT NULL,
	  type ENUM NOT NULL,

	  PRIMARY KEY (username),
	      ON UPDATE RESTRICT ON DELETE RESTRICT  
	);
	
	SQL;
?>
<!DOCTYPE html>
<html>
<body>
<center>
	<p>Sign Up Successful!</p><br>
</center>	

	<center>
	<nav>
        	<a href="index.html">Home Page</a>
	</nav>
	</center>
</body>
</html>
