<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
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
	$a1 = $_POST['CorrectAns'];
	$a2 = $_POST['otherAns1'];
	$a3 = $_POST['otherAns2'];
	$a4 = $_POST['otherAns3'];

	$sql = "SELECT * FROM multi_questions WHERE question = '$que'";
	$result = $conn->query($sql);
	if($result->num_rows === 1) {
		$sql = "UPDATE multi_questions  SET question='$que', hint='$hint', answer1='$a1', answer2='$a2', answer3='$a3', answer4='$a4' WHERE question = '$que'";
		$conn->query($sql);
	}

}
	$conn->close();
	header("location: questionCreator.php?mod=".$_SESSION['module']);
?>
