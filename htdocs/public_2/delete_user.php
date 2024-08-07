<?php
include '../includes/db.php';

$name = $_GET["name"];

// 사용자 삭제
$sql = "DELETE FROM users WHERE name='$name'";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
