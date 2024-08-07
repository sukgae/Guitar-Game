<?php
$servername = "hojung2009.iptime.org";
$username = "grosql"; // MySQL 기본 사용자
$password = "!ssp123"; // MySQL 기본 비밀번호
$dbname = "groesenbahn"; // 데이터베이스 이름
$port = 43306; // 포트번호

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>