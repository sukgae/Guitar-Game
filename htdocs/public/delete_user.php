<?php
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["id"];

    $response = [];

    $sql = "DELETE FROM users WHERE id=$userId";

    if ($conn->query($sql) === TRUE) {
        $response["success"] = true;
        $response["message"] = "User deleted successfully";
    } else {
        $response["success"] = false;
        $response["message"] = "Error deleting record: " . $conn->error;
    }

    echo json_encode($response);
}

$conn->close();
?>
