<?php
	/* 
		Questions
			*	displays questions to students, only active questions are displayed
			*	Students can answer by selecting their answer (multiple-choice only at the moment)
			
		Page reloads every 30 seconds, to change go to the body tag and change the number
			
			***************************************************************************************************************************
			JOBS:
				*	Add login
				*	Change 'comp103' to $_SESSION["modCode"] or similar
				*	SEND INFO BACK TO THE LECTURER!
				*	Select correct checkbox / answer if the answer was correct (or remove question from the options entirely)
			***************************************************************************************************************************
			
			***************************************************************************************************************************
			ERRORS:
				*	101.1: Could not find the correct hint to the question in the database
				*	101.2: Could not find the correct answer to a free text question in the database
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
								echo '		<label>' . $row["term"] . '</label><br/>' . $row["definition"] . '<br/><br/>';
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>