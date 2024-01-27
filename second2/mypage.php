//<?php
// 로그인 세션이 없으면 로그인 페이지로 이동
//session_start();
//if (!isset($_SESSION['id'])) {
//    header("Location: log-in.html");
//    exit();
//}

// 데이터베이스 연결 설정
//$host = 'localhost';
//$user = 'root';
//$pw = '1111';
//$dbName = 'privacy';
//$mysqli = new mysqli($host, $user, $pw, $dbName);

// 사용자 정보 가져오기
//$id = $_SESSION['id'];
//$query = "SELECT * FROM member01 WHERE member_email='$id'";
//$result = mysqli_query($mysqli, $query);
//$row = mysqli_fetch_assoc($result);

// 로그인 세션이 있을 경우 mypage.php로 리다이렉트
//if ($row) {
//    header("Location: mypage.php");
//    exit();
//}
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
            background-color: #f9f9f9; /* 밝은 회색 배경으로 변경 */
            border-left: 1px solid #ddd; /* 가운데 선으로 구분 */
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        #profileImage {
            width: 90%;
            height: 70%;
            object-fit: cover;
            margin-bottom: 5px; /* 변경된 부분 */
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
            margin-top: 5px; /* 변경된 부분 */
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
            <h2>내 프로필</h2>

            <div id="profileImageContainer">
                <img id="profileImage" src="images/default-profile-image.jpg" alt="프로필 이미지">
            </div>

            <div id="leftMenu">
                <button onclick="goTo('profile.php')">내 프로필</button>
                <button onclick="goTo('myBoard.php')">내 게시판</button>
                <button onclick="goTo('graduate.php')">졸업 이수 학점</button>
                <button onclick="goTo('inquiry.php')">문의사항</button>
            </div>
        </div>

        <div id="rightContainer">
            <form id="editForm">
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
                
                <button type="button" id="saveBtn" onclick="saveChanges()">저장</button>
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

        function saveChanges() {
            // 수정 내용 저장 기능을 구현할 JavaScript 코드 추가
            alert("수정 내용을 저장하세요.");
        }
    </script>
</body>
</html>
