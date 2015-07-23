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
	$que = $_POST['questionName'];
	$hint = $_POST['questionHint'];
	$a1 = $_POST['CorrectAns'];
	$a2 = $_POST['otherAns1'];
	$a3 = $_POST['otherAns2'];
	$a4 = $_POST['otherAns3'];

	$sql = "SELECT * FROM multi_questions WHERE question = '$que'";
	$result = $conn->query($sql);
	if($result->num_rows === 0) {
		$sql = "INSERT INTO multi_questions (question, hint, answer1, answer2, answer3, answer4) VALUES ('$que', '$hint', '$a1', '$a2', '$a3', '$a4')";
		$conn->query($sql);
	}

}
	$conn->close();

?>