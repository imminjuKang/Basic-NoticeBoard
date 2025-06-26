# Basic_NoticeBoard

1. xampp 활용해서 게시판 제작 후 aws 프리티어 활용해 외부에서 접속 가능하도록 서버 구축

-기능 : 회원가입, 로그인, 로그아웃, 글쓰기, 글수정, 글삭제, 파일업로드, 조회수

-초기 보안 패치 : password 해시화, prepared statement, htmlspecialchars

2. 모의해킹 진행 후 보안 패치 진행

-디렉토리 리스팅 문제 : apache2.conf, 000-default.conf 파일에서 indexes 옵션 삭제

-
