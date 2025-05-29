<?php
session_start();
include("./dbconnect.php");
?>

<?/*전체 글 확인(메인 화면)
1. 로그인이 안 되었을 때 처리
2. index 화면*/ ?>

<div class="loginButton">
    <?php
    // 로그인이 되어 있으면 로그아웃
    if (isset($_SESSION['user_email'])) {
    ?>
        <a href="logout.php">로그아웃</a>
    <?php
    } else {
    ?>
        <a href="login_frame.php">로그인</a>
        <a href="register_frame.php">회원가입</a>
    <?php
    }
    ?>
</div>

<div class="index">
    <h1>게시판</h1>
    <!--글쓰기는 로그인이 되었을 때만 가능-->
    <?php
    if (isset($_SESSION['user_email'])) {
    ?>
        <button onclick="location.href='write_frame.php'">글쓰기</button>
    <?php
    } else {
    ?>
        <button onclick="alert('로그인 후 글쓰기가 가능합니다.');">글쓰기</button>
    <?php
    }
    ?>
    <table>
        <tr>
            <th width="70">번호</th>
            <th width="400">제목</th>
            <th width="120">작성자</th>
            <th width="70">조회수</th>
        </tr>
        <?php
        // 게시글을 작성한 작성자를 찾기 위해 JOIN 연산 활용
        // user_list 는 u로 명명, post_list는 p로 명명해서 
        // 글을 작성한 email의 이름을 찾기 위해 join으로 user_list에서 name 찾기
        $sql = "SELECT p.post_id, p.post_title, u.user_name, p.post_views 
        FROM post_list p
        JOIN user_list u ON p.user_email = u.user_email";
        $result = mysqli_query($connect, $sql);

        // 배열의 모든 행 가져오기 
        // 가져올 행이 없으면 false 반환 -> 있으면 while문 계속 실행
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['post_id'] . "</td>";
            // 제목을 누르면 해당 글을 확인할 수 있게 제목에 href 걸기
            echo "<td><a href='view.php?post_id={$row['post_id']}'>" . $row['post_title'] . "</a></td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['post_views'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

