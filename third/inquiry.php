<!-- inquiry.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>문의 사항</title>
</head>
<body>
    <h2>문의 사항 남기기</h2>
    
    <form action="process_inquiry.php" method="post">
        <label for="name">이름:</label>
        <input type="text" name="name" required><br>
        
        <label for="email">이메일:</label>
        <input type="email" name="email" required><br>
        
        <label for="message">문의 내용:</label>
        <textarea name="message" rows="4" required></textarea><br>
        
        <button type="submit">문의 남기기</button>
    </form>
</body>
</html>
