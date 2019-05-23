<?php
    session_start();

    if( isset($_SESSION['userid']) ) $userid=$_SESSION['userid'];
    if( isset($_SESSION['usernick']) ) $usernick=$_SESSION['usernick'];
    if( isset($_SESSION['userlevel']) ) $userlevel=$_SESSION['userlevel'];

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>회원가입</title>

        <!-- 공통스타일시트 적용 -->
        <link rel="stylesheet" href="../css/common.css">
        <!-- 고유스타일시트 적용 -->
        <link rel="stylesheet" href="../css/member.css">

        <!-- 자바스크립트로 submit 하기. -->
        <script>
            function joinSubmit(){

                //input요소중에서 필수요소는 비어있으면 안됨
                //input요소에 required속성을 지정하였음..
                //단, 문제는 js로 submit()을 하면 required가 발동하지 못함.

                // 그래서 이 유효성검사를 js에서 직접 해줘야만 함.

                //아이디 칸이 비어 있는가?
                if( !document.member_form.id.value ){
                    alert("아이디를 입력하세요.");
                    //커서가 자동으로 이 인풋요소로 이동
                    document.member_form.id.focus();
                    return;
                }

                //패스워드 칸이 비어 있는가?
                if( !document.member_form.pass.value ){
                    alert("비밀번호를 입력하세요.");
                    //커서가 자동으로 이 인풋요소로 이동
                    document.member_form.pass.focus();
                    return;
                }

                //패스워드확인 칸이 비어 있는가?
                if( !document.member_form.pass_confirm.value ){
                    alert("비밀번호확인칸을 입력하세요.");
                    //커서가 자동으로 이 인풋요소로 이동
                    document.member_form.pass_confirm.focus();
                    return;
                }

                //이름 칸이 비어 있는가?
                if( !document.member_form.name.value ){
                    alert("이름을 입력하세요.");
                    //커서가 자동으로 이 인풋요소로 이동
                    document.member_form.name.focus();
                    return;
                }

                //닉네임 칸이 비어 있는가?
                if( !document.member_form.nick.value ){
                    alert("닉네임을 입력하세요.");
                    //커서가 자동으로 이 인풋요소로 이동
                    document.member_form.nick.focus();
                    return;
                }

                //휴대폰 칸이 비어 있는가?
                if( !document.member_form.hp2.value ){
                    alert("휴패폰번호를 입력하세요.");
                    //커서가 자동으로 이 인풋요소로 이동
                    document.member_form.hp2.focus();
                    return;
                }

                //휴대폰 칸이 비어 있는가?
                if( !document.member_form.hp3.value ){
                    alert("휴패폰번호를 입력하세요.");
                    //커서가 자동으로 이 인풋요소로 이동
                    document.member_form.hp3.focus();
                    return;
                }


                //패스워드와 패스워드확인칸이 같지 않은가?
                if( document.member_form.pass.value != document.member_form.pass_confirm.value ){
                    alert("비밀번호를 다시 확인하세요.");
                    document.member_form.pass_confirm.focus();
                    // 보통 다시 비밀번호를 쓰기 위해 백스페이스를 누르기 귀찮아서 전체선택상태로 있음
                    document.member_form.pass_confirm.select();

                    return;
                }

                //form요소를 찾아와서 submit 명령을 실행
                document.member_form.submit();

            }

            function joinReset(){

                //써있는 글씨 모두 초기화
                document.member_form.id.value="";
                document.member_form.pass.value="";
                document.member_form.pass_confirm.value="";
                document.member_form.name.value="";
                document.member_form.nick.value="";
                document.member_form.hp1.value="010";
                document.member_form.hp2.value="";
                document.member_form.hp3.value="";
                document.member_form.email1.value="";
                document.member_form.email2.value="";

                document.member_form.id.focus();
            }


            // 아이디 중복확인
            function checkId(){
                //사용자가 입력한 'id'값 얻어오기
                var userid= document.member_form.id.value;
                //DB에서 같은 아이디가 있는지 확인하고 
                //그 결과를 보여주는 새로운 윈도울 띄우기
                open("./checkId.php?id="+userid,"아이디 체크","width=300,height=100, left=200, top=100");
            }

            // 닉네임 중복확인
            function checkNick(){
                //사용자가 입력한 '닉네임'값 얻어오기
                var usernick= document.member_form.nick.value;
                //DB에서 같은 닉네임가 있는지 확인하고 
                //그 결과를 보여주는 새로운 윈도울 띄우기
                open("../member/checkNick.php?nick="+usernick,"닉네임 체크","width=300,height=100, left=200, top=100");
                
            }
            
            
        </script>
    </head>

    <!-- input요소들에 회원정보를 미리 기입해놓기위해 -->
    <!-- member테이블에서 회원정보 가져오기 -->
    <?php

        //아이디, 닉네임, 레빌은 이미 세션에 저장되어 있음.
        //나머지 정보만 가져오기
        //DB접속
        include "../lib/dbconn.php";

        //로그인되어 있는 회원이 id를 이용하여 해당하는 정보 얻어오는 쿼리문
        $sql= "select * from member where id='$userid'";
        $result= mysqli_query($conn, $sql);
        $row= mysqli_fetch_array($result, MYSQLI_ASSOC);

        $pass= $row['pass'];
        $name= $row['name'];
        $hp= $row['hp'];
        $email= $row['email'];

        //휴대폰번호는 3개로 나눠야 하므로.. '-'를 기준으로 분리
        $hps= explode("-", $hp);//리턴값은 배열 : 길이-3

        //이메일도 2개로 분리 '@'기준
        $emails= explode("@", $email);//길이-2

        mysqli_close($conn);
    ?>

    <body>
        <div id="wrap">
            <header id="header">
                <!-- 공통모듈 사용 -->
                <?php include "../lib/top_login2.php"; ?>
            </header>

            <nav id="menu">
                <!-- 공통모듈 사용 -->
                <?php include "../lib/top_menu2.php"; ?>
            </nav>

            <div id="content">
                <!-- 왼쪽 사이드 메뉴 영역 : 공통모듈-->
                <aside id="col1">
                    <div id="left_menu">
                        <?php include "../lib/left_menu.php"; ?>
                    </div>
                </aside>

                <!-- 나머지 본문 콘텐츠 영역 -->
                <article id="col2">
                    <!-- member테이블에 회원정보 update 하는 form요소 -->
                    <form action="./modify.php" method="post" name="member_form">
                        <!-- 제목영역 -->
                        <div id="title">
                            <img src="../img/title_member_modify.gif" alt="회원정보수정">
                        </div>

                        <!-- 제목영역 아래 input들 영역 -->
                        <div id="form_join">
                            <!-- 라벨들 영역 -->
                            <div id="join_labels">
                                <ul>
                                    <li>* 아이디</li>
                                    <li>* 비밀번호</li>
                                    <li>* 비밀번호 확인</li>
                                    <li>* 이름</li>
                                    <li>* 닉네임</li>
                                    <li>* 휴대폰</li>
                                    <li>&nbsp;&nbsp;이메일</li>
                                </ul>
                            </div>

                            <!-- input요소들 영역 -->
                            <div id="join_inputs">
                                <ul>
                                    <li>
                                        <input type="text" name="id" value="<?php echo $userid; ?>" readonly style="background-color:#eeeeee">
                                    </li>
                                    <li><input type="password" name="pass" required value="<?=$pass?>"></li>
                                    <li><input type="password" name="pass_confirm" required value="<?=$pass?>"></li>
                                    <li><input type="text" name="name" required value="<?=$name?>"></li>
                                    <li>
                                        <div id="nick1"><input type="text" name="nick" required value="<?=$usernick?>"></div>
                                        <div id="nick2"><a href="#"><img src="../img/check_id.gif" onclick='checkNick()'></a></div>
                                    </li>
                                    <li>
                                        <select name="hp1" class="hp">
                                            <option value="010" <?php if($hps[0]=='010') echo "selected"; ?> >010</option>
                                            <option value="011" <?php if($hps[0]=='011') echo "selected"; ?> >011</option>
                                            <option value="017" <?php if($hps[0]=='017') echo "selected"; ?> >017</option>
                                        </select>
                                         - 
                                        <input type="text" name="hp2" class="hp" required value="<?=$hps[1]?>"> 
                                         - 
                                        <input type="text" name="hp3" class="hp" required value="<?=$hps[2]?>">
                                    </li>
                                    <li>
                                        <input type="text" name="email1" id="email1" value="<?=$emails[0]?>"> @ <input type="text" name="email2" id="email2" value="<?=$emails[1]?>">
                                    </li>
                                </ul>                                
                            </div>
                            <!-- join_inputs영역 끝 -->
                            <div class="clear"></div>
                            <div id="join_must"> * 는 필수 입력항목입니다.</div>
                        </div>

                        <!-- 저장버튼, 취소버튼 -->
                        <!-- 저장버튼을 누르면 원래는 form요소에 설정한 action속성값 insert.php문서가 실행되야 하지만 -->
                        <!-- 버튼의 타입이 submit으로 되어 있지 않아서 자동으로 insert.php가 실행되지 못함 -->
                        
                        <!-- TODO : javascript를 이용해서 form요소의 submit을 강제로 실행시켜볼 것임. -->
                        <div id="join_button">
                            <a href="#"><img src="../img/button_save.gif" alt="save" onclick="joinSubmit()"></a>
                            <a href="#"><img src="../img/button_reset.gif" alt="reset" onclick="joinReset()"></a>
                        </div>
                    </form>
                </article>
            </div>

        </div>
    </body>
</html>