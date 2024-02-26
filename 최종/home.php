<?php
session_start();

// 현재 로그인 상태 확인
$loggedIn = isset($_SESSION['id']);

// 로그아웃 처리
if (isset($_GET['logout'])) {
    // 세션 변수 제거
    session_unset();
    // 세션 파기
    session_destroy();
    // 홈페이지로 리다이렉트
    header("Location:  home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Web Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        #notice {
            text-align: center;
            padding: 90px;
            background-color: #3498db; /* 연한 파랑색으로 변경 */
            color: white;
            font-size: 24px;
        }
        #menu {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background-color: #333;
            color: white;
        }
        #menu button {
            padding: 19px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #content {
            padding: 20px;
        }
        .authButton {
            position: absolute;
            top: 10px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: black; /* 흰색으로 변경 */
            text-decoration: none;
        }
        .authButton:nth-child(1) {
            right: 100px; /* 로그인 버튼 위치 조절 */
            background-color: white; /* 로그인 버튼 배경색 */
        }
        .authButton:nth-child(2) {
            right: 10px; /* 회원가입 버튼 위치 조절 */
            background-color: white; /* 회원가입 버튼 배경색 */
        }
    </style>
</head>
<body>
    <?php if(!$loggedIn): ?>
        <a href="log-in.html" class="authButton">로그인</a>
        <a href="sign-up.html" class="authButton">회원가입</a>
    <?php else: ?>
        <a href="?logout=true" class="authButton">로그아웃</a>
    <?php endif; ?>

    <div id="notice">메인 홈</div>
    
    <div id="menu">
        <button onclick="goTo('grade.php')">학점관리</button>
        <button onclick="goTo('schedule.php')">계획표</button>
        <button onclick="goTo('board.php')">게시판</button>
        <button onclick="goTo('mypage.php')">마이페이지</button>
        <button onclick="goTo('gradeTable.php')">평가기준표</button>
    </div>
    
    <div id="content">
        <!-- 여기에 웹 페이지의 본문 내용을 추가하세요 -->
    </div>

    <script>
        function goTo(page) {
            location.href = page;
        }
    </script>
</body>
</html>
