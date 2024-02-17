<?php
require_once('dbconn.php');

// 각 항목별로 이수한 학점을 가져옵니다.
$sql_total_credits = "SELECT SUM(total_credits) AS total FROM graduation_credits WHERE id != 1";
$result_total_credits = $mysqli->query($sql_total_credits);
$row_total_credits = $result_total_credits->fetch_assoc();
$total_credits = $row_total_credits['total'];

$sql_major_required_credits = "SELECT SUM(major_required_credits) AS total FROM graduation_credits WHERE id != 1";
$result_major_required_credits = $mysqli->query($sql_major_required_credits);
$row_major_required_credits = $result_major_required_credits->fetch_assoc();
$major_required_credits = $row_major_required_credits['total'];

$sql_major_optional_credits = "SELECT SUM(major_optional_credits) AS total FROM graduation_credits WHERE id != 1";
$result_major_optional_credits = $mysqli->query($sql_major_optional_credits);
$row_major_optional_credits = $result_major_optional_credits->fetch_assoc();
$major_optional_credits = $row_major_optional_credits['total'];

$sql_liberal_arts_required_credits = "SELECT SUM(liberal_arts_required_credits) AS total FROM graduation_credits WHERE id != 1";
$result_liberal_arts_required_credits = $mysqli->query($sql_liberal_arts_required_credits);
$row_liberal_arts_required_credits = $result_liberal_arts_required_credits->fetch_assoc();
$liberal_arts_required_credits = $row_liberal_arts_required_credits['total'];

$sql_liberal_arts_elective_credits = "SELECT SUM(liberal_arts_elective_credits) AS total FROM graduation_credits WHERE id != 1";
$result_liberal_arts_elective_credits = $mysqli->query($sql_liberal_arts_elective_credits);
$row_liberal_arts_elective_credits = $result_liberal_arts_elective_credits->fetch_assoc();
$liberal_arts_elective_credits = $row_liberal_arts_elective_credits['total'];

$sql_area1_credits = "SELECT SUM(area1_credits) AS total FROM graduation_credits WHERE id != 1";
$result_area1_credits = $mysqli->query($sql_area1_credits);
$row_area1_credits = $result_area1_credits->fetch_assoc();
$area1_credits = $row_area1_credits['total'];

$sql_area2_credits = "SELECT SUM(area2_credits) AS total FROM graduation_credits WHERE id != 1";
$result_area2_credits = $mysqli->query($sql_area2_credits);
$row_area2_credits = $result_area2_credits->fetch_assoc();
$area2_credits = $row_area2_credits['total'];

$sql_area3_credits = "SELECT SUM(area3_credits) AS total FROM graduation_credits WHERE id != 1";
$result_area3_credits = $mysqli->query($sql_area3_credits);
$row_area3_credits = $result_area3_credits->fetch_assoc();
$area3_credits = $row_area3_credits['total'];

$sql_area4_credits = "SELECT SUM(area4_credits) AS total FROM graduation_credits WHERE id != 1";
$result_area4_credits = $mysqli->query($sql_area4_credits);
$row_area4_credits = $result_area4_credits->fetch_assoc();
$area4_credits = $row_area4_credits['total'];

// 졸업 이수 학점을 가져옵니다.
$sql_gra_total_credits = "SELECT total_credits FROM graduation_credits WHERE id = 1";
$result_gra_total_credits = $mysqli->query($sql_gra_total_credits);
$row_gra_total_credits = $result_gra_total_credits->fetch_assoc();
$gra_total_credits = $row_gra_total_credits['total_credits'];

$sql_gra_major_required_credits = "SELECT major_required_credits FROM graduation_credits WHERE id = 1";
$result_gra_major_required_credits = $mysqli->query($sql_gra_major_required_credits);
$row_gra_major_required_credits = $result_gra_major_required_credits->fetch_assoc();
$gra_major_required_credits = $row_gra_major_required_credits['major_required_credits'];

$sql_gra_major_optional_credits = "SELECT major_optional_credits FROM graduation_credits WHERE id = 1";
$result_gra_major_optional_credits = $mysqli->query($sql_gra_major_optional_credits);
$row_gra_major_optional_credits = $result_gra_major_optional_credits->fetch_assoc();
$gra_major_optional_credits = $row_gra_major_optional_credits['major_optional_credits'];

$sql_gra_liberal_arts_required_credits = "SELECT liberal_arts_required_credits FROM graduation_credits WHERE id = 1";
$result_gra_liberal_arts_required_credits = $mysqli->query($sql_gra_liberal_arts_required_credits);
$row_gra_liberal_arts_required_credits = $result_gra_liberal_arts_required_credits->fetch_assoc();
$gra_liberal_arts_required_credits = $row_gra_liberal_arts_required_credits['liberal_arts_required_credits'];

$sql_gra_liberal_arts_elective_credits = "SELECT liberal_arts_elective_credits FROM graduation_credits WHERE id = 1";
$result_gra_liberal_arts_elective_credits = $mysqli->query($sql_gra_liberal_arts_elective_credits);
$row_gra_liberal_arts_elective_credits = $result_gra_liberal_arts_elective_credits->fetch_assoc();
$gra_liberal_arts_elective_credits = $row_gra_liberal_arts_elective_credits['liberal_arts_elective_credits'];

$sql_gra_area1_credits = "SELECT area1_credits FROM graduation_credits WHERE id = 1";
$result_gra_area1_credits = $mysqli->query($sql_gra_area1_credits);
$row_gra_area1_credits = $result_gra_area1_credits->fetch_assoc();
$gra_area1_credits = $row_gra_area1_credits['area1_credits'];

$sql_gra_area2_credits = "SELECT area2_credits FROM graduation_credits WHERE id = 1";
$result_gra_area2_credits = $mysqli->query($sql_gra_area2_credits);
$row_gra_area2_credits = $result_gra_area2_credits->fetch_assoc();
$gra_area2_credits = $row_gra_area2_credits['area2_credits'];

$sql_gra_area3_credits = "SELECT area3_credits FROM graduation_credits WHERE id = 1";
$result_gra_area3_credits = $mysqli->query($sql_gra_area3_credits);
$row_gra_area3_credits = $result_gra_area3_credits->fetch_assoc();
$gra_area3_credits = $row_gra_area3_credits['area3_credits'];

$sql_gra_area4_credits = "SELECT area4_credits FROM graduation_credits WHERE id = 1";
$result_gra_area4_credits = $mysqli->query($sql_gra_area4_credits);
$row_gra_area4_credits = $result_gra_area4_credits->fetch_assoc();
$gra_area4_credits = $row_gra_area4_credits['area4_credits'];

// 각 필드별로 충족 여부를 확인합니다.
$total_satisfied = ($total_credits >= $gra_total_credits) ? "충족" : "미충족";
$major_required_satisfied = ($major_required_credits >= $gra_major_required_credits) ? "충족" : "미충족";
$major_optional_satisfied = ($major_optional_credits >= $gra_major_optional_credits) ? "충족" : "미충족";
$liberal_arts_required_satisfied = ($liberal_arts_required_credits >= $gra_liberal_arts_required_credits) ? "충족" : "미충족";
$liberal_arts_elective_satisfied = ($liberal_arts_elective_credits >= $gra_liberal_arts_elective_credits) ? "충족" : "미충족";
$area1_satisfied = ($area1_credits >= $gra_area1_credits) ? "충족" : "미충족";
$area2_satisfied = ($area2_credits >= $gra_area2_credits) ? "충족" : "미충족";
$area3_satisfied = ($area3_credits >= $gra_area3_credits) ? "충족" : "미충족";
$area4_satisfied = ($area4_credits >= $gra_area4_credits) ? "충족" : "미충족";

// 남은 학점 계산
$remaining_total_credits = max(0, $gra_total_credits - $total_credits);
$remaining_major_required_credits = max(0, $gra_major_required_credits - $major_required_credits);
$remaining_major_optional_credits = max(0, $gra_major_optional_credits - $major_optional_credits);
$remaining_liberal_arts_required_credits = max(0, $gra_liberal_arts_required_credits - $liberal_arts_required_credits);
$remaining_liberal_arts_elective_credits = max(0, $gra_liberal_arts_elective_credits - $liberal_arts_elective_credits);
$remaining_area1_credits = max(0, $gra_area1_credits - $area1_credits);
$remaining_area2_credits = max(0, $gra_area2_credits - $area2_credits);
$remaining_area3_credits = max(0, $gra_area3_credits - $area3_credits);
$remaining_area4_credits = max(0, $gra_area4_credits - $area4_credits);

$mysqli->close();
?>

<!-- 결과를 출력 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>학점 계산 페이지</title>
    <script>
        function showGraduatedCredits() {
            document.getElementById('graduated_credits').style.display = 'block';
            document.getElementById('remaining_credits').style.display = 'none';
        }

        function showRemainingCredits() {
            document.getElementById('graduated_credits').style.display = 'none';
            document.getElementById('remaining_credits').style.display = 'block';
        }
    </script>
</head>
<body>
    <h2>학점 계산</h2>

    <!-- 버튼 추가 -->
    <button onclick="showGraduatedCredits()">이수 학점 보기</button>
    <button onclick="showRemainingCredits()">남은 학점 보기</button>

    <!-- 이수 학점 -->
    <div id="graduated_credits" style="display: none;">
        <h3>이수 학점</h3>
        <?php
        echo "<p>총 학점 : $total_credits ($total_satisfied)</p>";
        echo "<p>전공필수 : $major_required_credits ($major_required_satisfied)</p>";
        echo "<p>전공선택 : $major_optional_credits ($major_optional_satisfied)</p>";
        echo "<p>교양필수 : $liberal_arts_required_credits ($liberal_arts_required_satisfied)</p>";
        echo "<p>교양선택 : $liberal_arts_elective_credits ($liberal_arts_elective_satisfied)</p>";
        echo "<p>제 1 영역 : $area1_credits ($area1_satisfied)</p>";
        echo "<p>제 2 영역 : $area2_credits ($area2_satisfied)</p>";
        echo "<p>제 3 영역 : $area3_credits ($area3_satisfied)</p>";
        echo "<p>제 4 영역 : $area4_credits ($area4_satisfied)</p>";
        ?>
    </div>

    <!-- 남은 학점 -->
    <div id="remaining_credits" style="display: none;">
        <h3>남은 학점</h3>
        <?php
        echo "<p>총 학점 : $remaining_total_credits ($total_satisfied)</p>";
        echo "<p>전공필수 : $remaining_major_required_credits ($major_required_satisfied)</p>";
        echo "<p>전공선택 : $remaining_major_optional_credits ($major_optional_satisfied)</p>";
        echo "<p>교양필수 : $remaining_liberal_arts_required_credits ($liberal_arts_required_satisfied)</p>";
        echo "<p>교양선택 : $remaining_liberal_arts_elective_credits ($liberal_arts_elective_satisfied)</p>";
        echo "<p>제 1 영역 : $remaining_area1_credits ($area1_satisfied)</p>";
        echo "<p>제 2 영역 : $remaining_area2_credits ($area2_satisfied)</p>";
        echo "<p>제 3 영역 : $remaining_area3_credits ($area3_satisfied)</p>";
        echo "<p>제 4 영역 : $remaining_area4_credits ($area4_satisfied)</p>";
        ?>
    </div>
</body>
</html>
