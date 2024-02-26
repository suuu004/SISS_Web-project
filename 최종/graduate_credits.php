<?php
// dbconn.php 파일에 데이터베이스 연결 코드를 포함합니다.
require_once('dbconn.php');

// POST로 전송된 데이터를 받아옵니다.
$total_credits = $_POST['total_credits'];
$major_required_credits = $_POST['major_required_credits'];
$major_optional_credits = $_POST['major_optional_credits'];
$liberal_arts_required_credits = $_POST['liberal_arts_required_credits'];
$liberal_arts_elective_credits = $_POST['liberal_arts_elective_credits'];
$area1_credits = $_POST['area1_credits'];
$area2_credits = $_POST['area2_credits'];
$area3_credits = $_POST['area3_credits'];
$area4_credits = $_POST['area4_credits'];

// SQL 쿼리를 준비합니다.
$sql = "INSERT INTO graduation_credits (total_credits, major_required_credits, major_optional_credits, liberal_arts_required_credits, liberal_arts_elective_credits, area1_credits, area2_credits, area3_credits, area4_credits) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// SQL 쿼리를 실행할 준비를 합니다.
$stmt = $mysqli->prepare($sql);

// 데이터를 바인딩합니다.
$stmt->bind_param("iiiiiiiii", $total_credits, $major_required_credits, $major_optional_credits, $liberal_arts_required_credits, $liberal_arts_elective_credits, $area1_credits, $area2_credits, $area3_credits, $area4_credits);

// SQL 쿼리를 실행합니다.
if ($stmt->execute()) {
    echo "데이터가 성공적으로 저장되었습니다.";
} else {
    echo "데이터 저장에 실패했습니다.";
}

// MySQL 연결을 닫습니다.
$mysqli->close();
?>
