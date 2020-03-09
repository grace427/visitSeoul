<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body style="text-align:center">
    <h1>입력하신 회원가입 정보를 확인하세요</h1>
    <h4>아이디</h4>
    <?php
      $id = $_POST["id"];
      echo $id." <br>";
     ?>
    <h4>비밀번호</h4>
    <?php
      $pw1 = $_POST["pw1"];
      echo $pw1." <br>";
     ?>
    <h4>비밀번호 확인</h4>
    <?php
      $pw2 = $_POST["pw2"];
      echo $pw2." <br>";
     ?>
    <h4>이름</h4>
    <?php
      $name = $_POST["name"];
      echo $name." <br>";
     ?>
    <h4>닉네임</h4>
    <?php
      $nickname = $_POST["nickname"];
      echo $nickname." <br>";
     ?>
    <h4>E-mail</h4>
    <?php
      $email = $_POST["email"];
      echo $email." <br>";
     ?>
    <h4>가입경로</h4>
    <?php
      $joinRoute = $_POST["joinRoute"];
      echo $joinRoute." <br>";
     ?>
    <h4>전화번호</h4>
    <?php
      $tel = $_POST["tel"];
      echo $tel." <br>";
     ?>
    <h4>휴대폰 번호</h4>
    <?php
      $mobile = $_POST["mobile"];
      echo $mobile." <br>";
     ?>
    <h4>생년월일</h4>
    <?php
      $date = $_POST["date"];
      echo $date." <br>";
     ?>
    <h4>주소</h4>
    <?php
      $zipcode = $_POST["zipcode"];
      $addr1 = $_POST["addr1"];
      $addr2 = $_POST["addr2"];
      $addr3 = $_POST["addr3"];
      echo $zipcode." <br>";
      echo $addr1." <br>";
      echo $addr2." <br>";
      echo $addr3." <br>";
     ?>
    <h4>기타 개인설정</h4>
      <?php
        $checkInfo = count($_POST["checkInfo"]);
        for($i=0;$i<$checkInfo;$i++){
          echo $_POST["checkInfo"][$i];
          if($i != $checkInfo-1) echo ", ";
        }
       ?>
  </body>
</html>
