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

	//Removes the slected Question
	$que = $_POST['questionName'];

	$sql = "SELECT * FROM multi_questions WHERE question = '$que'";
	$result = $conn->query($sql);
	if($result->num_rows === 1) {
		$sql = "DELETE FROM multi_questions WHERE question = '$que'";
		$conn->query($sql);
	}

}
	$conn->close();
	header("location: questionCreator.php?mod=".$_SESSION['module']);
?>