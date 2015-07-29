<?php
	session_start();
	if(isset($_SESSION['stu_id'])) {
		if(session_destroy()) // Destroying All Sessions
		{
			header("Location: studentLogin.php"); // Redirecting To Home Page
		}
	} else {
		if(session_destroy()) // Destroying All Sessions
		{
			header("Location: index.php"); // Redirecting To Home Page
		}
	}
?>