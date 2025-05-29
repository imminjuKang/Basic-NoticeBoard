<!DOCTYPE html>
<?php
session_start();
session_destroy();

// 정상적으로 로그아웃이 되면
// !isset($_SESSION['user_id'])가 true
if (!isset($_SESSION['user_id']))
{
    echo "<script>alert('로그아웃 되었습니다.');</script>";
    echo "<script>location.replace('./index.php');</script>";
    exit;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>  
</body>
</html>