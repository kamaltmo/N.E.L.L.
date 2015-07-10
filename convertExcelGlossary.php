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
					$msg = 'Record has been added.';
				} 
				else 
				{
					$msg = $term . " for slide " . $slide_id . ' already exists.';
				}
			}
			echo "***********************" . $msg . "***********************";
		?>
	<body/>
<html>