<?php
    session_start();

    if(!isset($_SESSION['login_user'])){
        header("location: index.php");
    //Redirect to page on login success
    } else  {
        $name = $_SESSION['login_user'];
    }
?>

<!DOCTYPE html>
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
                <div class="col-md-4">
                    <ul class="nav nav-pills nav-stacked lead list-group text-info">
                        <li ><a href="uploadExcel.php">Upload Student Information</a></li>
                        <li ><a href="uploadExcelQuestions.php">Upload Questions</a></li>
                        <li ><a href="uploadExcelGlossary.php">Upload Glossary</a></li>
                    </ul>
                </div>
                    <div class="col-md-4">
                        <div class="alert alert-dismissable alert-success">
                            <button contenteditable="false" type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">×</button>
                            <b>Login Successfull</b>
                        </div>
                        <h3>Welcome <?php echo $name; ?></h3>
                        <a href="logout.php" class="btn btn-block btn-info btn-lg">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>