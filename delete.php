<?php
include 'header.php';

$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
$matric = $_GET['matric'];

$sql = "DELETE FROM users WHERE matric='$matric'";
if ($conn->query($sql)) {
    header("Location: display.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
