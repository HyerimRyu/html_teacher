<?php
    session_start();

    //세션에 저장되어 있는 회원정보 중 id, nickname, level값 읽어오기
    if( isset($_SESSION['userid']) ) $userid=$_SESSION['userid'];
    if( isset($_SESSION['usernick']) ) $usernick=$_SESSION['usernick'];
    if( isset($_SESSION['userlevel']) ) $userlevel=$_SESSION['userlevel'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>로그인</title>

        <!-- 공통스타일 적용 -->
        <link rel="stylesheet" href="../css/common.css">
        <!-- 로그인폼 전용스타일 적용 -->
        <link rel="stylesheet" href="../css/login.css">

    </head>
    <body>
        <div id="wrap">
            <header id="header">
                <!-- 공통모듈 -->
                <?php include "../lib/top_login2.php"; ?>
            </header>
            <nav id="menu">
                <!-- 공통모듈 -->
                <?php include "../lib/top_menu2.php"; ?>
            </nav>

            <div id="content">
                <!-- 왼쪽 사이드 메뉴 -->
                <aside id="col1">
                    <div id="left_menu">
                        <!-- 공통모듈 -->
                        <?php include "../lib/left_menu.php"; ?>
                    </div>
                </aside>

                <!-- 본문영역 -->
                <article id="col2">

                    <!-- member테이블에 저장된 id와 검증하는 login.php로 제출하는 form요소 -->
                    <form action="./login.php" method="post" name="login_form">
                        <!-- 타이틀 영역 -->
                        <div id="title">
                            <img src="../img/title_login.gif" alt="로그인">
                        </div>

                        <!-- 타이틀 영역 아래 로그인 폼 화면 영역 -->
                        <div id="form_login">
                            <!-- 로그인 안내메세지 -->
                            <img src="../img/login_msg.gif" id="login_msg">

                            <!-- float스타일 제거요소 -->
                            <div class="clear"></div>

                            <!-- 좌물쇠모양 이미지 -->
                            <div id="login1">
                                <img src="../img/login_key.gif">
                            </div>

                            <!-- 사용자 입력 요소영역 -->
                            <div id="login2">
                                <!-- 아이디,비번 라벨글씨 -->
                                <div id="id_pw_label">
                                    <ul>
                                        <li><img src="../img/id_title.gif" alt="아이디"></li>
                                        <li><img src="../img/pw_title.gif" alt="비밀번호"></li>
                                    </ul>
                                </div>
                                <!-- 아이디,비번 입력요소들 -->
                                <div id="id_pw_input">
                                    <ul>
                                        <!-- 추후 css작업을 위해 class지정 -->
                                        <li><input type="text" name="id" class="login_input"></li>
                                        <li><input type="password" name="pass" class="login_input"></li>
                                    </ul>
                                </div>
                                <!-- 로그인 버튼 -->
                                <div id="login_button">
                                    <!-- JS의 submit()은 해봤으니 -->
                                    <!-- 이미지를 클릭하면 자동 form요소의 submit이 실행되도록 -->
                                    <input type="image" src="../img/login_button.gif">
                                </div>

                                <!-- float스타일 제거 요소 -->
                                <div class="clear"></div>

                                <!-- 회원가입 안내 영역 -->
                                <div id="join_button">
                                    <!-- 회원아닌지 여부 안내 메세지 이미지 -->
                                    <img src="../img/no_join.gif">

                                    <!-- 둘사이에 간격띄우기 .. 공백문자 4칸 -->
                                    &nbsp;&nbsp;&nbsp;&nbsp;

                                    <!-- 회원가입페이지 이동 버튼이미지 -->
                                    <a href="../member/member_form.php">
                                        <img src="../img/join_button.gif" alt="회원가입">
                                    </a>
                                </div>

                            </div>
                            <!-- login2 -->

                            

                        </div>
                    </form>

                    


                </article>
            </div>
        </div>
    </body>
</html>