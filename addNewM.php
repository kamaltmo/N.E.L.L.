<?php
	/*
		
		Allows and Admin to create modules that will set up with a pre-determined structure
	
	*/
	
	//**************************************************************************************************
	//	JOBS:
	//		-	Check to see that the person is logged on as admin (under session_starts())
	//		-	Add 'Cancel' or 'Back' buttons to each page
	//		-	Redo
	//**************************************************************************************************
	
	//**************************************************************************************************
	//	POSSIBLE ERRORS:
	//		-	1:	Module already exists
	//**************************************************************************************************
	
	session_start();
	//Check they're logged on etc.
	
	//if lecturer not admin redirect to there page
	if(isset($_SESSION['login_user'])){
		if($_SESSION['admin'] == '0') {
            header("location: profile.php");
    	}
	} else {
		header("location: index.php");
	}
	
	define ("DB_HOST", "localhost");
	define ("DB_USER", "root");
	define ("DB_PASS", "");
	define ("DB_NAME", "nell");
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
	
	$created = 0;
	if(isset($_POST["submit1"]))
	{
		if(isset($_POST["modCode"]))
		{
			if(!(strlen($_POST["modCode"]) > 0 && ctype_digit(substr($_POST["modCode"], 0, 1))))
			{
				$created = 1;
				$_SESSION["modCode"] = $_POST["modCode"];
			}
			else
			{
				$created = 4;
			}
		}
	}
	if(isset($_POST["submit2"]))
	{
		$duplicate = mysql_query("SELECT mod_code FROM modules WHERE mod_code = '" . $_SESSION["modCode"] . "'");
		if(mysql_num_rows($duplicate) == 0)
		{
			$created = 2;
			if(isset($_SESSION["returnToLec"]))
				$created = 3;
		}
		else
			errorMessage("Module already exists");
	}
	
	function errorMessage($code)
	{
		echo '
			<form action="addLec.php" method="post" enctype="multipart/form-data">
				<div class = "form-group">
					<h1>
						Error ' . $code . '
					</h1>
					<br/>
					' . $_SESSION["modCode"] . ' could not be created<br/>
				</div>
				<div class = "form-group">
					<a href = "adminPage.php">
						Click here to return to the Administrative Homepage
					</a>
				</div>
			</form>';
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Create a new Module</title>
		<meta name="description" content="This page enables the administrator of the N.E.L.L. system to add modules"/>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="css/jquery.min.js"></script>
        <script type="text/javascript" src="css/bootstrap.min.js"></script>
        <link href="css/font-awesome.min.css"
        rel="stylesheet" type="text/css">
        <link href="css/bootstrap.css"
        rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="navbar navbar-default navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
						<span class="sr-only"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="adminPage.php"><span>N.E.L.L. Admin</span></a>
				</div>
				<div class="collapse navbar-collapse" id="navbar-ex-collapse">
					<ul class="nav navbar-nav navbar-right"></ul>
				</div>
			</div>
		</div>
		<div class="section">
			<div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="well well-lg">
							<?php
								switch($created)
								{
									//Enter the code of the module
									case 0:
										echo'
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data" autocomplete="off">
												<div class = "form-group">
													<label class = "control-label">
														Module Code
													</label>
													<input type = "text" name = "modCode" autocomplete="off" maxlength = "9"/>
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit1" value = "Create Module"/>
												</div>
											</form>';
										break;
									// Confirm that you want to create that module
									case 1:
										echo '
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data">
												<div class = "form-group">
													<label class = "control-label">
														Are you sure you want to create ' . $_SESSION["modCode"] . '?
													</label>
													<input type = "submit" name = "submit2" value = "Create"/>
												</div>
											</form>';
										break;
									// Module has been created, would you like to add a lecturer? Sends to addLec.php
									case 2:
										// Create a new Database
										$sql = "CREATE DATABASE " . $_SESSION["modCode"];
										if(mysql_query($sql, $link))
										{	
											// Add the tables to the new database
											$db = mysql_select_db($_SESSION["modCode"], $link) or die("Couldn't select database");
											if(
											$query = mysql_query("CREATE TABLE students
											(
												student_id int NOT NULL,
												email varchar (255),
												password varchar (255),
												first_name varchar (20),
												last_name varchar (30),
												PRIMARY KEY (student_id)
											)") &&
											$query = mysql_query("CREATE TABLE glossary
											(
												term_id int NOT NULL,
												term varchar (255),
												definition varchar (500),
												PRIMARY KEY (term_id)
											)") &&
											$query = mysql_query("CREATE TABLE multi_questions
											(
												question_id int NOT NULL,
												question varchar (255),
												answer1 varchar (255),
												answer2 varchar (255),
												answer3 varchar (255),
												answer4 varchar (255),
												answer5 varchar (255),
												status int NOT NULL DEFAULT 0,
												PRIMARY KEY (question_id)
											)") &&
											$query = mysql_query("CREATE TABLE free_text_questions
											(
												question_id int NOT NULL,
												question varchar (255),
												answer varchar (255),
												status int NOT NULL DEFAULT 0,
												PRIMARY KEY (question_id)
											)") &&
											$query = mysql_query("CREATE TABLE queries
											(
												student_id int NOT NULL,
												query varchar (500),
												FOREIGN KEY (student_id) REFERENCES students (student_id) 
											)"))
											{
												// Successfully created the new Database
												echo '
												<form action="addLec.php" method="post" enctype="multipart/form-data">
													<div class = "form-group">
														<h1>
															' . $_SESSION["modCode"] . ' has been created
														</h1>
													</div>
													<div class = "form-group">
														<label class = "control-label">
															Add a lecturer?
														</label>
														<input type = "submit" name = "fromCreated" value = "Add a Lecturer"/>
														<br/>
														<a href = "adminPage.php">
															Click here to return to the Administrative Homepage
														</a>
													</div>
												</form>';
												
												// Add the module to the modules list if all was successful
												$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
												$insertModule = mysql_query("insert into modules (mod_code) values('".$_SESSION["modCode"]."');");
											}
										}
										else
										{
											// Failed to create the new Database
											echo '
												<div class = "form-group">
													<label class = "control-label">
														' . $_SESSION["modCode"] . ' could not be created <br/>
														Does this module already exist?
													</label>
												</div>
												<div class = "form-group">
													<a href = "adminPage.php">
														Click here to return to the Administrative Homepage
													</a>
												</div>';
										}
										break;
									// Send user back to the page they came from with module info
									case 3:
										// Create a new Database
										$sql = "CREATE DATABASE " . $_SESSION["modCode"];
										if(mysql_query($sql, $link))
										{	
											// Add the tables to the new database
											$db = mysql_select_db($_SESSION["modCode"], $link) or die("Couldn't select database");
											if(
											$query = mysql_query("CREATE TABLE students
											(
												student_id int NOT NULL,
												email varchar (255),
												password varchar (255),
												first_name varchar (20),
												last_name varchar (30),
												PRIMARY KEY (student_id)
											)") &&
											$query = mysql_query("CREATE TABLE glossary
											(
												term_id int NOT NULL,
												term varchar (255),
												definition varchar (500),
												PRIMARY KEY (term_id)
											)") &&
											$query = mysql_query("CREATE TABLE multi_questions
											(
												question_id int NOT NULL,
												question varchar (255),
												answer1 varchar (255),
												answer2 varchar (255),
												answer3 varchar (255),
												answer4 varchar (255),
												PRIMARY KEY (question_id)
											)") &&
											$query = mysql_query("CREATE TABLE free_text_questions
											(
												question_id int NOT NULL,
												question varchar (255),
												answer varchar (255),
												PRIMARY KEY (question_id)
											)") &&
											$query = mysql_query("CREATE TABLE queries
											(
												student_id int NOT NULL,
												query varchar (500),
												FOREIGN KEY (student_id) REFERENCES students (student_id) 
											)"))
											{
												// Successfully created the new Database
												echo '
												<form action="addLec.php" method="post" enctype="multipart/form-data">
													<div class = "form-group">
														<h1>
															' . $_SESSION["modCode"] . ' has been created
														</h1>
													</div>
													<div class = "form-group">
														<label class = "control-label">
															Return to Adding the Lecturer?
														</label>
														<input type = "submit" name = "fromCreated" value = "Add a Lecturer"/>
														<br/>
														<a href = "adminPage.php">
															Click here to return to the Homepage
														</a>
													</div>
												</form>';
												
												// Add the module to the modules list if all was successful
												$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
												$insertModule = mysql_query("insert into modules (mod_code) values('".$_SESSION["modCode"]."');");
											}
										}
										else
										{
											//Failure
											echo '
												<div class = "form-group">
													<label class = "control-label">
														' . $_SESSION["modCode"] . ' could not be created
													</label>
												</div>
												<div class = "form-group">
													<a href = "addLec.php">
														Return to Adding a lecturer
													</a>
												</div>';
										}
										break;
									case 4:
										echo'
											<h3>The module code cannot start with a number</h3>
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data" autocomplete="off">
												<div class = "form-group">
													<label class = "control-label">
														Module Code
													</label>
													<input type = "text" name = "modCode" autocomplete="off" maxlength = "9"/>
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit1" value = "Create Module"/>
												</div>
											</form>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>