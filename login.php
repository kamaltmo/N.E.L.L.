<?php

	session_start(); // Start Session
	$error=''; //Store error messages
	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is invalid";
		} else {

		//grab username and password
		$uName = $_POST['username'];
		$pWord = $_POST['password'];

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "nell";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			header("Location: index.html");
			$error = "Connection failed: " . $conn->connect_error;
		} else {
			$sql = "SELECT * FROM lecturers WHERE username = '$uName' AND password = '$pWord'";
			$result = $conn->query($sql);
            $conn->close(); 

	            if ($result->num_rows == 1) {
					// Initializing Session

					while ($row = $result->fetch_assoc()) { 
						$_SESSION['login_user'] = $row['username'];  
					}

					if($_SESSION['login_user'] == "admin") {
						$_SESSION['admin'] = '1';
						header("location: adminPage.php");
					} else {
						$_SESSION['admin'] = '0';
						header("location: profile.php");
					}
    				//Redirect to page on login success

				} else {
					$error = "Username or Password is invalid";
				}
			}
		}
	}