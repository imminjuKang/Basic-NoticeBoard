<!--글 삭제하기-->
<?php
session_start();
include("./dbconnect.php");
$idx = $_GET['post_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idx = $_POST['post_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM post_list WHERE post_id = $idx";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    // 현재 로그인된 사용자 이메일을 본 다음에, 자신만 삭제 가능
    if ($_SESSION['user_email'] != $row['user_email']) {
        echo "<script>alert('삭제 권한이 없습니다.');</script>";
        echo "<script>location.replace('./index.php');</script>";
        exit;
    }

    // 삭제하려면 패스워드 입력 -> 맞으면 db에서 삭제하기
    $email = $_SESSION['user_email'];
    $user_sql = "SELECT user_pwd FROM user_list WHERE user_email = '$email'";
    $user_result = mysqli_query($connect, $user_sql);
    $user_row = mysqli_fetch_assoc($user_result);

    if ($password !== $user_row['user_pwd']) {
        echo "<script>alert('비밀번호가 틀렸습니다.');</script>";
        echo "<script>location.replace('./index.php');</script>";
        exit;
    }

    // db에서 삭제 
    $delete_sql = "DELETE FROM post_list WHERE post_id = $idx";
    mysqli_query($connect, $delete_sql);

    echo "<script>alert('삭제 완료되었습니다.');</script>";
    echo "<script>location.replace('./index.php');</script>";
    exit;
}
?>

<form method="post" action="delete.php">
    <h1>글 삭제</h1>
    <input type="hidden" name="post_id" value="<?= $idx ?>">
    <label>비밀번호 입력</label><br><br>
    <input type="text" name="password" style="width:300px; height:30px;"><br><br>
    <input type="submit" value="삭제">
</form>