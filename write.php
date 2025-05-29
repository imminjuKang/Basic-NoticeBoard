<?php
session_start();
$user_email = $_SESSION['user_email'];

// DB에 작성 내용 저장해두기
include ("./dbconnect.php");
// 작성한 내용이 존재하면
// db에 insert into "post_content"
$title = $_POST["title"];
$content = $_POST["content"];

// 파일 업로드하고 디렉토리에 저장하기
// db에는 파일 이름만 저장
$upload_dir = "uploads/";
$filename = $_FILES["upload_file"]["name"];
$file = $_FILES["upload_file"]["tmp_name"];
$filepath = $upload_dir . $filename;

if ($filename != "") {
    move_uploaded_file($file, $filepath);   
}

$sql = "INSERT INTO post_list (post_title, post_content, post_file, user_email) VALUES ('$title', '$content', '$filename', '$user_email')";

if (mysqli_query($connect, $sql)) {
    echo "<script>alert('게시글이 등록되었습니다'); location.href='index.php';</script>";
} 
else {
    echo "게시글 등록 실패: " . mysqli_error($connect);
}
?>