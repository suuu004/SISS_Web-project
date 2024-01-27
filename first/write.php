<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $host = 'localhost';
            $user = 'root';
            $pw = '1111';
            $dbName = 'privacy';
            $mysqli = new mysqli($host, $user, $pw, $dbName);

            // 연결 확인
            if ($mysqli->connect_error) {
                die("연결 실패: " . $mysqli->connect_error);
            }

            // 사용자로부터 전송된 데이터 가져오기
            $member_email = $_POST['email'];
            $member_name = $_POST['name'];
            $member_password = $_POST['password'];
            $member_password_confirm = $_POST['password_confirm'];

            // SQL 쿼리 작성 (마지막 쉼표 제거)
            $sql = "INSERT INTO member01 (
                        member_email,
                        member_name,
                        member_password,
                        member_password_confirm
                    ) VALUES (
                        '$member_email',
                        '$member_name',
                        '$member_password',
                        '$member_password_confirm'
                    )";

            // SQL 실행
            if ($mysqli->query($sql)) {
                echo '<script>alert("회원가입 성공")</script>';
            } else {
                echo '<script>alert("회원가입 실패")</script>';
            }

            // 데이터베이스 연결 종료
            $mysqli->close();
        }
    ?>
    <script>
        location.href = "log-in.html";
    </script>
</body>

</html>
