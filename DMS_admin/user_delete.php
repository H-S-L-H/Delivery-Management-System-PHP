<?php 
  $title = 'Users'; 
  $activePage = 'user_delete.php'; 
  require __DIR__. '/fragments/header.php';
  require __DIR__. '/database/dbcon.php';

  if(isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "DELETE FROM users WHERE user_id='$user_id'";

    if ($mysqli->query($sql)) {
      echo "<script>window.location = 'users.php';</script>";

    }
    else {
      //error
      printf("Could not insert record into table: %s<br />", $mysqli→error);
    }

    $mysqli->close();
  }
?>