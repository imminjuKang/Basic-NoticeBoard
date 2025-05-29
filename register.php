<!DOCTYPE html>
<?php
// db와 연동
include("./dbconnect.php");

$email = trim($_POST['email']);
$name = trim($_POST['name']);
$pwd = trim($_POST['password']);

// db에서 같은 email을 찾기
$sql = "SELECT * FROM user_list WHERE user_email = '$email'";
// 그 결과를 $result 변수에 저장
$result = mysqli_query($connect, $sql);

// query가 몇 줄 나왔는지 확인하기 
if (mysqli_num_rows($result) > 0) // 같은 이메일 존재하는지 중복 확인
{
    echo "<script>alert('이미 사용 중인 이메일입니다.');</script>";
    echo "<script>location.replace('./index.php');</script>";
    exit;
}

// 회원가입 성공 시 그 정보 db에 저장
else
{
    $sql = "INSERT INTO user_list (user_email, user_name, user_pwd) VALUES ('$email', '$name', '$pwd')";
    
    if (mysqli_query($connect, $sql)) 
    {
        // 회원가입 성공하면 index 페이지로 가기
        echo "<script>alert('회원가입 성공');</script>";
        echo "<script>location.replace('./index.php');</script>";
        exit;
    } 
    else 
    {
        echo "회원가입 실패: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
?>