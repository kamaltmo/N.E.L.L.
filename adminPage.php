<?php
	/*
		
		This is the first page the admin sees when they login as administrator of the entire system.
		From here they should be able to:
			*	add a new module
			*	delete a module
			*	assign lecturers to modules
			*	remove lecturers from modules (only one lecturer per module)
	
	*/
	
	//**************************************************************************************************
	//	JOBS:
	//		-	Check to see that the person is logged on as admin (under session_starts())
	//		-	Add option and pages to add / delete lecturers
	//		-	Split options into two groups: Module Info and Lecturer (maybe display in a table)
	//**************************************************************************************************
	
	session_start();
	//Check they're logged on etc.
	
	//Reset all variables
	$_SESSION["returnToLec"] = NULL;
	$_SESSION["modCode"] = NULL;
	$_SESSION["fName"] = NULL;
	$_SESSION["lName"] = NULL;
	$_SESSION["email"] = NULL;
	$_SESSION["lecCode"] = NULL;
	$_SESSION["selectedID"] = NULL;
	$_SESSION["message"] = NULL;

	//if lecturer not admin redirect to there page
	if(isset($_SESSION['login_user'])){
		if($_SESSION['admin'] == '0') {
            header("location: profile.php");
    	}
	} else {
		header("location: index.php");
	}

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Administrator of the NELL System</title>
		<meta name="description" content="This page enables the administrator of the N.E.L.L. system to add and delete modules and assign and remove lecturers from modules"/>
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
					<a class="navbar-brand" href="index.php"><span>N.E.L.L. Admin</span></a>
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
								<a href = "addNewM.php"> Create a new module </a>
							</div>
							<div class = "form-group">
								<a href = "deleteAM.php"> Delete a module </a>
							</div>
							<div class = "form-group">
								<a href = "addNewLec.php"> Add a new Lecturer </a>
							</div>
							<div class = "form-group">
								<a href = "deleteLec.php"> Delete a Lecturer </a>
							</div>
							<div class = "form-group">
								<a href = "addLec.php"> Set a module's lecturer </a>
							</div>
							<div class = "form-group">
								<a href = "removeLec.php"> Remove a lecturer from a module </a>
							</div>
							<div class = "form-group">
								<a href = "lecList.php"> View the list of lecturers </a>
							</div>
							<div class = "form-group">
								<a href = "modList.php"> View the list of Modules </a>
							</div>
						</div>
						<a href="logout.php" class="btn btn-block btn-info btn-lg">Log Out</a>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>