<!--글 수정하기-->
<?php
// db 쿼리는 select와 update 두 개가 존재
// select는 수정하기 전에 내용을 보여주기, update는 수정한 내용 반영
include("./dbconnect.php");
// HTTP 요청 메소드가 POST인 경우에만 해당 코드(수정) 실행
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idx = $_POST['post_id'];
    $title = $_POST['post_title'];
    $content = $_POST['post_content'];

    $upload_dir = "uploads/";
    $filename = $_FILES["upload_file"]["name"];
    $file = $_FILES["upload_file"]["tmp_name"];
    $filepath = $upload_dir . $filename;


    if ($filename != "") {
        move_uploaded_file($file, $filepath);
        $sql = "UPDATE post_list 
                SET post_title = '$title', post_content = '$content', post_file = '$filename' 
                WHERE post_id = $idx";
    } 
    else {
        $sql = "UPDATE post_list 
                SET post_title = '$title', post_content = '$content' 
                WHERE post_id = $idx";
    }

    mysqli_query($connect, $sql);

    echo "<script>alert('수정 완료');</script>";
    echo "<script>location.replace('./index.php');</script>";
    exit;
}

// 수정 눌렀을 때 보이는 화면을 출력하기 위한 db query
session_start();
$idx = $_GET['post_id'];
$sql = "SELECT * FROM post_list WHERE post_id = $idx";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

// 현재 로그인된 사용자 이메일을 본 다음에, 자신만 수정 가능
if ($_SESSION['user_email'] !== $row['user_email']) {
    echo "<script>alert('수정 권한이 없습니다.');</script>";
    echo "<script>location.replace('./index.php');</script>";
    exit;
}

$title = $row['post_title'];
$content = $row['post_content'];
?>

<form method="post" action="modify.php" enctype="multipart/form-data">
    <h1>글 수정</h1>
    <input type="hidden" name="post_id" value="<?= $idx ?>">
    <label>제목</label>
    <input type="text" name="post_title" value="<?= $title ?>"><br><br>
    <label>내용</label><br>
    <textarea name="post_content" rows="20" cols="80"><?= $content ?></textarea><br><br>
    <label>파일 업로드</label><br>
    <input type="file" name="upload_file"><br><br>
    <input type="submit" value="확인">
</form>
