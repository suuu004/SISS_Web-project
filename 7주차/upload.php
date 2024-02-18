<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // 이미지 파일인지 확인
    $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // 이미지 파일이 아닌 경우 에러 메시지 출력
    if ($uploadOk == 0) {
        echo "업로드할 수 있는 파일이 아닙니다.";
    // 이미지 파일이면 업로드 수행
    } else {
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
            echo "프로필 사진이 업로드되었습니다.";
        } else {
            echo "프로필 사진 업로드에 실패했습니다.";
        }
    }
}
?>
