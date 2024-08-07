<?php
include '../includes/db.php'; // 데이터베이스 연결

// POST 요청에서 이메일과 비밀번호 가져오기
$email = $_POST['email'];
$password = $_POST['password'];

// 결과 응답
$response = array('success' => false, 'message' => '');

try {
    // 비밀번호 해싱
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // SQL 쿼리 준비
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");

    if (!$stmt) {
        throw new Exception("Prepared statement failed: " . $conn->error);
    }

    // 파라미터 바인딩
    $stmt->bind_param("ss", $email, $hashedPassword);

    // 쿼리 실행
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Account created successfully.";
    } else {
        $response['success'] = false;
        $response['message'] = "Error creating account: " . $stmt->error;
    }

    $stmt->close();
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}

$conn->close();

// JSON 응답
echo json_encode($response);
?>
