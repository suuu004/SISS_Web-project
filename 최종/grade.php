<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>학점 관리</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-top: 50px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        li {
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        a:hover {
            color: #007bff;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>학점 관리</h2>
    <ul>
        <li><a href="graduate_credits.html">이수 학점 입력</a></li>
        <li><a href="grade_calculation.php">학점 계산</a></li>
    </ul>
    <button onclick="location.href='home.php'">홈으로 돌아가기</button>
</body>
</html>
