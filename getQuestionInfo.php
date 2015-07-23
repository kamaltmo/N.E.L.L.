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
	$queID = $_POST['questionID'];
	sql = "SELECT * FROM multi_questions WHERE question_id = '$questionID'";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$array = ($row['question'], $row['hint'], $row['answer1'], $row['answer2'], $row['answer3'], $row['answer4']);
	}

}
	$conn->close();
	echo json_encode($array);
	exit();
?>