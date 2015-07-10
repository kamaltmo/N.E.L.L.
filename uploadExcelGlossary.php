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
		<meta name="keywords" content="import excel file data in mysql, upload ecxel file in mysql, upload data, code to import excel data in mysql database, php, Mysql, Ajax, Jquery, Javascript, download, upload, upload excel file,mysql"/>
	</head>
	<body>
		<table>
		<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
			<tr>
				<td>
					Excel Uploading System
				</td>
			</tr>
			<tr>
				<td>
					Select file
				</td>
				<td>
					<input type="file" name="file" id="file" />
				</td>
			</tr>
			<tr>
				<td>
					Submit
				</td>
				<td>
					<input type="submit" name="submit" />
				<td/>
			</tr>
			</table>
			<?php
				if($uploadStatus==1)
				{
					echo 	"<center>============================= <br/><b>File Uploaded<b/><br/>============================= <br/><b>Do you want to upload the data?<a href='convertExcelGlossary.php'>Click Here</a></b><br/>========================</center>";
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
	</body>
</html>