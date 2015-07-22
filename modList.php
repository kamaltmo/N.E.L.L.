<?php
	/*
		
		Allows admin to view the modules on the N.E.L.L. system
	
	*/
	
	session_start();
	//Check they're logged on etc.
	
	//if lecturer not admin redirect to there page
	if($_SESSION['admin'] == '0') {
            header("location: profile.php");
    }
	
	$section = 0;
	
	define ("DB_HOST", "localhost");
	define ("DB_USER", "root");
	define ("DB_PASS", "");
	define ("DB_NAME", "nell");
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Delete a module from the N.E.L.L. system</title>
		<meta name="description" content="This page enables the administrator of the N.E.L.L. system to view a list of all modules"/>
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
							<div>
								<h1>
								Modules:
								</h1>
								<br/>
								<table>
									<tr>
										<td>
											<label>Module</label>
										</td>
										<td>
											<label>Lecturer</label>
										</td>
									</tr>
									<?php
										$query = mysql_query("SELECT mod_code, lecturer_id FROM modules");
										while($row = mysql_fetch_array($query))
										{
											$code = $row["mod_code"];
											$id = $row["lecturer_id"];
											echo '
												<tr>
													<td>
														' . $code . '
													</td>
													<td>';
														$result = mysql_query("SELECT last_name, first_name FROM lecturers WHERE lecturer_id = " . $id);
														if($result && mysql_num_rows($result) > 0)
														{
															echo $result["last_name"] . ", " . $result["first_name"];
														}
														else
														{
															echo '-';
														}
											echo		'
													</td>
												</tr>';
										}
									?>
								</table>
							</div>
							<div class = "form-group">
								<a href = "adminPage.php">
									Click here to return to the Administrative Homepage
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<body/>
<html>