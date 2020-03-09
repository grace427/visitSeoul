<meta charset='utf-8'>
<?php
    include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";
    date_default_timezone_set('Asia/Seoul');

    $send_id = $_GET["send_id"];
    $rv_id = $_POST['rv_id'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
  // htmlspecialchars는 d/b에 ""나 ''등을 문자로 인지하라는 뜻
	$subject = htmlspecialchars($subject, ENT_QUOTES);
	$content = htmlspecialchars($content, ENT_QUOTES);
	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	if(!$send_id) {
    alert_back('로그인 후 이용해 주세요!');
		exit;
	}

	$sql = "select * from members where id='$rv_id'";
	$result = mysqli_query($con, $sql);
	$num_record = mysqli_num_rows($result);

	if($num_record)
	{
		$sql = "insert into message (send_id, rv_id, subject, content,  regist_day) ";
		$sql .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
		mysqli_query($con, $sql);
	} else {
    alert_back('수신 아이디가 잘못 되었습니다!');
	}

	mysqli_close($con);
	echo "
	   <script>
	    location.href = 'message_box.php?mode=send';
	   </script>
	";
?>
