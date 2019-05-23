<?php
    session_start();
?>

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

<?php
    //modify_form.php로 부터 post로 전달받은 값 받기
    $id= $_POST['id'];
    $pass= $_POST['pass'];
    $name= $_POST['name'];
    $nick= $_POST['nick'];
    $hp= $_POST['hp1']."-".$_POST['hp2']."-".$_POST['hp3'];
    $email= $_POST['email1']."@".$_POST['email2'];

    //DB에 연결
    include "../lib/dbconn.php";

    //업데이트하는 쿼리문
    $sql="update member set pass='$pass', name='$name', nick='$nick', hp='$hp', email='$email' where id='$id'";

    mysqli_query($conn, $sql);
    mysqli_close($conn);

    //세션의 정보를 변경
    $_SESSION['username']= $name;
    $_SESSION['usernick']= $nick;

    //업데이트 작업이 종료된 후 다시 처음 홈화면으로 이동
    echo ("
        <script>
            location.href='../index.php';
        </script>
    ");

?>