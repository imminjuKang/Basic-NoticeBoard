<!--글쓰기 화면 & 파일 업로드-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<!--모든 내용은 write.php로 전송함-->
    <form method="post" action="write.php" enctype="multipart/form-data">
        <h1>글쓰기</h1>
        <label>제목</label><br>
        <input type="text" name="title" style="width:500px; height:30px;"><br><br>
        <label>내용</label><br>
        <textarea name="content" rows="20" cols="80"></textarea><br><br>
        <label>파일 업로드</label><br>
        <input type="file" name="upload_file"><br><br>
        <input type="submit" value="업로드">
    </form>
</body>

</html>