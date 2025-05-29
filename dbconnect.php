<?php
// db 연결하기
$mysql_host = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_db = "noticeboard";
$connect = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

// 연결이 제대로 안 되면 종료
if (!$connect){
    die("연결 실패: " .mysqli_connect_error());
}

ini_set("display_errors", 'Off'); // 오류 메시지 숨김
session_start(); // 세션 시작
?>