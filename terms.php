<?php
	/* 
		Terms
			*	displays terms and their definitions to students, only active terms are displayed
			
		Page reloads every 30 seconds, to change go to the body tag and change the number
			
			***************************************************************************************************************************
			ERRORS:
				*	102.1: Could not get the terms from the glossary
			***************************************************************************************************************************
	*/
	include 'database_info.php';
	session_start();
	if(!isset($_SESSION['stu_id'])){
		header("location: studentLogin.php");
	}
	
	define ("DB_NAME", $_SESSION["modCode"]);
	
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
	
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
							<div class = "form-group">
								<?php
									if($query = mysql_query("SELECT term, definition FROM glossary WHERE status = 1"))
									{
										while($row = mysql_fetch_assoc($query))
										{
											echo '<label>' . $row["term"] . '</label><br/>' . $row["definition"] . '<br/><br/>';
										}
									}
									else
										echo 'Error 102.1';
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>