<?php
// send-password-reset.php

// Database connection
require_once('dbconn.php');

// Get email from form submission
$email = $_POST['email'];

// Generate password reset token
$token = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

// Update database with token
$sql = "UPDATE member01 SET password_reset_token='$token' WHERE member_email='$email'";
if ($mysqli->query($sql)) {
    // Send email with reset link
    require_once('sendmail.php');
    sendPasswordResetEmail($email, $token);
    echo '<script>alert("비밀번호 재설정 링크가 이메일로 전송되었습니다.");</script>';
} else {
    echo '<script>alert("비밀번호 재설정에 실패했습니다.");</script>';
}

// Close database connection
$mysqli->close();
?>
