<?php
include 'database_info.php';
session_start();

$dbname = strtolower($_SESSION['module']);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else { 
	$que = $_POST['questionName'];
	$hint = $_POST['questionHint'];
	$answers = array($_POST['CorrectAns'], $_POST['otherAns1'], $_POST['otherAns2'], $_POST['otherAns3'], $_POST['otherAns4'], $_POST['otherAns5']);
	$num = 0;
	foreach ($answers as $answer) {
		if ($answer != "") {
			$num = $num + 1;
		}
	}

	$sql = "SELECT * FROM multi_questions WHERE question = '$que'";
	$result = $conn->query($sql);
	if($result->num_rows === 0) {
		$sql = "INSERT INTO multi_questions (question, hint, answer1, answer2, answer3, answer4, answer5, answer6, no_of_answers) VALUES ('$que', '$hint', '".$answers[0]."', '".$answers[1]."', '".$answers[2]."', '".$answers[3]."', '".$answers[4]."', '".$answers[5]."', '$num')";
		$conn->query($sql);
	}

}
	$conn->close();

?>