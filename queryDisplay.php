<?php
	/* 
		Queries:
			*	should be displayed to the right of questionResults.php as a resizeable view
			
			***************************************************************************************************************************
			JOBS:
				*	Add login
				*	Change 'comp103' to $_SESSION["modCode"] or similar
				*	Add the student_id of the student logged in to the insert command
			***************************************************************************************************************************
			
			***************************************************************************************************************************
			ERRORS:
				*	103.1:	Could not add the query to the queries table, maybe there is no student with that id on the system
			***************************************************************************************************************************
	*/
	session_start();
	define ("DB_HOST", "localhost");
	define ("DB_USER", "root");
	define ("DB_PASS", "");	
	define ("DB_NAME", "comp103");
	
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
?>