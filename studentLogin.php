<?php
    include 'database_info.php';
    session_start(); // Start Session


    $error=''; //Store error messages
    if (isset($_POST['submit'])) {
        if (empty($_POST['stuEmail']) || empty($_POST['stuPass'])) {
            $error = "Username or Password is invalid";
        } else if (($_POST['modName'] == "") && ($_POST['modSelect'] == "")) {
            $error = "Please Select or Enter A Module";
        } else {

        //grab email and password
        $sEmail = strtolower($_POST['stuEmail']);
        $pWord = $_POST['stuPass'];
        if ($_POST['modName'] != "") {
            $mod = $_POST['modName'];
        } else {
            $mod = $_POST['modSelect'];
        }

        // Create connection
        @$conn = new mysqli($servername, $username, $password, $mod);
        // Check connection
        if ($conn->connect_error) {
            $error = "The module you have entered does not exist";
        } else {
            $sql = "SELECT * FROM students WHERE email = '$sEmail' AND password = '$pWord'";
            $result = $conn->query($sql);
            $conn->close(); 

                if ($result->num_rows == 1) {
                    // Initializing Session

                    while ($row = $result->fetch_assoc()) {
                        $_SESSION['stu_id'] = $row['student_id']; 
                        $_SESSION['stu_name'] = $row['first_name'];
                        $_SESSION['stu_email'] = $row['email'];
                        $_SESSION["modCode"] = $mod;   
                    }

                    //Redirect to page on login success
                    header("location: studentProfile.php");

                } else {
                    $error = "Username or Password is invalid";
                }
            }
        }
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
                    <a class="navbar-brand" href="studentLogin.php"><span>NELL Student Test</span></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active">
                            <a href="#">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section">
            <form class="form-horizontal" role="form" action="" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <legend>
                            <h1 class="text-center">Student Login</h1>
                        </legend>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Select or Enter a module</h4>
                        
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="modName" class="control-label">Enter</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="modName" id="modName" placeholder="module name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label class="control-label">Select</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" name="modSelect">
                                        <?php 


                                            // Create connection
                                            $conn = new mysqli($servername, $username, $password, $dbname);
                                            // Check connection
                                            if ($conn->connect_error) {
                                                header("Location: index.html");
                                                $error = "Connection failed: " . $conn->connect_error;
                                            } else {
                                                $sql = "SELECT * FROM modules";
                                                $result = $conn->query($sql);
                                                $conn->close();

                                                if ($result->num_rows >= 1) {
                                                    echo '<option>Select A Module</option>';
                                                    while ($row = $result->fetch_assoc()) { 
                                                        echo "<option>".$row['mod_code']."</option>";   
                                                    }

                                                } else {
                                                    echo '<option>No Modules available</option>';
                                                }

                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="well well-lg">
                                <?php
                                //Show Log in errors
                                if ($error != '') {
                                    echo'<div class="alert alert-danger alert-dismissable">
                                            <button contenteditable="false" type="button" class="close" data-dismiss="alert"
                                             aria-hidden="true">×</button>
                                                <strong>' .$error. '</div>';
                                }
                                ?>
                                <div class="form-group">
                                    <label class="control-label" for="InputEmail">Email address</label>
                                    <input class="form-control" name="stuEmail" id="InputEmail"
                                    placeholder="Enter email" type="email">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="InputPassword">Password</label>
                                    <input class="form-control" name="stuPass" id="InputPassword"
                                    placeholder="Password" type="password">
                                </div>
                                <input name="submit" type="submit" class="btn btn-block btn-info"/>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </body>

</html>