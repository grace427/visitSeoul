<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>visitSeoul</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/board.css">
  </head>
    <script>
      function check_input(){
        if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.board_form.subject.focus();
          return;
      }
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
      }
    </script>
  <body>
  <header>
    <?php include "./header.php";?>
  </header>
  <section>
    <div id="main_content">
      <div id="inner_main" style="margin: -74px 0 0 -320px">
        <?php
          include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";

          if(isset($_GET["mode"])){
            $mode = $_GET["mode"];
          }

          if($mode === 'modify' || $mode === 'reply'){
            $num  = $_GET["num"];
          	$page = $_GET["page"];

          	$sql = "select * from board where num=$num";
          	$result = mysqli_query($con, $sql);
          	$row = mysqli_fetch_array($result);
          	$name = $row["name"];
            $subject= htmlspecialchars($row['subject']);
            $content= htmlspecialchars($row['content']);
            $subject=str_replace("\n", "<br>",$subject);
            $subject=str_replace(" ", "&nbsp;",$subject);
            $content=str_replace("\n", "<br>",$content);
            $content=str_replace(" ", "&nbsp;",$content);
          	$exist_file_name = $row["file_name"];
            $exist_file_type = $row["file_type"];
          }

          if($mode === "reply"){
            $subject="[re]".$subject;
            $content="re : ".$content;
            $content=str_replace("<br>", "▶",$content);
            echo "<h3 id='board_title'>댓글 쓰기</h3>
                    <form name='board_form' action='./board_insert.php?num=$num&page=$page&mode=reply' method='post' enctype='multipart/form-data'>
                  ";
            }else if($mode === "modify"){
              echo "<h3 id='board_title'>게시판 수정</h3>
                      <form name='board_form' action='./board_insert.php?num=$num&page=$page&file_name=$exist_file_name&mode=modify' method='post' enctype='multipart/form-data'>
                    ";
            }else if($mode === 'create'){
            echo "<h3 id='board_title'>게시판 글쓰기</h3>
                  <form name='board_form' action='./board_insert.php?mode=create' method='post' enctype='multipart/form-data'>
            ";
          }
       ?>

      <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$userName?></span>
				</li>
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2">
              <?php
                if($mode === 'modify'){
                  echo "<input name='subject' type='text' value='$subject'>";
                }else if($mode === 'reply'){
                  echo "<input name='subject' type='text' value='$subject' readonly>";
                }else if($mode === 'create'){
                  echo "<input name='subject' type='text'>";
                }
               ?>
              </span>
	    		</li>
	    		<li id="text_area">
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
              <?php
                if($mode === 'modify' || $mode === 'reply'){
                  echo "<textarea name='content'>$content</textarea>";
                }else if($mode === 'create'){
                  echo "<textarea name='content'></textarea>";
                }
               ?>
	    			</span>
	    		</li>
	    		<li>
                <?php
                  if($mode === 'modify' || $mode === 'create'){
                ?>
                <span class="col1"> 첨부 파일</span>
                <span class="col2">
                <?php
                  if($mode === 'modify'){
                    echo "$exist_file_name <input type='file' name='upfile'>";
                  }else if($mode === 'create'){
                    echo "<input type='file' name='upfile'>";
                  }
                }
                 ?>
                 </sapn>
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">완료</button></li>
				<li><button type="button" onclick="location.href='./board_list.php'">목록</button></li>
			</ul>
      </form>
      </div>
    </div>
  </section>
  <footer>
    <?php include "./footer.php";?>
  </footer>
  </body>
</html>
