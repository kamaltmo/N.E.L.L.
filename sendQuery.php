<?php
	/* 
		Queries:
			*	will work at any time, not just during lectures
			*	students can currently send the same question multiple times
			
			***************************************************************************************************************************
			JOBS:
				*	Could add a 'subject' field
			***************************************************************************************************************************
			
			***************************************************************************************************************************
			ERRORS:
				*	103.1:	Could not add the query to the queries table, maybe there is no student with that id on the system
			***************************************************************************************************************************
	*/
	
	session_start();
	if(!isset($_SESSION['stu_id'])){
		header("location: studentLogin.php");
	}
	
	define ("DB_HOST", "localhost");
	define ("DB_USER", "root");
	define ("DB_PASS", "");	
	define ("DB_NAME", $_SESSION["modCode"]);
	
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
	
	if(isset($_POST["submit"]))
	{
		if(mysql_query("INSERT INTO queries(query, student_id) VALUES('" . $_POST["question"] . "', " . $_SESSION['stu_id']))
		{
			$message = "Question sent";
		}
		else
		{
			$message = "Could not send question,<br/>Error 103.1";
		}
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Send a Query</title>
		<meta name="description" content="This page allows the student to ask the lecturer questions"/>
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
							<form action = "<?php $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
								<div class = "form-group">
									<?php
										if(isset($_POST["submit"]))
										{
											echo ' <h2>' . $message . '</h2><br/>';
										}
									?>
									<label>
										Question:
									</label><br/>
									<input type = "text" name = "question" autocomplete = "off"/><br/><br/><br/>
									<div class = "form-group">
										<input type = "submit" name = "submit" value = "Next"/>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>