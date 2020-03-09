<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>visitSeoul</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/board.css">
  </head>
  <body>
  <header>
    <?php include "./header.php";?>
  </header>
  <section>
    <div id="main_content">
      <div id="inner_main" style="margin: -74px 0 0 -320px">
        <?php
          include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";
        	$num = $_GET["num"];
        	$page = $_GET["page"];

        	$sql = "select * from board where num=$num";
        	$result = mysqli_query($con, $sql);
          // mysqli 디버깅
          // var_dump($result);
          // mysql_error();


        	$row = mysqli_fetch_array($result);
        	$id = $row["id"];
        	$name = $row["name"];
        	$regist_day = $row["regist_day"];
        	$subject = htmlspecialchars($row["subject"]);
        	$content = htmlspecialchars($row["content"]);
        	$file_name = $row["file_name"];
        	$file_type = $row["file_type"];
        	$file_copied = $row["file_copied"];
        	$hit = $row["hit"];

        	$content = str_replace(" ", "&nbsp;", $content);
        	$content = str_replace("\n", "<br>", $content);

        	$new_hit = $hit + 1;
        	$sql = "update board set hit=$new_hit where num=$num";
        	mysqli_query($con, $sql);
        ?>
        	    <ul id="view_content">
        			<li>
        				<span class="col1"><b>제목 :</b> <?=$subject?></span>
        				<span class="col2"><?=$name?> | <?=$regist_day?></span>
        			</li>
        			<li>
        				<?php
        					if($file_name) {
        						$real_name = $file_copied;
        						$file_path = "./data/".$real_name;
        						$file_size = filesize($file_path);

        						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
        			       		<a href='./board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
        			           	}
        				?>
        				<?=$content?>
        			</li>
        	    </ul>
        	    <ul class="buttons">
        				<li><button onclick="location.href='./board_list.php?page=<?=$page?>'">목록</button></li>
            <?php
                if($userId == $id){
            ?>
                  <li><button onclick="location.href='./board_form.php?num=<?=$num?>&page=<?=$page?>&mode=modify'">수정</button></li>
                  <li><button onclick="location.href='./board_delete.php?num=<?=$num?>&page=<?=$page?>&mode=delete'">삭제</button></li>
            <?php
                }else{
            ?>
                  </li><a href="javascript:alert('수정 권한이 없습니다.(글쓴이만 수정 가능)')"><button>수정</button></a></li>
                  </li><a href="javascript:alert('삭제 권한이 없습니다.(글쓴이만 삭제 가능)')"><button>삭제</button></a></li>
            <?php
                }
                if($userId){
            ?>
                  <li><button onclick="location.href = './board_form.php?num=<?=$num?>&page=<?=$page?>&mode=reply'">댓글 쓰기</button></li>
                  <li><button onclick="location.href = './board_form.php?mode=create'">글쓰기</button></li>
            <?php
                }else{
            ?>
                  </li><a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a></li>
            <?php
                }
            ?>
        		</ul>
  </div>
  </div>
  </section>
  <footer>
    <?php include "./footer.php";?>
  </footer>
  </body>
</html>
