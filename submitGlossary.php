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
	$term = $_POST['Term'];
	$defi = $_POST['Definition'];

	$sql = "SELECT * FROM glossary WHERE term = '$term'";
	$result = $conn->query($sql);
	if($result->num_rows === 0) {
		$sql = "INSERT INTO glossary (term, definition) VALUES ('$term', '$defi')";
		$conn->query($sql);
	}

}
	$conn->close();

?>