<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>
    <?php
        session_start();
        
        // 만약 로그인되어 있지 않다면 로그인 페이지로 이동
        if (!$loggedIn) {
        header('Location: log-in.html');
        exit;
        }


        $host = 'localhost';
        $user = 'root';
        $pw = '1111';
        $dbName = 'privacy';
        $mysqli = new mysqli($host, $user, $pw, $dbName);

        $id = $_POST['email'];
        $pw = $_POST['password'];

        $query = "select * from member01 where member_email='$id' and member_password='$pw'";
        $result = mysqli_query($mysqli, $query);
        $row = mysqli_fetch_array($result);

        if (empty($id) || empty($pw)) {
            echo "<script>alert('아이디 또는 패스워드를 입력하여 주세요.');history.back();</script>";
            exit;
        } elseif ($id == $row['member_email'] && $pw == $row['member_password']) {
            $_SESSION['id'] = $row['member_email'];
            $_SESSION['name'] = $row['member_password'];

            echo "<script>alert('로그인 성공');</script>";
            echo "<script>location.href='home.php';</script>";
        } else {
            echo "<script>window.alert('invalid username or password');</script>";
            echo "<script>location.href='log-in.html';</script>";
        }
    ?>
</body>
</html>