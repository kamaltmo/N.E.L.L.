<?php
	/*
		
		Remove a lecturer from their module
	
	*/
	
	//**************************************************************************************************
	//	JOBS:
	//		-	Check to see that the person is logged on as admin (under session_starts())
	//**************************************************************************************************
	
	//**************************************************************************************************
	//	POSSIBLE ERRORS:
	//		-	4.1:	The references to the lecturer on the modules table could not be removed
	//		-	4.2:	Lecturer could not be deleted from the 'lecturers' table in the nell database
	//**************************************************************************************************
	
	session_start();
	//Check they're logged on etc.
	
	//if lecturer not admin redirect to there page
	if($_SESSION['admin'] == '0') {
            header("location: profile.php");
    }
	
	define ("DB_HOST", "localhost");
	define ("DB_USER", "root");
	define ("DB_PASS", "");
	define ("DB_NAME", "nell");
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
	
	$section = 0;
	
	//************* 0 - SELECT A LECTURER *************
	if(isset($_POST["submit1"]))
	{
		// A lecturer has been selected
		$_SESSION["selectedID"] = $_POST["selectedLec"];
		$query = mysql_query("SELECT first_name, last_name FROM lecturers WHERE lecturer_id = '" . $_SESSION["selectedID"]."'");
		$row = mysql_fetch_array($query);
		$_SESSION["f_name"] = $row["last_name"];
		$_SESSION["l_name"] = $row["first_name"];
		$section = 1;
	}
	
	//************* 1 - THIS LECTURER HAS x NUMBER OF MODULES, CONFIRM DELETION *************
	if(isset($_POST["submit2"]))
	{
		// Confirmation has taken place
		$section = 2;
	}
	
	//****************************************************************		FUNCTIONS		***********************************************************
	
	// Delete a lecturer that has no modules
	function removeLecNoMods()
	{
		if($query = mysql_query("DELETE FROM lecturers WHERE lecturer_id = " . $_SESSION["selectedID"]))
		{
			echo '
				<div class = "form-group">
					<h1>
						' . $_SESSION["l_name"] . ', ' . $_SESSION["f_name"] . ' has been deleted
					</h1>
				</div>
				<div class = "form-group">
					<a href = "adminPage.php">
						Click here to return to the Administrative Homepage
					</a>
				</div>';
		}
		else
		{
			$code = 4.2;
			errorMessage($code);
		}
		cleanup();
	}
	
	// Delete a lecturer that has some modules
	function removeLecWithMods()
	{
		// STEP 1: Remove all references to the lecturer
		if($query = mysql_query("UPDATE modules SET lecturer_id = NULL WHERE lecturer_id = " . $_SESSION["selectedID"]))
		{
			// STEP 2: Delete lecturer from the system
			if($query = mysql_query("DELETE FROM lecturers WHERE lecturer_id = " . $_SESSION["selectedID"]))
			{
				echo '
					<div class = "form-group">
						<h1>
							' . $_SESSION["l_name"] . ', ' . $_SESSION["f_name"] . ' has been deleted
						</h1>
					</div>
					<div class = "form-group">
						<a href = "adminPage.php">
							Click here to return to the Administrative Homepage
						</a>
					</div>';
			}
			else
			{
				$code = 4.2;
				errorMessage($code);
			}
		}
		else
		{
			$code = 4.1;
			errorMessage($code);
		}
		cleanup();
	}
	
	function errorMessage($errorCode)
	{
		echo '
			<div class = "form-group">
				<h1>
					Error ' . $errorCode . '
				</h1>
				<br/>
				<h3>
					' . $_SESSION["l_name"] . ', ' . $_SESSION["f_name"] . ' could not be deleted
				</h3>
			</div>
			<div class = "form-group">
				<a href = "adminPage.php">
					Click here to return to the Administrative Homepage
				</a>
			</div>';
		cleanup();
	}
	
	function cleanup()
	{
		$_SESSION["f_name"] = NULL;
		$_SESSION["l_name"] = NULL;
		$_SESSION["selectedID"] = NULL;
		$_SESSION["mods"] = NULL;
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Remove a lecturer from the N.E.L.L. system</title>
		<meta name="description" content="This page enables the administrator of the N.E.L.L. system to remove lecturers"/>
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
									case 0:
										echo '
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data">
												<div class = "form-group">
													<label class = "control-label">
														Select a Lecturer to Remove from the system
													</label>
													<select name = "selectedLec">';
														$query = mysql_query("SELECT first_name, last_name, lecturer_id FROM lecturers WHERE lecturer_id != 1");
														while($row = mysql_fetch_array($query))
														{
															echo '<option value = "' . $row["lecturer_id"] . '">' . $row["last_name"] . ', ' . $row["first_name"] . '</option>';
														}
										echo '		</select>
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit1" value = "Next"/>
												</div>
											</form>';
										break;
									case 1:
										echo '
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data">
												<div class = "form-group">
													<label class = "control-label">
														';
														echo $_SESSION["l_name"] . ', ' . $_SESSION["f_name"];
										echo				'
													</label><br/><br/>
													This lecturer is in charge of<br/>';
													$query = mysql_query("SELECT mod_code FROM modules WHERE lecturer_id = " . $_SESSION["selectedID"]);
													// The lecturer has modules
													if(mysql_num_rows($query) > 0)
													{
														$_SESSION["mods"] = true;
														while($row = mysql_fetch_array($query))
															echo $row["mod_code"] . "<br/>";
													}
													// The lecturer has no modules
													else
													{
														$_SESSION["mods"] = false;
														echo " no modules<br/><br/>";
													}
										echo		'
													Are you sure you want to delete this lecturer?<br/>
													NOTE: The modules above will not be deleted
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit2" value = "Confirm"/>
												</div>
											</form>';
										break;
									case 2:
										if($_SESSION["mods"] == true)
										{
											removeLecWithMods();
										}
										else
										{
											removeLecNoMods();
										}
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>