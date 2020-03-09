<?php
  session_start();
  unset($_SESSION["userId"]);
  unset($_SESSION["userName"]);
  unset($_SESSION["userLevel"]);
  unset($_SESSION["userPoint"]);

  header('Location: index.php');   
?>
