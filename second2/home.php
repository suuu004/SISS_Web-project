<?php
session_start();

// 로그인 여부 확인
$loggedIn = isset($_SESSION['id']);

// 사용자 정보 가져오기 (로그인한 경우에만)
$userInfo = [];
if ($loggedIn) {
    // 데이터베이스 연결 설정
    $host = 'localhost';
    $user = 'root';
    $pw = '1111';
    $dbName = 'privacy';
    $mysqli = new mysqli($host, $user, $pw, $dbName);

    // 사용자 정보 가져오기
    $id = $_SESSION['id'];
    $query = "SELECT * FROM member01 WHERE member_email='$id'";
    $result = mysqli_query($mysqli, $query);
    $userInfo = mysqli_fetch_assoc($result);
}

// 나머지 홈 화면 구성 요소 추가
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
        #loginButton,
        #signupButton {
            position: absolute;
            top: 10px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: black; /* 흰색으로 변경 */
            text-decoration: none;
        }
        #loginButton {
            right: 100px; /* 로그인 버튼 위치 조절 */
            background-color: white; /* 로그인 버튼 배경색 */
        }
        #signupButton {
            right: 10px; /* 회원가입 버튼 위치 조절 */
            background-color: white; /* 회원가입 버튼 배경색 */
        }
    </style>
</head>
<body>
    <a href="log-in.html" id="loginButton">로그인</a>
    <a href="sign-up.html" id="signupButton">회원가입</a>

    <div id="notice">공지사항</div>
    
    <div id="menu">
        <button onclick="goTo('grade.php')">학점관리</button>
        <button onclick="goTo('schedule.php')">계획표</button>
        <button onclick="goTo('board.php')">게시판</button>
        <button onclick="goTo('mypage.php')">마이페이지</button>
        <button onclick="goTo('gradeTable.php')">학점관리표</button>
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
