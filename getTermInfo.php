<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "". strtolower($_SESSION['module']);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else {
	//selects the question and returns its info to the lecturer if avalible
	$termID = $_POST['tID'];
	$sql = "SELECT * FROM glossary WHERE term_id = '$termID'";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		echo '<div class="col-md-12">
              <form class="form-horizontal" role="form" method="POST" id="updateTermForm">
              <div class="text-left well" id="question1">
                <div class="col-md-12">
                  <h2>Term Info</h2>
                  <div class="row">
                    <div class="col-md-3">

                        <div class="form-group">
                          <div class="col-sm-2">
                            <label for="CorrectAns" class="control-label">Term</label>
                          </div>
                          <div class="col-sm-10">
                            <input value="'.$row['term'].'" type="text" class="form-control" id="Term" name="Term" placeholder="Term">
                          </div>
                        </div>
                      
                      
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                          <div class="col-sm-2">
                            <label for="CorrectAns" class="control-label">Definition</label>
                          </div>
                          <div class="col-sm-10">
                            <input value="'.$row['definition'].'"  type="text" class="form-control" id="Definition" name="Definition" placeholder="Definition">
                          </div>
                        </div>

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
              </form>
            </div>';
	}

}
	$conn->close();
	
?>