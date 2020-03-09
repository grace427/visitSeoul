<?php
  session_start();
  include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";
  date_default_timezone_set('Asia/Seoul');

  $mode = $_GET["mode"];
  $userId = $_SESSION["userId"];
  $userName = $_SESSION["userName"];

  if($mode === 'modify'){
    $num = $_GET["num"];
    $page = $_GET["page"];
    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $exist_file_name = $_GET["file_name"];
    if($exist_file_name){
      $real_file_name = $exist_file_name;
    }else{
      $real_file_name = "";
    }
    $sql = "update board set subject='$subject', content='$content', file_name='$real_file_name', file_type='$real_file_type', file_copied='$copied_file_name'";
    $sql .= " where num=$num";
    mysqli_query($con, $sql);

  }else if($mode === 'reply'){
    $num = $_GET["num"];
    $page = $_GET["page"];
    $content = trim($_POST["content"]);
    $subject = trim($_POST["subject"]);
    $hit = 0;
    $q_subject = mysqli_real_escape_string($con, $subject);
    $q_content = mysqli_real_escape_string($con, $content);
    $q_userid = mysqli_real_escape_string($con, $userId);
    $q_num = mysqli_real_escape_string($con, $num);
    $regist_day=date("Y-m-d (H:i)");

    $sql="SELECT * from board where num =$q_num;";
    $result = mysqli_query($con,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($con));
    }
    $row=mysqli_fetch_array($result);

    //현재 그룹넘버값(본 게시글의 그룹 넘버)을 가져와서 저장한다.
    $group_num=(int)$row['group_num'];
    //현재 들여쓰기값을 가져와서 증가한후 저장한다.
    $depth=(int)$row['depth'] + 1;
    //현재 순서값을 가져와서 증가한후 저장한다.
    $ord=(int)$row['ord'] + 1;

    //현재 그룹넘버가 같은 모든 레코드를 찾아서 현재 $ord값보다 같거나 큰 레코드에 $ord 값을 1을 증가시켜 자기 자신에게 저장한다.
    $sql= "update board set ord = ord+1 where group_num = $group_num and ord >= $ord;";
    $result = mysqli_query($con,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($con));
    }

    $sql = "insert into board values(null, '$userId', '$userName', '$q_subject', '$q_content', '$regist_day', 0,
          '$upfile_name', '$upfile_type', '$copied_file_name', '$group_num', '$depth', '$ord');";
    mysqli_query($con, $sql);
    if (!$result) {
      die('Error: ' . mysqli_error($con));
    }

    $sql_max = "select max(num) from board;";
    $result = mysqli_query($con, $sql_max);
    if (!$result) {
      die('Error: ' . mysqli_error($con));
    }
    $row=mysqli_fetch_array($result);
    $max_num=$row['max(num)'];

  }else if($mode === 'create'){
    // 1. post로 보낸 제목과 내용 받아오고 board 테이블에 넣을 값 변수에 받기
    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);
    $regist_day = date("Y-m-d (h:i)");

    // 2. 파일
    $upload_dir = './data/';
    $upfile_name = $_FILES["upfile"]["name"]; // 사용자가 실제 올린 파일 이름
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];  // 서버가 임의로 준 임시 파일 이름
    $upfile_type = $_FILES["upfile"]["type"];
    $upfile_size = $_FILES["upfile"]["size"];
    $upfile_error = $_FILES["upfile"]["error"];

    if($upfile_name && !$upfile_error){
      $file = explode(".", $upfile_name); // 사용자가 올린 파일을 이름과 확장자로 나눈다
      $file_name = $file[0];
      $file_ext = $file[1];
      $new_file_name = date("y_m_d_h_i_s");
      $new_file_name = $new_file_name."_".$file_name;  // 현재 시간과 파일 이름을 붙여서 새로운 임시 이름을 만든다
      $copied_file_name = $new_file_name.".".$file_ext;  // 새로 만든 임시 이름에 확장자를 붙인다
      $uploaded_file = $upload_dir.$copied_file_name;  // 파일을 저장할 경로를 앞에 붙인다

      $real_file_name = $upfile_name;
      $real_file_type = $upfile_type;

      if($upfile_size > 1000000){
        alert_back('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요!');
      }
      if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){
        alert_back('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
      }
    }else{
          echo ("<script>alert('파일없음');</script>");
      $real_file_name = "";
      $real_file_type = "";
      $copied_file_name = "";
    }

    //그룹번호, 들여쓰기 기본값 (insert : 게시글 글쓰기니까 디폴트로 0을 준다)
    $group_num = 0;
    $depth=0;
    $ord=0;

    $sql = "insert into board values(null, '$userId', '$userName', '$subject', '$content', '$regist_day', 0,
          '$upfile_name', '$upfile_type', '$copied_file_name', '$group_num', '$depth', '$ord');";
    mysqli_query($con, $sql);

    $sql_max = "select max(num) from board;";
    $result = mysqli_query($con, $sql_max);
    $row=mysqli_fetch_array($result);
    $max_num=$row['max(num)'];
    $sql_update = "update board set group_num=$max_num where num=$max_num;";
    $result = mysqli_query($con, $sql_update);

    // 포인트 부여하기
    $point_up = 100;
    $sql_p = "select point from members where id='$userId'";
    $result = mysqli_query($con, $sql_p);
    $row = mysqli_fetch_array($result);
    $new_point = $row['point']+$point_up;

    $sql_update = "update members set point=$new_point where id='$userId'";
    mysqli_query($con, $sql_update);
  }
    mysqli_close($con);

  if($mode === 'modify'){
    echo "
	      <script>
	          location.href = './board_list.php?page=$page';
	      </script>
	  ";
  }else if($mode === 'reply'){
    echo "
        <script>
            location.href = './board_list.php?page=$page';
        </script>
    ";
  }else if($mode === 'create'){
    echo "
       <script>
            location.href = './board_list.php';
       </script>
  ";
  }

 ?>
