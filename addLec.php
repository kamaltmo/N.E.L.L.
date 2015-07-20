<?php
	/*
		
		Admin can assign Lecturers to modules (only one per module)
	
	*/
	
	//**************************************************************************************************
	//	JOBS:
	//		-	Check to see that the person is logged on as admin (under session_starts())
	//		-	Ask if they want to replace the current lecturer if a lecturer already exists
	//**************************************************************************************************
	
	session_start();
	//Check they're logged on etc.
	
	// When a clean slate is needed
	//$_SESSION["returnToLec"] = NULL;
	//$_SESSION["modCode"] = NULL;
	//$_POST["submit1"] = NULL;
	$section = 0;
	$returnValue = "0";
	
	//****************** 0 - MODULE ******************
	if(isset($_POST["fromCreated"]) || $_SESSION["returnToLec"] == "submit1")
	{
		// There is already a module selected, so set the lecturer
		$section = 1;
		$modCode = $_SESSION["modCode"];
		$_POST["fromCreated"] = NULL;
		$returnValue = "";
	}
	if(isset($_POST["submit1"]))
	{
		// A module has just been selected, so check to see if it's 'new'
		$section = 1;
		$modCode = $_POST["modOption"];
		if($modCode == "new")
		{
			$section = 2;
			$_SESSION["returnToLec"] = "submit1";
		}
		else
		{
			$_SESSION["modCode"] = $modCode;
		}
	}
	
	//****************** 1 - LECTURER ******************
	if($_SESSION["returnToLec"] == "submit2" || isset($_SESSION["lecCode"]))
	{
		if($section != 2)
		{
			if($_SESSION["modCode"] == "")
			{
				// Enter the modCode
				$section = 0;
			}
			else
			{
				// A lecturer has just been created, go to confirmation
				$section = 4;
				$returnValue = "";
			}
		}
	}
	elseif(isset($_POST["submit2"]))
	{
		// A lecturer has just been selected, so check to see if it's 'new'
		$section = 4;
		$lecCode = $_POST["lecOption"];
		$_SESSION["lecCode"] = $lecCode;
		if($lecCode == "new")
		{
			$section = 3;
			$_SESSION["returnToLec"] = "submit2";
		}
	}
	
	//****************** 4 - CONFIRMATION PAGE ******************
	if(isset($_POST["Submit3"]))
	{
		$modCode = $_SESSION["modCode"];
		$lecCode = $_SESSION["lecCode"];
		$section = 4;
	}
	
	//****************** 5 - RECIPT PAGE ******************
	if(isset($_POST["finalSubmit"]))
	{
		$modCode = $_SESSION["modCode"];
		$lecCode = $_SESSION["lecCode"];
		$section = 5;
	}
	
	//Set up database details
	define ("DB_HOST", "localhost");
	define ("DB_USER", "root");
	define ("DB_PASS", "");	
	define ("DB_NAME", "nell");
	
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Set the lecturer of a module</title>
		<meta name="description" content="This page enables the administrator of the N.E.L.L. system to a assign lecturers to modules"/>
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
									// Select a module, have an option to create a new module
									case 0:
										echo '
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data">
												<div class = "form-group">
													<label class = "control-label">
														Select Module
													</label>
													<select name = "modOption">';
														$query = mysql_query("SELECT mod_code FROM modules");
														while($row = mysql_fetch_array($query))
														{
															echo '<option value = "' . $row["mod_code"] . '">' . $row["mod_code"] . '</option>';
														}
										echo '			<option value = "new"> Add a new Module </option>
													</select>
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit1" value = "Next"/>
												</div>
											</form>';
										break;
									// Select a lecturer, option to add a lecturer
									case 1:
										echo '
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data">
												<div class = "form-group">
													<label class = "control-label">
														Select a Lecturer for ' . $_SESSION["modCode"] . '
													</label>
													<select name = "lecOption">';
														$query = mysql_query("SELECT first_name, last_name, lecturer_id FROM lecturers");
														while($row = mysql_fetch_array($query))
														{
															echo '<option value = "' . $row["lecturer_id"] . '">' . $row["last_name"] . ', ' . $row["first_name"] . '</option>';
														}
										echo '			<option value = "new"> Add new Lecturer </option>
													</select>
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit2" value = "Next"/>
												</div>
											</form>';
										break;
									// Create a new module
									case 2:
										echo '
											<div class = "form-group">
												<a href = "addNewM.php">
													Click here to create a new Module
												</a>
											</div>';
										break;
									// Create a new lecturer
									case 3:
										echo '<div class = "form-group">
											<a href = "addNewLec.php">
												Click here to create a new Lecturer
											</a>
										</div>';
										break;
									// Confirmation page: are you sure the details are correct?
									case 4:
										echo '
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data">
												<div class = "form-group">
													<label class = "control-label">
														Module 
													</label>
													' . $_SESSION["modCode"] . '
												</div>
												<div class = "form-group">
													<label class = "control-label">
														Lecturer
													</label>';
													$query = mysql_query('SELECT first_name, last_name FROM lecturers WHERE lecturer_id = "' . $_SESSION["lecCode"] . '"');
													$row = mysql_fetch_array($query);
													echo ' ' . $row["last_name"] . ', ' . $row["first_name"] . '
												</div>
												<div class = "form-group">
													<input type = "submit" name = "finalSubmit" value = "Confirm"/>
												</div>
											</form>';
										break;
									// Page that adds all data to database and gives a receipt
									case 5:
										$query = mysql_query("UPDATE modules SET lecturer_id = '" . $lecCode . "' WHERE mod_code = '" . $_SESSION["modCode"] . "'");
										echo '
											<div class = "form-group">
												<label class = "control-label">
													All Done!
												</label>
											</div>
											<div class = "form-group">
												<a href = "adminPage.php">
													Click here to return to the Administrative Homepage
												</a>
											</div>';
										$_SESSION["returnToLec"] = NULL;
										$_SESSION["modCode"] = NULL;
										$_POST["submit1"] = NULL;
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>