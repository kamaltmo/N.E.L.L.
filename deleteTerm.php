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

	//removes the selected term
	$term = $_POST['Term'];
	$defi = $_POST['Definition'];

	$sql = "SELECT * FROM glossary WHERE term = '$term'";
	$result = $conn->query($sql);
	if($result->num_rows === 1) {
		$sql = "DELETE FROM glossary WHERE term = '$term'";
		$conn->query($sql);
	}

}
	$conn->close();
	header("location: glossaryCreator.php?mod=".$_SESSION['module']);
?>