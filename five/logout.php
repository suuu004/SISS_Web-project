<?php
session_start();

// 세션 삭제
unset($_SESSION['id']);
unset($_SESSION['nickname']);

// 로그아웃 후 로그인 페이지로 이동
header('Location: log-in.html');
exit;
?>
