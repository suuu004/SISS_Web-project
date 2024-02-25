<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style>
        table {
            width: 80%; /* 표의 너비를 조정 */
            border-collapse: collapse;
            margin: 20px auto; /* 가운데 정렬 */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px; /* 셀 안의 내용과 테두리 간격 조정 */
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?php
session_start();

// 로그인 상태 확인
if (!isset($_SESSION['id'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='log-in.html';</script>";
    exit;
}

// MySQL 연결 설정
require_once('dbconn.php');

// 연결 확인
if ($mysqli->connect_error) {
    die("연결 실패: " . $mysqli->connect_error);
}

// 현재 로그인된 사용자의 아이디 가져오기
$user_id = $_SESSION['id'];

// 사용자가 작성한 게시글 가져오기
$query = "SELECT * FROM board_posts WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = mysqli_query($mysqli, $query);

// 게시글 출력
if (mysqli_num_rows($result) > 0) {
    echo "<h1>내가 작성한 게시글</h1>";
    echo "<table border='1'>";
    echo "<tr><th>제목</th><th>내용</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["content"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "작성한 게시글이 없습니다.";
}

// 연결 종료
$mysqli->close();
?>
<br>
<a href="mypage.php">마이페이지로 돌아가기</a>
</body>
</html>
