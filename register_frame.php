<html>
<head>
    <title>회원가입</title>
</head>
<body>
    <div class="login">
        <h1>회원가입</h1>
        <form method="post" action="register.php">
            <table>
                <tr>
                    <td style="text-align:right; font-weight:bolder;">아이디</td>
                    <td style="text-align:left;"><input type="text" name="email" required placeholder="ex. admin1234@email.com" size="40"></td>
                </tr>
                <tr>
                    <td style="text-align:right; font-weight:bolder;">이름</td>
                    <td style="text-align:left;"><input type="text" name="name" required placeholder="ex. 홍길동" size="40"></td>
                </tr>
                <tr>
                    <td style="text-align:right; font-weight:bolder;">비밀번호</td>
                    <td style="text-align:left;"><input type="password" name="password" required placeholder="ex. qwer1234" size="40"></td>
                </tr>
                <tr class="loginSubmit">
                    <td><input type="submit" value="회원가입"></td>
                </tr>
            </table>
        </form>
    </div>   
</body>
</html>