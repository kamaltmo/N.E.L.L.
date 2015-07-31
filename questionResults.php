<?php
	/* 
		Queries:
			*	The main page of the lecturer during lectures
			
			***************************************************************************************************************************
			JOBS:
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
	
	$section = 0;
	
	if(isset($_POST["submit"]))
		$_SESSION["modCode"] = $_POST["modCode"];
	if(isset($_SESSION["modCode"]))
		$section = 1;
	
	function selectMod()
	{
		echo '
			<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data">
				<div class = "form-group">
					<label class = "control-label">
						Select Module
					</label>
					<select name = "modOption">';
						$query = mysql_query("SELECT mod_code FROM modules WHERE lecturer_id = " . $_SESSION["userID"]);
						while($row = mysql_fetch_array($query))
						{
							echo '<option value = "' . $row["mod_code"] . '">' . $row["mod_code"] . '</option>';
						}
		echo '		</select>
				</div>
				<div class = "form-group">
					<input type = "submit" name = "submit" value = "Go"/>
				</div>
			</form>';
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Terms</title>
		<meta name="description" content="This page allows the student to view the currently active terms"/>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="css/jquery.min.js"></script>
        <script type="text/javascript" src="css/bootstrap.min.js"></script>
        <link href="css/font-awesome.min.css"
        rel="stylesheet" type="text/css">
        <link href="css/bootstrap.css"
        rel="stylesheet" type="text/css">
	</head>
	<body onload="setInterval('window.location.reload()', 30000);">
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
										selectMod();
										break;
									case 1:
										selectMod();
										
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>