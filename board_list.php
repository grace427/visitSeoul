<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>visitSeoul</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/board.css">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
  </head>
  <body>
    <header>
      <?php include "./header.php";?>
    </header>
    <section>
      <div id="main_content">
        <div id="inner_main" style="margin: -74px 0 0 -300px">
      <h3 id="board_title">게시판 List</h3>
      <table id="board_list">
        <tr style="height: 30px;">
          <td class="col1">번호</td>
          <td class="col2">제목</td>
          <td class="col3">글쓴이</td>
          <td class="col4">첨부</td>
          <td class="col5">등록일</td>
          <td class="col6">조회</td>
        </tr>
  <?php
    include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";
    if(isset($_GET["page"])) $page = $_GET["page"];
    else $page = 1;

    // 1. 전체 게시글 갯수 구하기
    $sql = "select * from board order by group_num desc, ord asc;";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);
?>
    <!-- // 2. 한 페이지에 보여질 글의 갯수 -->
  <?php
    $scale = 10;

    // 3. 전체 페이지 갯수 구하기
    $number_of_pages = ($total_record % $scale == 0) ? ($total_record / $scale) : (ceil($total_record / $scale));

    // 4. 현재 페이지의 제일 첫 게시글 번호 구하기
    $set_page_amount = ($page - 1) * $scale;
    $record_number = $total_record - $set_page_amount;

    // 5. 현재 페이지에 게시글 목록 출력하기
    for($i=$set_page_amount ; $i<$set_page_amount+$scale && $i<$total_record ; $i++){
      mysqli_data_seek($result, $i);
      $row = mysqli_fetch_array($result);
      $num = $row["num"];
	    $id = $row["id"];
	    $name = $row["name"];
	    $subject = $row["subject"];
      $regist_day = $row["regist_day"];
      $hit = $row["hit"];
      if($row["file_name"]){
        $file_image = "<img src='./image/landscape.png' width='13px' height='13px'>";
      }else $file_image = "";
      $depth=(int)$row['depth'];//공간을 몆칸을 띄어야할지 결정하는 숫자임
      $space="";
      for($j=0;$j<$depth;$j++){
        $space="&nbsp;&nbsp;".$space;
      }
  ?>
      <tr>
        <td class="col1"><?=$record_number?></td>
        <td class="col2"><a href="./board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$space.$subject?></a></td>
        <td class="col3"><?=$name?></td>
        <td class="col4"><?=$file_image?></td>
        <td class="col5"><?=$regist_day?></td>
        <td class="col6"><?=$hit?></td>
      </tr>
  <?php
      $record_number--;
    } // end of for
      mysqli_close($con);
  ?>
      </table>
        <ul id="page_num">

     <!-- 하단 페이지 번호 인디케이터   -->
  <?php
    // 전체 페이지 갯수가 2페이지 이상일때만 ◀ 이전 나타나기
    if($page>=2 && $number_of_pages>=2){
      $new_page = $page-1;
      echo "<li><a href='./board_list.php?page=$new_page'> ◀ 이전&nbsp;</a></li>";
    }else{
      echo "<li>&nbsp;</li>";
    }

    // 페이지 번호 출력하기
    for($i=1;$i<$number_of_pages;$i++){
      if($i === $page){
        echo "<li>&nbsp;<span style='weight:bold'>$i</span>&nbsp;</li>";
      }else{
        echo "<li><a href='./board_list.php?page=$i'>&nbsp;$i&nbsp;</a></li>";
      }
    }

    // 전체 페이지 중 마지막 페이지가 아닐때만 다음 ▶ 나타내기
    if($page != $number_of_pages && $number_of_pages>=2){
        $new_page = $page+1;
        echo "<li><a href='./board_list.php?page=$new_page'> &nbsp;$i&nbsp; 다음 ▶ </a></li>";
    }else{
        echo "<li>&nbsp;</li>";
    }
   ?>
      </ul>

   <!-- 하단 버튼 -->
   <ul class="buttons">
     <li><button onclick="location.href = './board_list.php'">목록</button></li>
     <li>
  <?php
      if($userId){
  ?>
        <button onclick="location.href = './board_form.php?mode=create'">글쓰기</button>
  <?php
      }else{
  ?>
      	<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
  <?php
      }
  ?>
     </li>
   </ul>
 </div>
 </div>
    </section>
    <footer>
      <?php include "./footer.php";?>
    </footer>
  </body>
</html>
