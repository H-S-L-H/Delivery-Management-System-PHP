<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" class="href">
  <!--<script src="bootstrap/js/bootstrap.bundle.js"></script>-->
  <!--<script src="bootstrap/js/bootstrap.js"></script>-->
  <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>-->
  <!--<script src="bootstrap/js/bootstrap.min.js"></script>-->
  <!--<script src="bootstrap/js/bootstrap.bundle.js"></script>-->
  <link rel="icon" href="images/logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/pickupform.css">
  <link rel="stylesheet" href="css/orderdetail.css">
  <link rel="stylesheet" href="css/contactus.css">
  <link rel="stylesheet" href="css/aboutus.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/register.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title><?php if (isset($title)) {echo $title;} else {echo "ပင်မစာမျက်နှာ";} ?></title>
</head>
<body>
  <!--Navbar Start-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary pt-0">
    <div class="container">
      <a class="navbar-brand pt-0 w-25" href="index.php"><img src="images/logo.png" class="img-fluid w-75 pt-2" alt="Logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white <?php if ($activePage == 'index.php') {echo 'active';} ?>" href="index.php">ပင်မစာမျက်နှာ</a>
          </li>
          <li class="nav-item nav-aboutus">
            <a class="nav-link text-white <?php if ($activePage == 'aboutus.php') {echo 'active';} ?>" href="aboutus.php">ကုမ္ပဏီအကြောင်း</a>
          </li>
          <li class="nav-item nav-pickup">
            <a class="nav-link text-white <?php if ($activePage == 'pickupform.php') {echo 'active';} ?>" href="pickupform.php" id="pickupform">ပစ္စည်းပို့ရန်</a>
          </li>
          <li class="nav-item nav-orderdetail">
            <a class="nav-link text-white <?php if ($activePage == 'orderdetail.php') {echo 'active';} ?>" href="orderdetail.php" id="orderdetails">အော်ဒါအသေးစိတ်</a>
          </li>
          <li class="nav-item nav-contactus">
            <a class="nav-link text-white <?php if ($activePage == 'contactus.php') {echo 'active';} ?>" href="contactus.php">ဆက်သွယ်ရန်</a>
          </li>
          <?php

            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true )
            {
            ?>
              <li class="nav-item nav-login rounded">
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php echo $_SESSION['username']  ?>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="logout.php">အကောင့်ထွက်ရန်</a></li>
                  </ul>
                </div>
              </li>
            <?php    
            }

            else{
              echo "<script>
              document.getElementById('pickupform').setAttribute('class', 'nav-link text-white disabled');
              document.getElementById('orderdetails').setAttribute('class', 'nav-link text-white disabled');
              </script>";
            ?>   
            <li class="nav-item nav-login ">
              <a class="nav-link rounded" href="login.php">အကောင့်ဝင်ရန်</a>
            </li>
            <?php
            }
            ?>
          
        </ul>
      </div>
    </div>
  </nav>
  <!--Navbar End-->