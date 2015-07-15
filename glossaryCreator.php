<?php
    session_start();
    //Redirect if not logged in or not a admin or teacher
    if(!isset($_SESSION['login_user']) || ($_SESSION['user_group'] == '3')){
        header("location: index.php");
    } else  {

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

}
?>

<html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
        rel="stylesheet" type="text/css">
        <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css"
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
                    <a class="navbar-brand" href="index.php"><span>N.E.L.L Test</span></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right"></ul>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="jumbotron">
                            <h1>Glossary Creator</h1>
                            <p>Add terms you would like to use during this module here. There are
                                two ways to add terms you may either enter them using the web interface
                                or upload them in an exel file using the provided template.</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="btn btn-block btn-info btn-lg" id="updateGlos">Update Glossary</a>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-block btn-info btn-lg" id="addGlos">Add Glossary</a>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-block btn-info btn-lg" id="uploadFile">Upload File</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="UploadSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
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
                                        echo    "<center>============================= <br/><b>File Uploaded</b><br/>============================= <br/><b>Do you want to upload the data?<br/><a href='convertExcelQuestions.php'>Click Here</a></b><br/>========================</center>";
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
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="AddSection">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-left well" id="question1">
              <div class="col-md-12">
                <h2>Term Info</h2>
                <div class="row">
                  <div class="col-md-3">
                    <form class="form-horizontal" role="form">
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="CorrectAns" class="control-label">Term</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="CorrectAns" placeholder="Term">
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-9">
                    <form class="form-horizontal" role="form">
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="CorrectAns" class="control-label">Definition</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="CorrectAns" placeholder="Definition">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <table class="table table-bordered table-hover table-striped" id="inputTable1">
                <thead>
                  <tr></tr>
                </thead>
                <tbody>
                  <tr></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <a class="btn btn-info btn-lg" id="newTerm">Add Term</a>
          </div>
          <div class="col-md-6">
            <a class="btn btn-info btn-lg" onclick="">Submit</a>
          </div>
        </div>
      </div>
    </div>
        <div class="section" id="UpdateSection">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form">
              <div class="form-group">
                <div class="col-sm-2">
                  <label class="control-label">Select Question</label>
                </div>
                <div class="col-sm-10">
                  <select class="form-control"></select>
                </div>
              </div>
            </form>
            <div class="col-md-12">
              <div class="text-left well" id="question1">
                <div class="col-md-12">
                  <h2>Term Info</h2>
                  <div class="row">
                    <div class="col-md-3">
                      <form class="form-horizontal" role="form">
                        <div class="form-group">
                          <div class="col-sm-2">
                            <label for="CorrectAns" class="control-label">Term</label>
                          </div>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="CorrectAns" placeholder="Term">
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-9">
                      <form class="form-horizontal" role="form">
                        <div class="form-group">
                          <div class="col-sm-2">
                            <label for="CorrectAns" class="control-label">Definition</label>
                          </div>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="CorrectAns" placeholder="Definition">
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-hover table-striped" id="inputTable1">
                  <thead>
                    <tr></tr>
                  </thead>
                  <tbody>
                    <tr></tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <a class="btn btn-info btn-lg" id="updateTerm">Update Term</a>
          </div>
          <div class="col-md-6">
            <a class="btn btn-info btn-lg" onclick="">Delete Term</a>
          </div>
        </div>
      </div>
    </div>
    </body>
    <script>

        $(document).ready(function(){

            $("#UploadSection").hide();
            $("#AddSection").hide();
            $("#UpdateSection").hide();

            $("#updateGlos").click(function(){
                $("#updateGlos").addClass("active");
                $("#addGlos").removeClass("active");
                $("#uploadFile").removeClass("active");
                $("#UpdateSection").show();
                $("#AddSection").hide();
                $("#UploadSection").hide();
            });

            $("#addGlos").click(function(){
                $("#addGlos").addClass("active");
                $("#updateGlos").removeClass("active");
                $("#uploadFile").removeClass("active");
                $("#AddSection").show();
                $("#UploadSection").hide();
                $("#UpdateSection").hide();
            });

            $("#uploadFile").click(function(){
                $("#uploadFile").addClass("active");
                $("#addGlos").removeClass("active");
                $("#updateGlos").removeClass("active");
                $("#UploadSection").show();
                $("#AddSection").hide();
                $("#UpdateSection").hide();
            });
        });

    </script>

</html>