<?php
	/*
		
		Allows admin to delete Modules from the system
	
	*/
	
	//**************************************************************************************************
	//	JOBS:
	//		-	Check to see that the person is logged on as admin (under session_starts())
	//**************************************************************************************************
	
	//**************************************************************************************************
	//	POSSIBLE ERRORS:
	//		-	2.1:	Database could not be deleted from the server
	//		-	2.2:	Module could not be deleted from the 'modules' table in the nell database
	//**************************************************************************************************
	
	session_start();
	//Check they're logged on etc.
	
	$section = 0;
	
	define ("DB_HOST", "localhost");
	define ("DB_USER", "root");
	define ("DB_PASS", "");
	define ("DB_NAME", "nell");
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
	
	//*************** 0 - Select module ***************
	if(isset($_POST["submit1"]))
	{
		$section = 1;
		$_SESSION["modCode"] = $_POST["modOption"];
	}
	
	//*************** 1 - Confirm ***************
	if(isset($_POST["submit2"]))
	{
		$section = 2;	
	}
	
	// *****************************************************************	FUNCTIONS	*****************************************************************
	function cleanup()
	{
		$_SESSION["modCode"] = NULL;
	}
	
	function removal()
	{
		global $link;
		$sql = "DROP DATABASE " . $_SESSION["modCode"];
		if(mysql_query($sql, $link))
		{
			$db = mysql_select_db('nell', $link) or die("Couldn't select database");
			if(mysql_query("DELETE FROM modules WHERE mod_code = '" . $_SESSION["modCode"] . "'"))
			{
				echo '
					<div class = "form-group">
						<h1>
							' . $_SESSION["modCode"] . ' has been deleted
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
				$code = 2.1;
				failureMessage($code);
			}
		}
		else
		{
			$code = 2.2;
			failureMessage($code);
		}
		cleanup();
	}
	
	function failureMessage($errorCode)
	{
		echo '
			<div class = "form-group">
				<h1>
				Error ' . $errorCode . '
				</h1>
				<br/>
				' . $_SESSION["modCode"] . ' could not be deleted
			</div>
			<div class = "form-group">
				<a href = "adminPage.php">
					Click here to return to the Administrative Homepage
				</a>
			</div>';
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Delete a module from the N.E.L.L. system</title>
		<meta name="description" content="This page enables the administrator of the N.E.L.L. system to delete modules"/>
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
														$query = mysql_query("SELECT mod_code FROM modules");
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
													Are you sure you want to remove this module?
													<br/>
													NOTE: This is a permanent alteration and cannot be undone, all data connected with this module will be removed
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