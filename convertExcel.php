<?php
	/*
		At the moment, this script will only import into the 'login' table in the database
		It only works with an excel spreadsheet of 2 columns with:
			*	username
			*	student_id
		Admin is automatically set to 0 by the Database
		Password will be null for now
		
		***************************************************************************************************
		IN THE FURUTRE: FIND A WAY TO SEND THE GENERATED PASSWORD TO THE STUDENT need student email column?
		***************************************************************************************************
		
	*/
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
					<a class="navbar-brand" href="#"><span>N.E.L.L. Test</span></a>
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
								include 'database_info.php';
														
								$databasetable = "login";								// Change to 'test'
								$column1 = "username";
								$column2 = "student_id";
								$column3 = "password";
								
								//	***********************************************
								
								$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
								$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
								
								set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
								include 'Classes/PHPExcel.php'; 
								include 'Classes/PHPExcel/IOFactory.php';

								// This is the file path to be uploaded.
								$inputFileName = 'excelfile.xlsx';
								
								try
								{
									$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
								} 
								catch(Exception $e) 
								{
									die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
								}
								
								$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
								//Count the number of rows in the spreadsheet
								$arrayCount = count($allDataInSheet);
								
								// Go through each row one by one
								for($i=2; $i <= $arrayCount; $i++)
								{
									$userName = trim($allDataInSheet[$i]["A"]);
									$id = trim($allDataInSheet[$i]["B"]);
									$query = "SELECT SUBSTRING(MD5(RAND()) FROM 1 FOR 6)";
									$sql = mysql_query($query);
									$recResult = mysql_fetch_array($sql);
									$password = $recResult[0];
									
									//Search for duplicates
									$query = "SELECT " . $column2 . " FROM " . $databasetable . " WHERE " . $column1 . " = '".$userName."' and " . $column2 . " = '".$id."'";
									$sql = mysql_query($query);
									$recResult = mysql_fetch_array($sql);
									$existName = $recResult[$column2];				// Search for a match to the Primary key (student_id)
									// If the row hasn't already been inserted create a new student user
									if($existName=="") 
									{
										$insertTable= mysql_query("insert into " . $databasetable . " (" . $column1 . ", " . $column2 . ", " . $column3 . ") values('".$userName."', '".$id."', '" . $password . "');");
										$msg = 'Record has been added';
									} 
									else 
									{
										$msg = 'Record already exist';
									}
								}
								echo '<center><label class = "control-label">' . $msg . '</label></center>';
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>