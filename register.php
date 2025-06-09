<!DOCTYPE html>
<?php
// db와 연동
include("./dbconnect.php");

$email = trim($_POST['email']);
$name = trim($_POST['name']);
$pwd = trim($_POST['password']);

// db에서 같은 email을 찾기
// prepared statement 사용
$sql = "SELECT * FROM user_list WHERE user_email = ?";
$stmt = mysqli_prepare($connect, $sql); // statement object 생성
mysqli_stmt_bind_param($stmt, "s", $email); // 문자열 1개에 대해 실제 값 binding
mysqli_stmt_execute($stmt); // query 실행하고 결과 얻기
$result = mysqli_stmt_get_result($stmt); // 결과 반환

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
    $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user_list (user_email, user_name, user_pwd) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $email, $name, $hashed_pwd);
    
    if (mysqli_stmt_execute($stmt)) 
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
