<?php
	//***************************************************************
	//	JOBS:
	//***************************************************************
	include 'database_info.php';
	session_start();
	if(!isset($_SESSION['login_user']))
	{
		header("location: index.php");
	}
	
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
	$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
	
	// Make sure the person logged in is a lecturer
	$query = mysql_query("SELECT lecturer_id FROM lecturers WHERE lecturer_id = " . $_SESSION["userID"]);
	if(mysql_num_rows($query) == 0)
	{
		$section = 4;
	}
	
	$section = 0;
    
	$uploadStatus = 0;

	//	0 - SELECT A MODULE
	if(isset($_POST["submit1"]))
	{
		$_SESSION["modCode"] = $_POST["modOption"];
		$section = 1;
	}
	
	//	1 - UPLOAD CLASSLIST
	if(isset($_POST["submit"]))
	{
		$section = 1;
		if(isset($_FILES["file"]))
		{
			//If there was an error uploading the file
			if($_FILES["file"]["error"] > 0)
			{
				echo "Return code: " . $_FILES["file"]["error"] . "<br/>";
			}
			// If there were no errors with the upload
			else
			{
				if(file_exists($_FILES["file"]["name"]))
				{
					unlink($_FILES["file"]["name"]);
				}
				$storagename = "classlist.htm";
				move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
				$uploadStatus = 1;
			}
		}
		else
		{
			echo "No file selected <br/>";
		}
		
	}

	
?>

<html>
	<head>
		<title>Upload Excel Student List File</title>
		<meta name="description" content="First upload the excel sheet and then click to import it into database."/>
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
				<div class="col-md-4"></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="well well-lg">
							<?php
								switch($section)
								{
									case 0:
										echo '
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data">
												<div class = "form-group">
													<label class = "control-label">
														Select Module
													</label>
													<select name = "modOption">';
														$query = mysql_query("SELECT mod_code FROM modules WHERE lecturer_id = " . $_SESSION["userID"]);
														while($row = mysql_fetch_array($query))
														{
															echo '<option value = "' . $row["mod_code"] . '">' . $row["mod_code"] . '</option>';
														}
										echo '		</select>
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit1" value = "Select"/>
												</div>
											</form>';
										break;
									case 1:
										echo '
											<form action="'. $_SERVER["PHP_SELF"].'" method="post" enctype="multipart/form-data">
												<div class = "form-group">
													<label class = "control-label">Excel Uploading System</label>
												</div>';
													if($uploadStatus==0)
													{
														echo '<div class = "form-group">
															Select file
															<input type="file" name="file" id="file" />
														</div>
														<div class = "form-group">
															Submit
															<input type="submit" name="submit" />
														</div>';
													}
													if($uploadStatus==1)
													{
														echo 	"<center>============================= <br/><b>File Uploaded</b><br/>============================= <br/><b>Do you want to upload the data?<br/><a href='convertClasslist.php'>Click Here</a></b><br/>========================</center>";
													}
										echo '
											</form>';
										break;
									// The person logged in is not a lecturer
									case 4:
										echo '
											<form action="' . $_SERVER["PHP_SELF"] . '" method="post" enctype="multipart/form-data">
												<div class = "form-group">
													<h3>
														You do not have permission to be here
													</h3>
												</div>
												<div class = "form-group">
													<input type = "submit" name = "submit1" value = "Select"/>
												</div>
											</form>';
								}
								?>
							<script type="text/javascript">
								  var _gaq = _gaq || [];
								  _gaq.push(['_setAccount', 'UA-38304687-1']);
								  _gaq.push(['_trackPageview']);

								  (function() {
									var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
									ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
									var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
								  })();
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>