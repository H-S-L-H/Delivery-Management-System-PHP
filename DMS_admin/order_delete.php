<?php 
  $title = 'Orders'; 
  $activePage = 'order_delete.php'; 
  require __DIR__. '/fragments/header.php';
  require __DIR__. '/database/dbcon.php';

  if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM orders WHERE id='$id'";

    if ($mysqli->query($sql)) {
      echo "<script>window.location = 'orders.php';</script>";

    }
    else {
      //error
      printf("Could not insert record into table: %s<br />", $mysqli→error);
    }

    $mysqli->close();
  }
?>