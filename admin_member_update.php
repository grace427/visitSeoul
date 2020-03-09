<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";

    if (isset($_SESSION["userLevel"])) $userlevel = $_SESSION["userLevel"];
    else $userlevel = "";

    if ( $userlevel != 1 ){
          alert_back('관리자가 아닙니다! 회원 정보 수정은 관리자만 가능합니다!');
    }

    $num = $_POST["num"];
    $level = $_POST["level"];
    $point = $_POST["point"];

    $sql = "update members set level=$level, point=$point where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);

    header('Location: admin.php');
?>
