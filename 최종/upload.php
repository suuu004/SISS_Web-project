<?php
session_start();

// 이미지 업로드 폴더
$uploadDir = 'uploads/';

// 업로드할 파일의 경로
$uploadFilePath = $uploadDir . basename($_FILES['profile_image']['name']);

// 파일을 임시 폴더에서 업로드 폴더로 이동
if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFilePath)) {
    // 파일 업로드에 성공하면 세션에 이미지 경로 저장
    $_SESSION['profile_image'] = $uploadFilePath;
} else {
    echo "이미지 업로드에 실패했습니다.";
}

// 마이페이지로 리다이렉션
header('Location: mypage.php');
?>