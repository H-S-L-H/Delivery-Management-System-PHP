<?php 
    $title = 'Dashboard';
    $activePage = 'index.php'; 
    require __DIR__. '/fragments/header.php';
    require __DIR__. '/database/dbcon.php';

    $order_sql = "SELECT * FROM orders";
    $order_result = $mysqli->query($order_sql);
    $order_rowcount = mysqli_num_rows($order_result);

    $customer_sql = "SELECT * FROM users WHERE roles=0";
    $customer_result = $mysqli->query($customer_sql);
    $customer_rowcount = mysqli_num_rows($customer_result);
    ?>
    
    <!-- Sale & Revenue Start -->
  <div class="container-fluid pt-5 px-4">
      <div class="row g-3">
          <div class="col-sm-6 col-xl-4">
              <div class="rounded d-flex align-items-center justify-content-between p-5" style="background-color: #07509E">
                <i class="fa-solid fa-truck" style="color: #FFCE00;font-size:40px"></i>
                  <div class="ms-3">
                      <p class="mb-2 text-white">Total Orders</p>
                      <h6 class="mb-0"><?php echo $order_rowcount ?></h6>
                  </div>
              </div>
          </div>
          <div class="col-sm-6 col-xl-4">
              <div class="rounded d-flex align-items-center justify-content-between p-5" style="background-color: #07509E">
                <i class="fa-solid fa-users" style="color: #FFCE00;font-size:40px"></i>
                  <div class="ms-3">
                      <p class="mb-2 text-white">Total Customers</p>
                      <h6 class="mb-0"><?php echo $customer_rowcount ?></h6>
                  </div>
              </div>
          </div>
          <div class="col-sm-6 col-xl-4">
              <div class="rounded d-flex align-items-center justify-content-between p-5" style="background-color: #07509E">
                <i class="fa-solid fa-globe" style="color: #FFCE00;font-size:40px"></i>
                  <div class="ms-3">
                      <p class="mb-2 text-white">Total Branches</p>
                      <h6 class="mb-0">8</h6>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Sale & Revenue End -->


  <!-- Orders Chart Start -->
  <!-- <div class="container-fluid pt-4 px-4">
     <div class="row g-4">
          <div class="col-sm-12 col-xl-12">
              <div class="text-center rounded p-5" >
                  <div class="d-flex align-items-center justify-content-between mb-4">
                     
                   </div>
                  <div id="container">
                 
                </div>
              </div>
          </div>
      </div>
  </div> -->
  <!-- Sales Chart End -->
 



  <?php require __DIR__. '/fragments/footer.php'?>