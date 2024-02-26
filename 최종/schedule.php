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

// MySQL 연결 확인
if ($mysqli->connect_error) {
    die("MySQL 연결 실패: " . $mysqli->connect_error);
}

// POST 데이터를 받아오고 필터링
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $delete_id = $_POST['delete'];
        // MySQL에서 해당 강의 삭제
        $delete_sql = "DELETE FROM plan WHERE id = ?";
        $delete_statement = $mysqli->prepare($delete_sql);
        $delete_statement->bind_param("i", $delete_id);
        if ($delete_statement->execute()) {
            echo "<script>alert('강의가 성공적으로 삭제되었습니다.');</script>";
            
        } else {
            echo "<script>alert('강의 삭제에 실패했습니다.');</script>";
        }
        $delete_statement->close();
    } else {
        $lecture_name = filter_var($_POST["lecture_name"], FILTER_SANITIZE_STRING);
        $credit = filter_var($_POST["credit"], FILTER_VALIDATE_INT);
        $type = filter_var($_POST["type"], FILTER_SANITIZE_STRING);
        
        // MySQL에 데이터 추가
        $insert_sql = "INSERT INTO plan (lecture_name, credit, type) VALUES (?, ?, ?)";
        $insert_statement = $mysqli->prepare($insert_sql);
        $insert_statement->bind_param("sis", $lecture_name, $credit, $type);
        if ($insert_statement->execute()) {
            // 데이터 추가 성공
            echo "<script>alert('학점계획표에 강의가 추가되었습니다.');</script>";
        } else {
            // 데이터 추가 실패
            echo "<script>alert('강의 추가에 실패했습니다.');</script>";
            
        }
        $insert_statement->close();
    }
}

// 추가된 강의 리스트 불러오기
$select_sql = "SELECT id, lecture_name, credit, type FROM plan";
$result = $mysqli->query($select_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>계획표</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        h1, h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }

         /* 삭제 버튼 셀의 너비 조정 */
        .delete-cell {
            width: 10px; /* 원하는 너비로 조정 */
        }

    </style>
</head>
<body>
    <h1>계획표</h1>

    <button id="goHomeBtn">홈으로 돌아가기</button>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="lecture_name">강의명:</label>
        <input type="text" id="lecture_name" name="lecture_name" required><br>
        
        <label for="credit">학점:</label>
        <input type="number" id="credit" name="credit" required><br>
        
        <label for="type">타입:</label>
        <select id="type" name="type" required>
            <option value="전공필수">전공필수</option>
            <option value="전공선택">전공선택</option>
            <option value="교양필수">교양필수</option>
            <option value="교양선택1">교양선택 제1영역</option>
            <option value="교양선택2">교양선택 제2영역</option>
            <option value="교양선택1">교양선택 제3영역</option>
            <option value="교양선택2">교양선택 제4영역</option>
        </select><br>
        
        <input type="submit" value="추가">
    </form>

    <h2>내 강의</h2>
    <table>
        <tr>
            <th>강의명</th>
            <th>학점</th>
            <th>타입</th>
            <th class="delete-cell">삭제</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['lecture_name'] . "</td>";
                echo "<td>" . $row['credit'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='delete' value='" . $row['id'] . "'>";
                echo "<button type='submit' class='delete-btn'>삭제</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<script>alert('추가된 강의가 없습니다');</script>";
        }
        ?>
    </table>
    <script>
        // 홈으로 돌아가는 버튼에 클릭 이벤트 리스너 등록
        document.getElementById('goHomeBtn').addEventListener('click', function() {
            location.href = 'home.php'; // 홈페이지로 이동
        });
    </script>
</body>
</html>
