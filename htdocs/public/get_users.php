<?php
include '../includes/db.php'; // 데이터베이스 연결

header('Content-Type: application/json'); // JSON 응답 설정

$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);

$users = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// JSON 형식으로 결과 반환
echo json_encode($users);

$conn->close();
?>
