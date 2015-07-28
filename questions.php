<?php
	/* 
		Questions
			*	displays questions to students, only active questions are displayed
			*	Students can answer by selecting their answer (multiple-choice only at the moment)
			
			***************************************************************************************************************************
			JOBS:
				*	Store each answer as the Q_ID eg. the answer for question 001 would be stored in $_POST["001"]
				*	Add functionality to complete free-text questions too
				*	Allow multiple questions to be answered
				*	Add login
				*	Change 'comp103' to be whatever module the student is logged into
			***************************************************************************************************************************
			
			***************************************************************************************************************************
			ERRORS:
				*	101.1: Could not find the correct hint to the question in the database
			***************************************************************************************************************************
	*/
	session_start();
	define ("DB_HOST", "localhost");
	define ("DB_USER", "root");
	define ("DB_PASS", "");	
	define ("DB_NAME", "comp103");
	
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
	
	// If the question has been answered
	if(isset($_POST["submit"]))
	{
		$allCorrect = true;
		$hints = array();
		foreach($_POST as $key => $value)
		{
			if($key != "submit")
			{
				if(!check_answer($value, $key))
				{
					$allCorrect = false;
					$hints[$key] = getHint($key);
				}
			}
		}
	}
	
	function scramble_answers($array)
	{
		if(!is_array($array))
			return $array;
		
		$keys = array_keys($array);
		shuffle($keys);
		$random = array();
		foreach($keys as $key)
			$random[$key] = $array[$key];
		return $random;
	}
	
	function check_answer($answerGiven, $qID)
	{
		return $answerGiven == 'answer1';
	}
	
	function getHint($qID)
	{
		$query = mysql_query("SELECT hint FROM multi_questions WHERE question_id = " . $qID);
		if($query)
		{
			$answer = mysql_fetch_row($query);
			return $answer[0];
		}
		else
		{
			echo "<br/>Error 101.1<br/>";
		}
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Create a new Module</title>
		<meta name="description" content="This page enables the administrator of the N.E.L.L. system to add modules"/>
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
								echo '
									<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data">';
										if($query = mysql_query("SELECT question_id, question, answer1, answer2, answer3, answer4, answer5, answer6, no_of_answers FROM multi_questions WHERE status = 1"))
										{
											while($row = mysql_fetch_assoc($query))
											{
												$_SESSION['qid'.$row["question_id"]] = $row["answer1"];
												$answers = array();
												for($i = 0; $i < $row["no_of_answers"]; $i++)
												{
													$number = $i + 1;
													$answer = "answer".$number;
													$answers[$answer] = $row[$answer];
												}
												$answers = scramble_answers($answers);
								echo '			<div>';
								echo '			<br/><label>' . $row["question"] . '</label><br/>';				
												foreach($answers as $key => $value)
												{
								echo '				<input type="radio" name="' . $row["question_id"] . '" value = "' . $key . '">' . $value . '</input><br/>';
												}
												if(isset($hints[$row["question_id"]]))
								echo '				<div><label>' . $hints[$row["question_id"]]	. '</label>';
												elseif(isset($_POST["submit"]))
								echo '				<div><label>Correct</label>';				
													
								echo'			</div><br/>';
											}
										}
								echo'		<div class = "form-group">
											<input type = "submit" name = "submit" value = "Next"/>
										</div>
									</form>';
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>
