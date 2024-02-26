<?php
session_start();

// 현재 로그인 상태 확인
$loggedIn = isset($_SESSION['id']);

// 만약 로그인되어 있지 않다면 로그인 페이지로 이동
if (!$loggedIn) {
    header('Location: log-in.html');
    exit;
}

// 이미지가 세션에 저장되어 있는지 확인하고, 이미지 경로를 가져옵니다.
$profileImage = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : 'images/default-profile-image.jpg';


// MySQL 연결 설정
$host = 'localhost';
$user = 'root';
$pw = '1111';
$dbName = 'privacy';

// POST로 전송된 데이터 가져오기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_name = $_POST['member_name'];
    $member_email = $_POST['member_email'];

    // MySQL에 연결
    $mysqli = new mysqli($host, $user, $pw, $dbName);

    // MySQL에 업데이트 쿼리 실행
    $updateQuery = "UPDATE member01 SET member_name='$member_name', member_email='$member_email'";
    $result = $mysqli->query($updateQuery);

    if ($result) {
        echo "<script>alert('사용자 정보가 성공적으로 업데이트되었습니다.');</script>";
    } else {
        echo "<script>alert('사용자 정보 업데이트에 실패했습니다.');</script>";
    }

    // 작업 완료 후 MySQL 연결 종료
    $mysqli->close();
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
            margin-top: 20px; /* 이 부분을 수정하여 간격을 조절합니다. */
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
            margin-top: 10px; /* 이 부분을 수정하여 간격을 조절합니다. */
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


            <div id="leftMenu">
                <button onclick="goTo('myBoard.php')">내 게시판</button>

                <button onclick="goTo('inquiry.php')">문의사항</button>
            </div>
        </div>

        <div id="rightContainer">
        <form id="editForm" method="POST" action="upload.php" enctype="multipart/form-data">

                <h2>프로필 수정</h2>

                <div id="profileImageContainer">
                    <img id="profileImage" src="images/default-profile-image.jpg" alt="프로필 이미지">
                    <input type="file" id="uploadInput" accept="image/*" onchange="previewImage()">
                    <button id="deleteBtn" onclick="deleteImage()">사진 삭제</button>
                </div>
                <label for="member_name">닉네임:</label>
                <input type="text" id="member_name" name="member_name" placeholder="새로운 닉네임을 입력하세요"><br><br>
                <label for="member_email">이메일:</label>
                <input type="email" id="member_email" name="member_email" placeholder="새로운 이메일을 입력하세요"><br><br>
                <input type="submit" value="정보 수정" id="saveBtn">
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

    </script>

    <script>
        // 홈으로 돌아가는 버튼에 클릭 이벤트 리스너 등록
        document.getElementById('goHomeBtn').addEventListener('click', function() {
            location.href = 'home.php'; // 홈페이지로 이동
        });
    </script>
</body>
</html>
