<?php
  include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";

  $userId = $_POST["userId"];
  $userPw = $_POST["userPw"];

  $sql = "select * from members where id='$userId'";
  $result = mysqli_query($con, $sql);

  $num_match = mysqli_num_rows($result);
  if(!$num_match){
    alert_back('가입되지 않은 아이디 입니다. 다시 입력해주세요');
    $userId="";
  }else{
    $pw_match = mysqli_fetch_array($result);
    if($userPw != $pw_match['pw']){
      alert_back('비밀번호를 잘못 입력하셨습니다.');
    }else{
      session_start();
      $_SESSION["userId"] = $pw_match["id"];
      $_SESSION["userName"] = $pw_match["name"];
      $_SESSION["userLevel"] = $pw_match["level"];
      $_SESSION["userPoint"] = $pw_match["point"];

      mysqli_close($con);
      header('Location: index.php');    
    }
  }

 ?>
