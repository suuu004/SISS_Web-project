// 졸업 학점 설정 화면 작성 후 작성 
<?php

session_start();

// 현재 로그인 상태 확인
$loggedIn = isset($_SESSION['id']);

// 만약 로그인되어 있지 않다면 로그인 페이지로 이동
if (!$loggedIn) {
    header('Location: log-in.html');
    exit;
}
?>
