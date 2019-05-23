<?php
    session_start();

    //세션에 저장되어 있는 회원정보 중 id, nickname, level값 읽어오기
    if( isset($_SESSION['userid']) ) $userid=$_SESSION['userid'];
    if( isset($_SESSION['usernick']) ) $usernick=$_SESSION['usernick'];
    if( isset($_SESSION['userlevel']) ) $userlevel=$_SESSION['userlevel'];
?>

<!-- 메인 홈화면 설계 : html -->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>루바또</title>

        <!-- 공통 스타일시트 연결 -->
        <link rel="stylesheet" href="./css/common.css">
    </head>
    <body>
        <div id="wrap">
            <header id="header">
                <!-- 공통사용 php문서 추가하기 : 공통으로 사용하는 php는 lib폴더에 제작[공통모듈] -->
                <?php include "./lib/top_login.php"; ?>
            </header>

            <nav id="menu">
                <!-- 공통사용 php문서 추가  -->
                <?php include "./lib/top_menu.php"; ?>
            </nav>

            <div id="content">
                <!-- 메인화면 이미지 -->
                <div id="main_img"><img src="./img/main_img.jpg" alt="main image"></div>
            </div>
        </div>        
    </body>    
</html>