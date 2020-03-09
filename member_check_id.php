<?php
  include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";

  $id = $_GET["id"];  
  $sql = "select * from members where id = '$id'";

  $result = mysqli_query($con, $sql);
  $result_record = mysqli_num_rows($result);

  if($result_record){
    echo "1";
  }else{
    echo "0";
  }

  mysqli_close($con);
?>
