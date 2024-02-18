<?php
session_start();

// 현재 로그인 상태 확인
$loggedIn = isset($_SESSION['id']);

// 만약 로그인되어 있지 않다면 로그인 페이지로 이동
if (!$loggedIn) {
    header('Location: log-in.html');
    exit;
}

// 로그인되어 있지 않은 경우 로그인 페이지로 리디렉션
if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit;
}

// MySQL 연결 설정
$host = 'localhost';
$user = 'root';
$pw = '1111';
$dbName = 'privacy';
$mysqli = new mysqli($host, $user, $pw, $dbName);

// 프로필 수정 처리 코드
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $major = $_POST['major'];
}

   // 세션에서 현재 사용자의 아이디 가져오기
if (isset($_SESSION['username'])) {
    $currentUsername = $_SESSION['username'];

    // 데이터베이스에 업데이트 쿼리 실행
    $updateQuery = "UPDATE member01 SET nickname='$nickname', email='$email', major='$major' WHERE username='$currentUsername'";
    $updateResult = $mysqli->query($updateQuery);

    if ($updateResult) {
        echo "<script>alert('프로필이 성공적으로 업데이트되었습니다.');</script>";
    } else {
        echo "<script>alert('프로필 업데이트에 실패했습니다.');</script>";
    }
} else {
    // 세션에 'username' 키가 정의되지 않은 경우 처리할 내용 추가
    echo "<script>alert('세션에 사용자 이름이 정의되지 않았습니다.');</script>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>마이페이지</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            color: #333;
        }
        #myPageContainer {
            display: flex;
        }
        #leftContainer {
            flex: 1;
            padding: 20px;
        }
        #rightContainer {
            flex: 1;
            padding: 20px;
            background-color: #f9f9f9;
            border-left: 1px solid #ddd;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        #profileImage {
            width: 90%;
            height: 70%;
            object-fit: cover;
            margin-bottom: 5px;
        }
        #uploadBtn,
        #deleteBtn {
            width: 50%;
            padding: 5px;
            margin-bottom: 10px;
            background-color: lightgray;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #leftMenu {
            width: 100%;
            padding: 20px;
        }
        #leftMenu button {
            width: 80%;
            padding: 10px;
            margin: 5px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: lightgray;
            color: black;
        }
        #editForm {
            width: 100%;
            max-width: 400px;
            margin-top: 20px;
        }
        #editForm label {
            margin-bottom: 5px;
        }
        #majorOptions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        #majorOptions input {
            cursor: pointer;
        }
        #saveBtn {
            width: 80%;
            padding: 10px;
            margin-top: 5px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="myPageContainer">
        <div id="leftContainer">
        <button id="goHomeBtn">홈으로 돌아가기</button>
            <h2>내 프로필</h2>

            <div id="profileImageContainer">
                <img id="profileImage" src="images/default-profile-image.jpg" alt="프로필 이미지">
            </div>

            <div id="leftMenu">
                <button onclick="goTo('myBoard.php')">내 게시판</button>
                <button onclick="goTo('graduate.php')">졸업 이수 학점</button>
                <button onclick="goTo('inquiry.php')">문의사항</button>
            </div>
        </div>

        <div id="rightContainer">
            <form id="editForm" method="POST" action="">
                <h2>프로필 수정</h2>

                <div id="profileImageContainer">
                    <img id="profileImage" src="images/default-profile-image.jpg" alt="프로필 이미지">
                    <input type="file" id="uploadInput" accept="image/*" onchange="previewImage()">
                    <button id="deleteBtn" onclick="deleteImage()">사진 삭제</button>
                </div>

                <div>
                    <label for="nickname">닉네임:</label>
                    <input type="text" id="nickname" name="nickname" placeholder="닉네임">
                </div>
                <div>
                    <label for="email">이메일:</label>
                    <input type="email" id="email" name="email" placeholder="이메일">
                </div>
                <div>
                    <label>전공:</label>
                    <div id="majorOptions">
                        <input type="radio" id="major1" name="major" value="심화">
                        <label for="major1">심화</label>
                        <input type="radio" id="major2" name="major" value="복수">
                        <label for="major2">복수</label>
                        <input type="radio" id="major3" name="major" value="연계">
                        <label for="major3">연계</label>
                    </div>
                </div>

                <button type="submit" id="saveBtn" name="save_changes">저장</button>
            </form>
        </div>
    </div>

    <script>
        function goTo(page) {
            location.href = page;
        }

        function previewImage() {
            const input = document.getElementById('uploadInput');
            const image = document.getElementById('profileImage');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    image.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function deleteImage() {
            const image = document.getElementById('profileImage');
            const input = document.getElementById('uploadInput');
            
            image.src = 'images/default-profile-image.jpg';
            input.value = null;
        }

        // 이벤트 핸들러를 form에 등록
        //document.getElementById('editForm').addEventListener('submit', function (event) {
            // submit 이벤트를 막아서 페이지가 리로드되는 것을 방지
        //    event.preventDefault();
            // 수정 내용 저장 기능을 구현할 JavaScript 코드 추가
        //    alert("수정 내용을 저장하세요.");
        //});
    </script>

    <script>
        // 홈으로 돌아가는 버튼에 클릭 이벤트 리스너 등록
        document.getElementById('goHomeBtn').addEventListener('click', function() {
            location.href = 'home.php'; // 홈페이지로 이동
        });
    </script>
</body>
</html>
