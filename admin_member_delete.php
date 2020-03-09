<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";

    if (isset($_SESSION["userLevel"])) $userlevel = $_SESSION["userLevel"];
    else $userlevel = "";

    if ( $userlevel != 1 ){
      alert_back('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!');
    }

    $num = $_GET["num"];

    $sql = "delete from members where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    header('Location: admin.php');
?>
