<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";
    
    if (isset($_SESSION["userLevel"])) $userlevel = $_SESSION["userLevel"];
    else $userlevel = "";

    if ( $userlevel != 1 ){
      alert_back('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!');
    }

    if (isset($_POST["item"])){
       $num_item = count($_POST["item"]);
    }
    else{
        alert_back('삭제할 게시글을 선택해주세요!');
    }

    for($i=0; $i<count($_POST["item"]); $i++){
        $num = $_POST["item"][$i];

        $sql = "select * from board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $copied_name = $row["file_copied"];

        if ($copied_name){
            $file_path = "./data/".$copied_name;
            unlink($file_path);
        }

        $sql = "delete from board where num = $num";
        mysqli_query($con, $sql);
    }

    mysqli_close($con);

    header('Location:admin.php');
?>
