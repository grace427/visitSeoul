<?php
  session_start();
  if(isset($_SESSION["userId"])){
    $userId = $_SESSION["userId"];
  }else{
    $userId = "";
  }
  if(isset($_SESSION["userName"])){
    $userName = $_SESSION["userName"];
  }else{
    $userName = "";
  }
  if(isset($_SESSION["userLevel"])){
    $userLevel = $_SESSION["userLevel"];
  }else{
    $userLevel = "";
  }
  if(isset($_SESSION["userPoint"])){
    $userPoint = $_SESSION["userPoint"];
  }else{
    $userPoint = "";
  }
 ?>

 <div id="top">
   <h2><a href="./index.php">Visit Seoul</a></h2>
   <ul id="top_menu">
<?php

  if(!$userId){
 ?>
    <li><a href="./login_form.php">로그인</a></li>
    <li><a href="./join_form.php">회원가입</a></li>
<?php
} else{
    $logged = $userName."님 "."[level : ".$userLevel." | point : ".$userPoint."] ";
 ?>
  <li><?= $logged ?></li>
  <li><a href="./logout.php">로그아웃</a></li>
  <li><a href="./member_modify_form.php">정보수정</a></li>

<?php
    }
?>
<?php
  if($userLevel==1){
 ?>
  <li><a href="./admin.php">관리자 모드</a></li>
<?php
}
 ?>
   </ul>
 </div>

 <div id="menu_bar">
   <ul>
     <li><a href="index.php">HOME</a></li>
     <li><a href="index.php">여행계획</a></li>
     <li><a href="index.php">추천</a></li>
     <li><a href="index.php">테마</a></li>
     <li><a href="./board_list.php">게시판</a></li>
     <li><a href="./message_form.php">쪽지보내기</a></li>
   </ul>
 </div>
