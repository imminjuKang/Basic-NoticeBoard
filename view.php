<?php
// 파일 다운로드 가능 & 글 내용 확인 & 수정 및 삭제 
include("./dbconnect.php");
$idx = $_GET['post_id'];

// 조회수 증가
$update_sql = "UPDATE post_list SET post_views = post_views + 1 WHERE post_id = $idx";
mysqli_query($connect, $update_sql);

$sql = "SELECT * FROM post_list WHERE post_id = $idx";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!--누른 그 게시물 출력해주기-->
    <h1>게시글</h1>
    <label>제목</label>
    <p><?php echo htmlentities($row['post_title']) ?></p><br>

    <label>내용</label><br>
    <p><?php echo htmlentities($row['post_content']) ?></p><br>

    <?php
    if ($row['post_file']) {
        $filename = $row['post_file'];
        echo "<label>파일</label><br>";
        // uploads 안에 넣어둔 파일 다운로드할 수 있게 함
        echo "<a href='uploads/$filename' download>$filename</a><br><br>";
    }
    ?>

    <!--현재 세션의 아이디와 글 아이디를 비교해서 수정이랑 삭제 가능하게 하기-->
    <button onclick="location.href='modify.php?post_id=<?= $row['post_id'] ?>'">수정</button>
    <button onclick="location.href='delete.php?post_id=<?= $row['post_id']?>'">삭제</button>
</body>

</html>
