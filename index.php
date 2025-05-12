<?/*전체 글 확인
1. 로그인이 안 되었을 때 처리
2. index 화면*/?>

<div class="loginButton">
    <?php
    if (isset($_SESSION) == false){session_start();}
    if (isset($_SESSION['id'])== false){
    ?>
    <a href="login.php">로그인</a>
    <a href="register.php">회원가입</a>
    <?php
    } else{
    ?>
    <a href="logout.php">로그아웃</a>
    <?php
    }
    ?>
</div>

<div class="index">
    <h1>게시판</h1>
    <button onclick="writePost()">글쓰기</button>
    <table>
        <tr>
            <th width="70">번호</th>
            <th width="500">제목</th>
            <th width="120">작성자</th>
            <th width="100">작성일</th>
            <th width="70">조회수</th>
        </tr>