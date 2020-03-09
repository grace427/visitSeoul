<?php
    include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";

    $num = $_GET["num"];
    $page = $_GET["page"];
    $mode = "delete";

    function board_delete($num, $page){
      $sql = "select * from board where num = $num";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($result);

      $copied_name = $row["file_copied"];

      if ($copied_name){
        $file_path = "./data/".$copied_name;
        unlink($file_path);
      }
    }

    switch($mode){
      case 'delete':
      board_delete($num, $page);
      echo "
         <script>
             location.href = 'board_list.php?page=$page';
         </script>
       ";
      break;
    }

    $sql = "delete from board where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);
?>
