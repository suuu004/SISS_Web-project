<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer 클래스 포함
require 'C:/xampp/htdocs/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/PHPMailer-master/src/SMTP.php';

// 이메일 인증 메일 보내기 함수
function sendVerificationEmail($to, $token) {
    // PHPMailer 인스턴스 생성
    $mail = new PHPMailer(true);

    try {
        // 서버 설정
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'qkrwldk0407@gmail.com'; // 보내는 이메일 계정
        $mail->Password = 'pw'; // 보내는 이메일 계정의 암호
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // 보내는 사람 및 받는 사람 설정
        $mail->setFrom('qkrwldk0407@gmail.com', 'webmaster'); // 보내는 사람 이메일 주소 및 이름
        $mail->addAddress($to); // 받는 사람 이메일 주소

        // 메일 내용 설정
        $mail->isHTML(true); // HTML 포맷의 이메일로 설정
        $mail->CharSet = 'UTF-8'; // 문자 인코딩을 UTF-8로 설정
        $mail->Subject = '=?UTF-8?B?' . base64_encode('학점 관리 메일 인증') . '?='; // 제목을 UTF-8로 인코딩
        $mail->Body = '회원가입을 완료하려면 아래 링크를 클릭하세요: <a href="http://127.0.0.1/log-in.html?email=' . $to . '&token=' . $token . '">인증하기</a>';

        // 메일 보내기
        $mail->send();
        echo "편지를 보냈습니다.";
        echo "<script language=javascript> alert('메일인증성공!'); location.replace('success.html'); </script>";
    } catch (Exception $e) {
        echo "이메일을 보내는 데 문제가 발생했습니다. 오류 메시지: {$mail->ErrorInfo}";
    }
}

// 비밀번호 재설정 이메일 보내기 함수
// 비밀번호 재설정 이메일 보내기 함수
function sendPasswordResetEmail($to, $token) {
    // PHPMailer 인스턴스 생성
    $mail = new PHPMailer(true);

    try {
        // 서버 설정
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'qkrwldk0407@gmail.com'; // 보내는 이메일 계정
        $mail->Password = 'pw'; // 보내는 이메일 계정의 암호
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // 보내는 사람 및 받는 사람 설정
        $mail->setFrom('qkrwldk0407@gmail.com', 'webmaster'); // 보내는 사람 이메일 주소 및 이름
        $mail->addAddress($to); // 받는 사람 이메일 주소

        // 메일 내용 설정
        $mail->isHTML(true); // HTML 포맷의 이메일로 설정
        $mail->CharSet = 'UTF-8'; // 문자 인코딩을 UTF-8로 설정
        $mail->Subject = '=?UTF-8?B?' . base64_encode('비밀번호 재설정 링크') . '?='; // 제목을 UTF-8로 인코딩
        $mail->Body = '비밀번호를 재설정하려면 아래 링크를 클릭하세요: <a href="http://127.0.0.1/reset-pw.html?email=' . $to . '&token=' . $token . '">비밀번호 재설정하기</a><br> 또는 아래 토큰을 입력하세요: ' . $token;

        // 메일 보내기
        $mail->send();
        echo "이메일을 보냈습니다.";
        echo "<script>alert('이메일을 보냈습니다.');</script>";
    } catch (Exception $e) {
        echo "이메일을 보내는 데 문제가 발생했습니다. 오류 메시지: {$mail->ErrorInfo}";
    }
}

?>
