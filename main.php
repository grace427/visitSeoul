<head>
  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/main.css">
  <script src="./modernizr.custom.min.js"></script>
  <script src="./jquery-1.10.2.min.js"></script>
  <script src="./jquery-ui-1.10.3.custom.min.js"></script>
  <script src="./main.js"></script>
</head>
<body>
<div class="slideshow">
  <div class="slideshow_slides">
    <a href="#"> <img src="./image/seoul.jpg" alt="slide1"> </a>
    <a href="#"> <img src="./image/seoul1.jpg" alt="slide2"> </a>
    <a href="#"> <img src="./image/seoul2.jpg" alt="slide3"> </a>
    <a href="#"> <img src="./image/seoul3.jpg" alt="slide4"> </a>
  </div>
  <div class="slideshow_nav">
    <a href="#" class="prev">prev</a>
    <a href="#" class="next">next</a>
  </div>
  <div class="indicator">
    <a href="#">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
  </div>

</div>
<div id="main_content">
  <div id="latest">
    <h4>최근 게시글</h4>
    <ul>
<?php
  include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";
  $sql = "select * from board order by num desc limit 5";
  $result = mysqli_query($con, $sql);

  if($result){
    while($row = mysqli_fetch_array($result)){
      $regist_day = substr($row["regist_day"], 0, 10);
?>
      <li>
        <span>[<?=$regist_day?>]</span>
        <span><?=$row["subject"]?></span>
        <span><?=$row["name"]?></span>
      </li>
<?php
     }
  }else{
    echo "게시판에 글이 아직 없습니다";
  }
?>
     </ul>
   </div>
   <div id="point_rank">
      <h4>포인트 랭킹</h4>
      <ul>
<?php
  $rank = 1;
  $sql = "select * from members order by point desc limit 5";
  $result = mysqli_query($con, $sql);

  if($result){
    while($row = mysqli_fetch_array($result)){
      $name = $row["name"];
      $id = $row["id"];
      $point = $row["point"];
      $name = mb_substr($name, 0, 1)." * ".mb_substr($name, 2, 1);
?>
    <li>
      <span><?=$rank?></span>
      <span><?=$name?></span>
      <span><?=$id?></span>
      <span><?=$point?></span>
    </li>
<?php
    $rank++;
    }
  }else {
    echo "아직 가입된 회원이 없습니다.";
  }
  mysqli_close($con);
?>
      </ul>
   </div>
 </div>
</div>
</body>
