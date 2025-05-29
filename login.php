<!DOCTYPE html>
<?php
session_start();

include("./dbconnect.php");
// post action을 받음
$user_email = trim($_POST['id']);
$user_pwd = trim($_POST['password']);
                                    
if (!$user_email || !$user_pwd){
    echo "<script>alert('아이디나 비밀번호가 잘못되었습니다.');</script>";
    echo "<script>location.replace('./index.php');</script>";
    exit;
}

// 아이디와 비밀번호 체크
$sql = "SELECT * FROM user_list WHERE user_email = '$user_email'";
$result = mysqli_query($connect, $sql);
// 결과값 한 줄을 연관 배열로 바꿈 (assoc array) -> column 이름으로 값 접근 가능
$user = mysqli_fetch_assoc($result);


if ($user_email != $user['user_email'] || $user_pwd != $user['user_pwd'])
{
    echo "<script>alert('잘못된 아이디 혹은 비밀번호입니다');</script>";
    echo "<script>location.replace('./index.php');</script>";
    exit;
}

$_SESSION['user_email'] = $user_email;

if (isset($_SESSION['user_email'])) {
    echo "<script>alert('로그인 되었습니다');</script>";
    echo "<script>location.replace('./index.php');</script>";
    exit;
}

mysqli_close($connect);
?>
