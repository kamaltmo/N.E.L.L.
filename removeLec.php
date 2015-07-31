<?php
	/*
		
		Remove a lecturer from their module
	
	*/
	
	//**************************************************************************************************
	//	JOBS:
	//**************************************************************************************************
	
	//**************************************************************************************************
	//	POSSIBLE ERRORS:
	//		-	6:	Lecturer could not be removed from the modules table
	//**************************************************************************************************
	include 'database_info.php';
	session_start();
	if(isset($_SESSION['login_user']))
	{
		if($_SESSION['admin'] == '0') 
		{
					header("location: profile.php");
		}
	} 
	else 
	{
		header("location: index.php");
	}
	
	//if lecturer not admin redirect to there page
	if(isset($_SESSION['login_user'])){
		if($_SESSION['admin'] == '0') {
            header("location: profile.php");
    	}
	} else {
		header("location: index.php");
	}
	
	$section = 0;
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
	
	// ************** 0 - Select module ***************
	if(isset($_POST["submit1"]))
	{
		$section = 1;
		$_SESSION["modCode"] = $_POST["modOption"];
		$query = mysql_query("SELECT lecturer_id FROM modules WHERE mod_code = '" . $_SESSION["modCode"] . "'");
		$row = mysql_fetch_row($query);
		$_SESSION["lecCode"] = $row[0];
		$query = mysql_query("SELECT first_name, last_name FROM lecturers WHERE lecturer_id = " . $_SESSION["lecCode"]);
		$row = mysql_fetch_row($query);
		$_SESSION["f_name"] = $row[0];
		$_SESSION["l_name"] = $row[1];
	}
	// ************** 1 - Confirm *****************
	if(isset($_POST["submit2"]))
	{
		$section = 2;
	}
	// ************** 2 - Recipt ******************
	
	// *****************************************************************	FUNCTIONS	**********************************************************************
	function removal()
	{
		if($query = mysql_query("UPDATE modules SET lecturer_id = NULL WHERE lecturer_id = " . $_SESSION["lecCode"] . " AND mod_code = '" . $_SESSION["modCode"] . "'"))
		{
			echo '
				<div class = "form-group">
					<h1>
						' . $_SESSION["l_name"] . ', ' . $_SESSION["f_name"] . ' has been removed from ' . $_SESSION["modCode"] . '
					</h1>
				</div>
				<div class = "form-group">
					<a href = "adminPage.php">
						Click here to return to the Administrative Homepage
					</a>
				</div>';
				cleanup();
		}
		else
		{
			echo '
				<div class = "form-group">
					<h1>
						Error 6
					</h1>
					<br/>
					<h3>
						' . $_SESSION["l_name"] . ', ' . $_SESSION["f_name"] . ' could not be removed from ' . $_SESSION["modCode"] . '
					</h3>
				</div>
				<div class = "form-group">
					<a href = "adminPage.php">
						Click here to return to the Administrative Homepage
					</a>
				</div>';
				cleanup();
		}
	}
	
	function cleanup()
	{
		$_SESSION["l_name"] = NULL;
		$_SESSION["f_name"] = NULL;
		$_SESSION["modCode"] = NULL;
		$_SESSION["lecCode"] = NULL;
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Remove a lecturer from a module</title>
		<meta name="description" content="This page enables the administrator of the N.E.L.L. system to remove lecturers from modules"/>
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
														Select Module
													</label>
													<select name = "modOption">';
														$query = mysql_query("SELECT mod_code FROM modules WHERE lecturer_id IS NOT NULL");
														while($row = mysql_fetch_array($query))
														{
															echo '<option value = "' . $row["mod_code"] . '">' . $row["mod_code"] . '</option>';
														}
										echo '		</select>
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit1" value = "Select"/>
												</div>
											</form>';
										break;
									case 1:
										echo '
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data">
												<div class = "form-group">
													<label>
														Module
													</label>
													' . " " . $_SESSION["modCode"] . '
												</div>
												<div class = "form-group">
													<label>
														Lecturer
													</label>
													' . " " . $_SESSION["l_name"] . ", " . $_SESSION["f_name"] . '
												</div>
												<div class = "form-group">
													Are you sure you want to remove this lecturer from this module?
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit2" value = "Remove"/>
												</div>
											</form>';
										break;
									case 2:
										removal();
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>