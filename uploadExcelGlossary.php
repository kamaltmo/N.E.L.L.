<?php
	$uploadStatus = 0;

	if(isset($_POST["submit"]))
	{
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
				$storagename = "excelfile.xlsx";
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
		<title>Upload Excel Glossary File</title>
		<meta name="description" content="First upload an excel sheet into your server and then click to import it into database. All columns of the excel sheet will be stored into a corresponding database table."/>
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
							<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
								<div class = "form-group">
									<label class = "control-label">Excel Uploading System</label>
								</div>
								<?php
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
										echo 	"<center>============================= <br/><b>File Uploaded</b><br/>============================= <br/><b>Do you want to upload the data?<br/><a href='convertExcelGlossary.php'>Click Here</a></b><br/>========================</center>";
									}
								?>
							</form>
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