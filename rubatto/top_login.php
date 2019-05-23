<!-- 홈페이지 메인 로고 아이콘 이미지 -->
<div id="logo"><a href="./index.php"><img src="./img/logo.gif" alt="rubatto"></a></div>
<!-- 홈페이지 상단 모토 이미지 -->
<div id="moto"><img src="./img/moto.gif" alt="moto"></div>

<!-- 우측상단의 로그인/회원가입 여부 표시..로그인상태 -->
<div id="top_login">

<?php
    //세션에 저장된 로그인정보가 없는가??
    if( !isset($userid) ){
        //로그인페이지로 이동하는 링크
        echo "<a href='./login/login_form.php'>로그인</a> | ";
        echo "<a href='./member/member_form.php'>회원가입</a>";
    }else{
        //로그인이 되어있는 회원 닉네임과 레벨값 표시
        echo "$usernick (level:{$userlevel}) | ";
        echo "<a href='./login/logout.php'>로그아웃</a> | ";
        echo "<a href='./login/modify_form.php'>정보수정</a>";        
    }
?>

</div>