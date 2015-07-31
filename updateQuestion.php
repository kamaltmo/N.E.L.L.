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

	//Updates the selected question
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
	if($result->num_rows === 1) {
		$sql = "UPDATE multi_questions SET question='$que', hint='$hint', answer1='".$answers[0]."', answer2='".$answers[1]."', answer3='".$answers[2]."', answer4='".$answers[3]."', answer5='".$answers[4]."', answer6='".$answers[5]."', no_of_answers='$num' WHERE question = '$que'";
		$conn->query($sql);
	}

}
	$conn->close();
	header("location: questionCreator.php?mod=".$_SESSION['module']);
?>
