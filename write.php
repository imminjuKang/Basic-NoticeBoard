<?php
session_start();
$user_email = $_SESSION['user_email'];

// DB에 작성 내용 저장해두기
include ("./dbconnect.php");
// 작성한 내용이 존재하면
// db에 insert into "post_content"
$title = htmlspecialchars($_POST["title"]);
$content = htmlspecialchars($_POST["content"]);

// 파일 업로드하고 디렉토리에 저장하기
// db에는 파일 이름만 저장
$upload_dir = "uploads/";
$filename = null;
$file = null;

// 파일 종류 제한
$extensions = ['jpg', 'jpeg', 'png', 'pdf', 'txt', 'zip'];

if (isset($_FILES["upload_file"]) && $_FILES["upload_file"]["error"] == 0) {
    $filename = $_FILES["upload_file"]["name"];
    $file = $_FILES["upload_file"]["tmp_name"];
    $filepath = $upload_dir . $filename;

    $test = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (!in_array($test, $extensions)){
    echo "<script>alert('허용되지 않은 파일 형식입니다.'); location.href='write.php';</script>";
    exit;
}

    move_uploaded_file($file, $filepath);

} else {
    $filename = null;
}

if ($filename == "" || !isset($filename)){
    $sql = "INSERT INTO post_list (post_title, post_content, post_file, user_email) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $sql);
    $null = NULL;
    mysqli_stmt_bind_param($stmt, "ssss", $title, $content, $null, $user_email);
} else{
    $sql = "INSERT INTO post_list (post_title, post_content, post_file, user_email) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $title, $content, $filename, $user_email);
}


if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('게시글이 등록되었습니다'); location.href='index.php';</script>";
} 
else {
    echo "게시글 등록 실패: " . mysqli_error($connect);
}
?>
