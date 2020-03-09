<?php
    include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";

    $id = $_POST["id"];
    $pw = $_POST["pw1"];
    $name = $_POST["name"];
    $nickname = $_POST["nickname"];
    $email = $_POST["email"];
    $joinRoute = $_POST["joinRoute"];
    $tel = $_POST["tel"];
    $mobile = $_POST["mobile"];
    $date = $_POST["date"];
    $zipcode = $_POST["zipcode"];
    $addr1 = $_POST["addr1"];
    $addr2 = $_POST["addr2"];
    $addr3 = $_POST["addr3"];

    date_default_timezone_set('Asia/Seoul');
    $regist_day = date("Y-m-d (H:i)");

    echo "
	      <script>
	           console.log('조인루트', '$joinRoute');
	      </script>
	  ";


    $sql = "insert into members(num, id, pw, name, nickname, email, joinRoute, tel, mobile, date, zipcode, addr1, addr2, addr3, regist_day, level, point) "
           ."values(null, '$id', '$pw', '$name', '$nickname', '$email', '$joinRoute', '$tel', '$mobile', '$date', '$zipcode', '$addr1', '$addr2', '$addr3', '$regist_day', 9, 0)";

	mysqli_query($con, $sql);
  mysqli_close($con);

    echo "
	      <script>
            alert('가입이 완료되었습니다! 다시 로그인 해주세요');
            location.href = './login_form.php';
	      </script>
	  ";
?>
