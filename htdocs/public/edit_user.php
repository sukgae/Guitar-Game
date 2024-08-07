<?php
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    $response = [];

    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$userId";

    if ($conn->query($sql) === TRUE) {
        $response["success"] = true;
        $response["message"] = "User updated successfully";
    } else {
        $response["success"] = false;
        $response["message"] = "Error updating record: " . $conn->error;
    }

    echo json_encode($response);
}

$conn->close();
?>
