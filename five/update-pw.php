<?php
// update-password.php

// Database connection
require_once('dbconn.php');

// Check if email, token, new password, and confirm password are set in $_POST
if (!isset($_POST['email'], $_POST['token'], $_POST['new_password'], $_POST['confirm_password'])) {
    echo '<script>alert("폼 필드가 올바르게 제출되지 않았습니다."); history.back();</script>';
    exit;
}

// Get email, token, new password, and confirm password from form submission
$email = $_POST['email'];
$token = $_POST['token'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Check if new password matches confirm password
if ($new_password !== $confirm_password) {
    echo '<script>alert("비밀번호가 일치하지 않습니다."); history.back();</script>';
    exit;
}

// Check if token is valid
$sql_check_token = "SELECT * FROM member01 WHERE member_email=? AND password_reset_token=?";
$stmt_check_token = $mysqli->prepare($sql_check_token);
$stmt_check_token->bind_param("ss", $email, $token);
$stmt_check_token->execute();
$result_check_token = $stmt_check_token->get_result();

// Fetch row from result
$row = $result_check_token->fetch_assoc();

echo "Token from database: " . $row['password_reset_token']; // Add this line for debugging

if ($row) {
    // Token is valid, proceed with updating the password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update password in database
    $sql_update_password = "UPDATE member01 SET member_password=?, password_reset_token=NULL WHERE member_email=?";
    $stmt_update_password = $mysqli->prepare($sql_update_password);

    if ($stmt_update_password) {
        // Bind parameters and execute
        $stmt_update_password->bind_param("ss", $hashed_password, $email);
        if ($stmt_update_password->execute()) {
            echo '<script>alert("비밀번호가 성공적으로 재설정되었습니다.");</script>';
        } else {
            echo '<script>alert("비밀번호 재설정에 실패했습니다.");</script>';
        }
        // Close statement
        $stmt_update_password->close();
    } else {
        echo '<script>alert("비밀번호 재설정에 실패했습니다.");</script>';
    }
} else {
    echo '<script>alert("토큰이 올바르지 않습니다."); history.back();</script>';
}

// Close statement and database connection
$stmt_check_token->close();
$mysqli->close();
?>
