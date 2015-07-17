<?php
	/*
		
		Allows admin to delete Modules from the system
	
	*/
	
	//**************************************************************************************************
	//	JOBS:
	//		-	Check to see that the person is logged on as admin (under session_starts())
	//		-	Add a 'Are you sure you want to remove COMPX?' warning message - this is permanent etc.
	//**************************************************************************************************
	
	session_start();
	//Check they're logged on etc.
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Delete a module from the N.E.L.L. system</title>
		<meta name="description" content="This page enables the administrator of the N.E.L.L. system to delete modules"/>
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
							
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>