<?php
    include $_SERVER['DOCUMENT_ROOT']."/login_join/lib/db_connector.php";

    $id = $_GET["id"];
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

    $sql = "update members set pw='$pw', name='$name', nickname='$nickname', email='$email',
            joinRoute='$joinRoute', tel='$tel', mobile='$mobile', date='$date', zipcode='$zipcode',
            addr1='$addr1', addr2='$addr2', addr3='$addr3'";
    $sql .= " where id=$id";
    mysqli_query($con, $sql);

    mysqli_close($con);

    header('Location: index.php');      
 ?>
