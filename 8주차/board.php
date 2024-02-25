<?php
session_start();

// 현재 로그인 상태 확인
$loggedIn = isset($_SESSION['id']);

// 만약 로그인되어 있지 않다면 로그인 페이지로 이동
if (!$loggedIn) {
    header('Location: log-in.html');
    exit;
}

// MySQL 연결 설정
require_once('dbconn.php');

// 게시판 글 작성 코드
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_post'])) {
    $user_id = $_SESSION['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $insertQuery = "INSERT INTO board_posts (user_id, title, content) VALUES ('$user_id', '$title', '$content')";
    $insertResult = $mysqli->query($insertQuery);

    if ($insertResult) {
        echo "게시글이 성공적으로 작성되었습니다.";
    } else {
        echo "게시글 작성에 실패했습니다.";
    }
}

// 최신 게시글 5개 가져오기
$query = "SELECT * FROM board_posts ORDER BY created_at DESC LIMIT 5";
$result = $mysqli->query($query);

// 검색 기능 추가
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $searchQuery = "SELECT * FROM board_posts WHERE title LIKE '%$keyword%' OR content LIKE '%$keyword%'";
    $searchResult = $mysqli->query($searchQuery);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>게시판</title>

    <button id="goHomeBtn">홈으로 돌아가기</button>

    <style>
        /* 스타일 추가 */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <script>
        // 홈으로 돌아가는 버튼에 클릭 이벤트 리스너 등록
        document.getElementById('goHomeBtn').addEventListener('click', function() {
            location.href = 'home.php'; // 홈페이지로 이동
        });
    </script>
</head>
<body>

<!DOCTYPE html>
<html>
<head>
    <title>게시판</title>
    <style>
        /* 스타일 추가 */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>게시판</h1>

<h2>게시글 목록</h2>

<form action="" method="get">
    검색: <input type="text" name="keyword">
    <input type="submit" value="검색">
</form>

<?php
// 검색 결과 표시
if (isset($searchResult)) {
    if ($searchResult->num_rows > 0) {
        echo "<h2>검색 결과</h2>";
        echo "<table>";
        echo "<tr><th>제목</th><th>작성자</th><th>내용</th></tr>";
        while ($row = $searchResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $_SESSION['id'] . "</td>"; // 사용자 아이디 표시
            echo "<td>" . $row["content"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>검색한 글이 없습니다.</p>";
    }
} else {
    // 최신 게시글 5개 출력
    echo "<h2>최신 게시글</h2>";
    echo "<table>";
    echo "<tr><th>제목</th><th>작성자</th><th>내용</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $_SESSION['id'] . "</td>"; // 사용자 아이디 표시
        echo "<td>" . $row["content"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<h2>새로운 게시글 작성</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    제목: <input type="text" name="title"><br>
    내용: <textarea name="content"></textarea><br>
    <input type="submit" name="create_post" value="게시글 작성">
</form>

</body>
</html>
