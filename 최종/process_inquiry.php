<!-- process_inquiry.php -->
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 데이터베이스 연결 설정
    require_once('dbconn.php');

    // 연결 확인
    if ($mysqli->connect_error) {
        die("연결 실패: " . $mysqli->connect_error);
    }

    // 사용자로부터 전송된 데이터 가져오기
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // SQL 쿼리 작성 (마지막 쉼표 제거)
    $sql = "INSERT INTO inquiries (name, email, message) VALUES ('$name', '$email', '$message')";

    // SQL 실행
    if ($mysqli->query($sql)) {
        echo '<script>alert("문의가 성공적으로 제출되었습니다.")</script>';
    } else {
        echo '<script>alert("문의 제출에 실패했습니다.")</script>';
    }

    // 데이터베이스 연결 종료
    $mysqli->close();
}

header('Location: inquiry.php');
?>
