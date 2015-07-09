<?php
	/*
		At the moment, this script will only import into the 'login' table in the database
		It only works with an excel spreadsheet of 2 columns with:
			*	username
			*	student_id
		Admin is automatically set to 0 by the Database
		Password will be null for now
		
		***********************************************************************************
		IN THE FURUTRE: FIND A WAY TO GENERATE A RANDOM PASSWORD AND SEND IT TO THE STUDENT
		***********************************************************************************
		
	*/
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Demo - Import Excel file data in mysql database using PHP, Upload Excel file data in database</title>
		<meta name="description" content="This tutorial will learn how to import excel sheet data in mysql database using php. Here, first upload an excel sheet into your server and then click to import it into database. All column of excel sheet will store into your corrosponding database table."/>
		<meta name="keywords" content="import excel file data in mysql, upload ecxel file in mysql, upload data, code to import excel data in mysql database, php, Mysql, Ajax, Jquery, Javascript, download, upload, upload excel file,mysql"/>
	</head>
	<body>
		<?php
			define ("DB_HOST", "localhost");
			define ("DB_USER", "root");
			define ("DB_PASS", "");
			
			//	***********************************************
			//	Set up all details about the table you're using
			
			define ("DB_NAME", "nell"); 						
			$databasetable = "login";								// Change to 'test'
			$column1 = "username";
			$column2 = "student_id";
			
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
				
				//Search for duplicates
				$query = "SELECT " . $column2 . " FROM " . $databasetable . " WHERE " . $column1 . " = '".$userName."' and " . $column2 . " = '".$id."'";
				$sql = mysql_query($query);
				$recResult = mysql_fetch_array($sql);
				$existName = $recResult[$column2];				// Search for a match to the Primary key (student_id)
				// If the row hasn't already been inserted...
				if($existName=="") 
				{
					$insertTable= mysql_query("insert into " . $databasetable . " (" . $column1 . ", " . $column2 . ") values('".$userName."', '".$id."');");
					$msg = 'Record has been added.';
				} 
				else 
				{
					$msg = 'Record already exist.';
				}
			}
			echo "***********************" . $msg . "***********************";
		?>
	<body/>
<html>