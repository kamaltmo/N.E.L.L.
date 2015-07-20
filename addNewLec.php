<?php
	/*
		
		Allows admin to delete Modules from the system
	
	*/
	
	//**************************************************************************************************
	//	JOBS:
	//		-	Check to see that the person is logged on as admin (under session_starts())
	//		-	Check for duplicates
	//		-	Add a 'Create a module for this lecturer' option
	//		-	Add a 'Are you sure you want to remove COMPX?' warning message - this is permanent etc.
	//**************************************************************************************************
	
	//**************************************************************************************************
	//	POSSIBLE ERRORS:
	//		-	3:
	//**************************************************************************************************
	
	session_start();
	//Check they're logged on etc.
	
	define ("DB_HOST", "localhost");
	define ("DB_USER", "root");
	define ("DB_PASS", "");
	define ("DB_NAME", "nell");
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
	
	$section = 0;
	
	//***************************
	//	  0 - Input Details
	//***************************
	if(isset($_POST["submit1"]))
	{
		if($_POST["fName"] != "")
		{
			$_SESSION["fName"] = $_POST["fName"];
			if($section != 1)
			{
				$section = 2;
			}
		}
		// Display error message
		else
		{
			$section = 1;
		}
		if($_POST["lName"] != "")
		{
			$_SESSION["lName"] = $_POST["lName"];
			if($section != 1)
				$section = 2;
		}
		// Display error message
		else
		{
			$section = 1;
		}
		if($_POST["email"] != "")
		{
			$_SESSION["email"] = $_POST["email"];
			if($section != 1)
				$section = 2;
		}
		// Display error message
		else
		{
			$section = 1;
		}
	}
	//***************************
	//	  1 - Error in Input
	//***************************
	if(isset($_POST["submit2"]))
	{
		// All details OK, recipt
		$section = 3;
	}
	
	//	***************************************
	//	*									  *
	//	* Create the lecturer in the database *
	//	*									  *
	//	***************************************
	function createUser()
	{
		// Generate Password
		$query = "SELECT SUBSTRING(MD5(RAND()) FROM 1 FOR 6)";
		$sql = mysql_query($query);
		$recResult = mysql_fetch_array($sql);
		$password = $recResult[0];
		
		// Generate ID number
		do
		{
			$id = 0;
			$id = mt_rand(1, 800);
			// Make sure one doesn't already exist with that id
			$query = mysql_query("SELECT lecturer_id FROM lecturers WHERE lecturer_id = $id");
			$recResult = mysql_fetch_array($sql);
			$exist = $recResult["lecturer_id"];	
		} while($exist != "");
		
		$query = mysql_query("INSERT INTO lecturers (lecturer_id, email, password, first_name, last_name) VALUES ('$id', '".$_SESSION["email"]."', '$password', '".$_SESSION["fName"]."', '".$_SESSION["lName"]."')")or die(mysql_error());
		
		if($query)
		{
			if($_SESSION["returnToLec"] == "")
			{
				// Success and return to homepage
				echo '
					<form action="addLec.php" method="post" enctype="multipart/form-data">
						<div class = "form-group">
							<h1>
								' . $_SESSION["fName"] . ', ' . $_SESSION["lName"] . ' has been added
							</h1>
						</div>
						<div class = "form-group">
							<label class = "control-label">
								Add a module for this lecturer?
							</label>
							<input type = "submit" name = "fromNLec" value = "Add a Module"/>
							<br/>
							<a href = "adminPage.php">
								Click here to return to the Administrative Homepage
							</a>
						</div>
					</form>';
					cleanup();
			}
			else
			{
				// Success and return to addLec
				$_SESSION["lecCode"] = $id;
				echo '
					<form action="addLec.php" method="post" enctype="multipart/form-data">
						<div class = "form-group">
							<h1>
								' . $_SESSION["fName"] . ', ' . $_SESSION["lName"] . ' has been added
							</h1>
						</div>
						<div class = "form-group">
							<label class = "control-label">
								Return to adding to a module?
							</label>
							<input type = "submit" name = "fromNLec" value = "Add a Module"/>
							<br/>
							<a href = "adminPage.php">
								Click here to return to the Administrative Homepage
							</a>
						</div>
					</form>';
			}
		}
		else
		{
			// Failure
			$_SESSION["lecCode"] = $id;
			echo '
				<form action="addLec.php" method="post" enctype="multipart/form-data">
					<div class = "form-group">
						<h1>
							Error 3
						</h1>
						<br/>
						' . $_SESSION["fName"] . ', ' . $_SESSION["lName"] . ' could not be created<br/>
						Are you sure they are not already in the Database?
					</div>
					<div class = "form-group">
						<a href = "adminPage.php">
							Click here to return to the Administrative Homepage
						</a>
					</div>
				</form>';
				cleanup();
		}
	}
	
	function cleanup()
	{
		$_SESSION["fName"] = NULL;
		$_SESSION["lName"] = NULL;
		$_SESSION["email"] = NULL;
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Add a lecturer to the N.E.L.L. system</title>
		<meta name="description" content="This page enables the administrator of the N.E.L.L. system to add lecturers"/>
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
								switch($section)
								{
									// Enter Lecturer details, all fields compulsory
									case 0:
										echo'
											<h3>All fields are compulsory</h3>
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data" autocomplete="off">
												<div class = "form-group">
													<label class = "control-label">
														First Name
													</label>
													<input type = "text" name = "fName" autocomplete="off"/>
												</div>
												<div class = "form-group">
													<label class = "control-label">
														Surname 
													</label>
													<input type = "text" name = "lName" autocomplete="off"/>
												</div>
												<div class = "form-group">
													<label class = "control-label">
														Email Address
													</label>
													<input type = "text" name = "email" autocomplete="off"/><br/>
													A password will be generated and sent to this address<br/>
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit1" value = "Create Lecturer"/>
												</div>
											</form>';
										break;
									// Input error: some fields not filled in
									case 1:
										echo'
											<h2>Some fields were not filled in</h2>
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data" autocomplete="off">
												<div class = "form-group">
													<label class = "control-label">
														First Name
													</label>
													<input type = "text" name = "fName" value = "' . $_SESSION["fName"] . '" autocomplete="off"/>
												</div>
												<div class = "form-group">
													<label class = "control-label">
														Surname 
													</label>
													<input type = "text" name = "lName" value = "' . $_SESSION["lName"] . '" autocomplete="off"/>
												</div>
												<div class = "form-group">
													<label class = "control-label">
														Email Address
													</label>
													<input type = "text" name = "email" value = "' . $_SESSION["email"] . '" autocomplete="off"/><br/>
													A password will be generated and sent to this address<br/>
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit1" value = "Create Lecturer"/>
												</div>
											</form>';
										break;
									// Check all details
									case 2:
										echo'
											<h2>Please Check the Details</h2>
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data">
												<div class = "form-group">
													<label class = "control-label">
														First Name
													</label>
												</div>
												<div class = "form-group">
													' . $_SESSION["fName"] .'
												</div>
												<div class = "form-group">
													<label class = "control-label">
														Surname 
													</label>
												</div>
												<div class = "form-group">
													' . $_SESSION["lName"] .'
												</div>
												<div class = "form-group">
													<label class = "control-label">
														Email Address
													</label>
												</div>
												<div class = "form-group">
													' . $_SESSION["email"] .'
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit2" value = "Create Lecturer"/>
												</div>
											</form>';
										break;
									case 3:
										createUser();
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>