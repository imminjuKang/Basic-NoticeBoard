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
$sql = "SELECT * FROM user_list WHERE user_email = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "s", $user_email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// register에서 password_hash()로 저장했기 때문에
// password_verify()로 비밀번호 비교
if ($user && password_verify($user_pwd, $user['user_pwd'])) {
    $_SESSION['user_email'] = $user['user_email'];
    echo "<script>alert('로그인 되었습니다');</script>";
    echo "<script>location.replace('./index.php');</script>";
    exit;
}
else
{
    echo "<script>alert('잘못된 아이디 혹은 비밀번호입니다');</script>";
    echo "<script>location.replace('./index.php');</script>";
    exit;
}

mysqli_close($connect);
?>
