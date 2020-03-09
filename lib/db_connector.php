<?php
date_default_timezone_set("Asia/Seoul");

$servername = "localhost";
$username = "root";
$password = "123456";
$database = "visitseoul";
$dbflag = "NO";

$con = mysqli_connect($servername, $username, $password);
if (!$con){ die("Connection failed: " . mysqli_connect_error());}

$sql = "show databases";
$result=mysqli_query($con,$sql) or die('Error: '.mysqli_error($con));

while ($row=mysqli_fetch_row($result)) {
  if($row[0] ==='visitseoul'){
    $dbflag="OK";
    break;
  }
}

if($dbflag==="NO"){
  $sql = "create database visitseoul";
  if(mysqli_query($con,$sql)){
    echo "<script>alert('visitseoul 디비 생성되었습니다.');</script> ";
  }else{
    echo "실패원인".mysqli_error($con);
  }
}

//2. 데이타 베이스 선택 use visitseoul
$dbconn = mysqli_select_db($con,"visitseoul") or die('Error: '.mysqli_error($con));

// 디비에 넣을때부터 escaping하면 출력해줄때 맘 편하게 할 수 있다
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function alert_back($data) {
  echo "<script>alert('$data');history.go(-1);</script>";
  exit;
}
?>
