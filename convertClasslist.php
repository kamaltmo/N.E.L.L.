<?php
	/*
		At the moment, this script will only import into the 'students' table in the database
		It only works with an excel spreadsheet of 2 columns with:
			*	username
			*	student_id
		Admin is automatically set to 0 by the Database
		Password will be null for now
		
		***************************************************************************************************
			ERRORS:
				-	17.1:	Comma could not be identified in the 'fullName' string
		***************************************************************************************************
		
		***************************************************************************************************
			JOBS:
				-	Only display modules the logged-in lecturer controls
		***************************************************************************************************
	*/
	include 'database_info.php';
	session_start();
	
	define ("DB_NAME", $_SESSION["modCode"]);
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Demo - Import Excel file data in mysql database using PHP, Upload Excel file data in database</title>
		<meta name="description" content="This tutorial will learn how to import excel sheet data in mysql database using php. Here, first upload an excel sheet into your server and then click to import it into database. All column of excel sheet will store into your corrosponding database table."/>
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
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php"><span>N.E.L.L. Test</span></a>
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
								// This is the file path to be uploaded.
								$inputFileName = 'classlist.htm';
								//$myfile = fopen("classlist.htm", "r") or die("Unable to open file!");
								
								libxml_use_internal_errors(true);
								// a new dom object
								$dom = new domDocument;
								
								try
								{
									$dom->loadHTMLFile("classlist.htm");
								} 
								catch(Exception $e) 
								{
									die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
								}
								
								$dom->preserveWhiteSpace = false;
								$firstRow = 1;
								$rows = $dom->getElementsByTagName("tr");
								if(!is_null($rows))
								{
									// Go through each row one by one
									foreach($rows as $row)
									{
										if($firstRow == 0)
										{
											$id = $row->childNodes->item(0)->textContent;
											$fullName = $row->childNodes->item(2)->textContent;
											$email = strtolower($row->childNodes->item(4)->textContent);
											// Split the name into last name, first name
											$commaPosition = strpos($fullName, ',');
											if($commaPosition === false)
											{
												echo '<label>error: 17.1, student ID = ' . $id . '</label>';
											}
											else
											{
												$last_name = substr($fullName, 0, $commaPosition);
												$first_name = substr($fullName, $commaPosition + 1, strlen($fullName));
												$query = "SELECT SUBSTRING(MD5(RAND()) FROM 1 FOR 6)";
												$sql = mysql_query($query);
												$recResult = mysql_fetch_array($sql);
												$password = $recResult[0];
												
												//Search for duplicates
												$query = mysql_query("SELECT student_id FROM students WHERE student_id = " . $id);
												// If the row hasn't already been inserted create a new student user
												if(mysql_num_rows($query) == 0) 
												{
													if(mysql_query("INSERT INTO students (student_id, email, password, first_name, last_name) VALUES (" . $id . ", '" . mysql_real_escape_string($email) . "', '" . mysql_real_escape_string($password) . "', '" . mysql_real_escape_string($first_name) . "', '" . mysql_real_escape_string($last_name) . "')"))
													{
														$msg = 'Records have been added';
													}
													else
													{
														echo '<label>Error 17.2 adding ' . $last_name . ', ' . $first_name . '</label>';
													}
												}
												else
													$msg = 'Records have been added';
											}
										}
										else
											$firstRow = 0;
									}
								}
								if($msg)
									echo '<center><label class = "control-label">' . $msg . '</label></center>';
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>