<?php 
  $title = 'Orders'; 
  $activePage = 'order_details.php'; 
  require __DIR__. '/fragments/header.php';
  require __DIR__. '/database/dbcon.php';

  if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM orders WHERE id='$id'";
    $result = $mysqli->query($sql);

    $row = $result->fetch_assoc();

  }
  
?>

<section class="order_detail">
  <div class="container-fluid pt-4 px-4">
    <div class="text-center rounded p-4" style="background-color: #07509E">
      <div class="row">
        <div class="col-md-8 col-sm mb-4">
          <h3 class="mb-0 text-start">Order Details</h3>
        </div>
        <div class="col-md-4 col-sm mb-4">
          <a href="orders.php" class="btn float-end w-25 back-btn" style="background-color: #FFCE00; color: #07509E;">Back</a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered text-white align-middle mb-3">
          <tbody class="text-start">
            <tr style="border: 1px solid white">
              <th class="text-center" colspan="2">Order Number : <?php echo $row['order_number'] ?></th>
            </tr>
            <tr style="border: 1px solid white">
              <th>Sender Name</th>
              <td><?php echo $row['sender_name'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Sender Phone</th>
              <td><?php echo $row['sender_phone'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Pickup Address</th>
              <td><?php echo $row['pickup_address'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Pickup Date</th>
              <td><?php echo $row['pickup_date'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Pickup Vehicle</th>
              <td><?php echo $row['pickup_vehicle'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Receiver Name</th>
              <td><?php echo $row['receiver_name'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Receiver Phone</th>
              <td><?php echo $row['receiver_phone'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Receiver Address</th>
              <td><?php echo $row['receiver_address'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Estimate Arrival Date</th>
              <td>
                <?php 
                  if( $row['estimate_arrival_date'] == NULL) { 
                    echo "<span class='text-muted'>Not Confirm!</span>"; 
                  }
                  else{ 
                    echo $row['estimate_arrival_date']; 
                  }; 
                ?>
              </td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Delivery Method</th>
              <td><?php echo $row['deliver_method'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Payment Method</th>
              <td><?php echo $row['payment_method'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Parcel Price</th>
              <td>
                <?php 
                  if( $row['parcel_price'] == 0) { 
                    echo "<span class='ps-2'>-</span>"; 
                  }
                  else{ 
                    echo $row['parcel_price']; 
                  }; 
                ?>
              </td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Delivery Fee</th>
              <td>
                <?php 
                  if( $row['delivery_fee'] == 0) { 
                    echo "<span class='text-muted'>Not Confirm!</span>"; 
                  }
                  else{ 
                    echo $row['delivery_fee']; 
                  }; 
                ?>
              </td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Parcel Weight</th>
              <td>
                <?php 
                  if( $row['parcel_weight'] == 0) { 
                    echo "<span class='text-muted'>Not Confirm!</span>"; 
                  }
                  else{ 
                    echo $row['parcel_weight']; 
                  }; 
                ?>
              </td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Sender Note</th>
              <td>
                <?php 
                  if( $row['sender_note'] == NULL) { 
                    echo "<span class='ps-2'>-</span>"; 
                  }
                  else{ 
                    echo $row['sender_note']; 
                  }; 
                ?>
              </td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Order Status</th>
              <td><?php echo $row['order_status'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__. '/fragments/footer.php'?>