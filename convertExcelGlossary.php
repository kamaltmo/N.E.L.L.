<?php
	/*
		At the moment, this script will only import into the 'login' table in the database
		It only works with an excel spreadsheet of 3 columns with:
			*	term
			*	definition
			*	the slide the question is connected to
		
		******************
		ADD TEMPLATE TO IT
		******************
	*/
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Upload Excel Glossary File</title>
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
								$databasetable = "glossary";
								$column1 = "term";
								$column2 = "definition";
								$column3 = "slide_id";
								$column4 = "term_id";
								
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
									$term = trim($allDataInSheet[$i]["A"]);
									$definition = trim($allDataInSheet[$i]["B"]);
									$slide_id = trim($allDataInSheet[$i]["C"]);
									//Find out the id by finding out how many terms are already there
									$query = "SELECT * FROM " . $databasetable;
									$result = mysql_query($query);
									$term_id = mysql_num_rows($result);
									
									//Search for duplicates
									$query = "SELECT " . $column4 . " FROM " . $databasetable . " WHERE " . $column1 . " = '".$term."' and " . $column3 . " = '" . $slide_id . "'";
									$sql = mysql_query($query);
									$recResult = mysql_fetch_array($sql);
									$existName = $recResult[$column4];				// Search for a match to the Primary key (term_id)
									// If the row hasn't already been inserted create a new student user
									if($existName=="") 
									{
										$instruction = "insert into " . $databasetable . " (" . $column1 . ", " . $column2 . ", " . $column3 . ", " . $column4 . ") values('".$term."', '".$definition."', '".$slide_id."', '" . $term_id . "');";
										$insertTable= mysql_query($instruction);
										$msg = 'Record has been added';
									} 
									else 
									{
										$msg = $term . " for slide " . $slide_id . ' already exists<br/>';
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