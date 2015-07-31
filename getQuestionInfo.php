<?php
include 'database_info.php';
session_start();

$dbname = "". strtolower($_SESSION['module']);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else {
	//selects the question and returns its info to the lecturer if avalible
	$queID = $_POST['q'];
	$sql = "SELECT * FROM multi_questions WHERE question_id = '$queID'";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		echo '<form class="form-horizontal" role="form" method="POST" id="updateQuestionForm">
                        <div class="text-left well" id="test1">
                            <div class="col-md-12">
                                <h2>Question Info</h2>
                                <div class="row">
                                    <div class="col-md-4">

                                            <div class="form-group">
                                                <label class="control-label">Question</label>
                                                <input value="'.$row['question'].'" class="form-control" type="text" id="questionName"
                                                name="questionName" >
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" >Hint</label>
                                                <textarea class="form-control" id="questionHint" name="questionHint">'.$row['hint'].'</textarea>
                                            </div>
                                    </div>
                                    <div class="col-md-8">
                                        
                                            <div class="form-group has-success">
                                                <div class="col-sm-2">
                                                    <label for="CorrectAns" class="control-label">Correct Answer</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input value="'.$row['answer1'].'" type="text" class="form-control" id="CorrectAns" name="CorrectAns" placeholder="Answer">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-2">
                                                    <label for="otherAns1" class="control-label">Possible Answer</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input value="'.$row['answer2'].'" type="text" class="form-control" id="otherAns1" name="otherAns1" placeholder="Answer">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-2">
                                                    <label for="otherAns2" class="control-label">Possible Answer</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input value="'.$row['answer3'].'" type="text" class="form-control" id="otherAns2" name="otherAns2" placeholder="Answer">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-2">
                                                    <label for="otherAns3" class="control-label">Possible Answer</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input value="'.$row['answer4'].'" type="text" class="form-control" id="otherAns3" name="otherAns3" placeholder="Answer">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-2">
                                                    <label for="otherAns4" class="control-label">Possible Answer</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input value="'.$row['answer5'].'" type="text" class="form-control" id="otherAns4" name="otherAns4" placeholder="Answer">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-2">
                                                    <label for="otherAns5" class="control-label">Possible Answer</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input value="'.$row['answer6'].'" type="text" class="form-control" id="otherAns5" name="otherAns5" placeholder="Answer">
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
                        </form>';
	}

}
	$conn->close();
	
?>