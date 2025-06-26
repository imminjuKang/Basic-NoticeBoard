<?php
session_start();
include("./dbconnect.php");

$idx = $_GET['post_id'];

$sql = "SELECT * FROM post_list WHERE post_id = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "i", $idx);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$post = mysqli_fetch_assoc($result);


if (!$post){
    die("게시글이 없습니다.");
}

$file = $post['post_file'];
$filepath = __DIR__ . "/uploads/" . $file;

// 경로 우회 차단
if (str_contains($file, '/') || str_contains($file, '\\') || str_contains($file, '..')) {
    die("잘못된 요청입니다.");
}

if (!file_exists($filepath)) {
    die("파일이 존재하지 않습니다.");
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename= ' .$file);
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: no-cache');
header('Content-Length: ' . filesize($filepath));

readfile($filepath);
exit;
?>
