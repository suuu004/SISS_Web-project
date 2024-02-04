<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
    <body>

        <?php

            $con = mysqli_connect("localhost","root","1111","privacy");
            $sql = "select * from member01";
            $result = mysqli_query($con, $sql);
            
            while($row = mysqli_fetch_assoc($result)) {

                $member_email = $row['member_email'];
                $member_name = $row['member_name'];
                $member_password = $row['member_password'];
                $member_password_confirm = $row['member_password_confirm'];

                echo $member_email."<br>";
                echo $member_name."<br>";
                echo $member_password."<br>";
                echo $member_password_confirm."<br>";
                echo "======================================"."<br>";
            } 
                
        ?>

    </body>
</html>
