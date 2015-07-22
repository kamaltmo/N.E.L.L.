<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
    //Redirect to page on login success
    if($_SESSION['admin'] == '1') {
            header("location: adminPage.php");
    } else {
            header("location: profile.php");
    }
}
?>

<!DOCTYPE html>
<html>
    
    <head>
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
                            <?php
                            if ($error != '') {
                                echo'<div class="alert alert-danger alert-dismissable">
                                        <button contenteditable="false" type="button" class="close" data-dismiss="alert"
                                         aria-hidden="true">×</button>
                                            <strong>' .$error. '</div>';
                            }
                            ?>
                            <form role="form" action="" method="post">
                                <div class="form-group">
                                    <label class="control-label" for="username">Username</label>
                                    <input class="form-control" id="username" name="username"
                                    placeholder="Username" type="text">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" placeholder="Password"
                                    type="password">
                                </div>
                                <input name="submit" type="submit" class="btn btn-info" />
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </body>

</html>