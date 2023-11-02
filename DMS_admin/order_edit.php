<?php 
  $title = 'Orders'; 
  $activePage = 'order_form.php'; 
  require __DIR__. '/fragments/header.php';
  require __DIR__. '/database/dbcon.php';

  $errors = [
    'sender_name'=>'', 
    'sender_phone'=>'', 
    'pickup_address'=>'', 
    'pickup_date'=>'', 
    'pickup_vehicle'=>'',
    'receiver_name'=>'',
    'receiver_phone'=>'',
    'receiver_address'=>'',
    'deliver_method'=>'',
    'payment_method'=>'',
    'parcel_price'=>''
  ]; //will arrive to this array if any errors

  if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql1 = "SELECT * FROM orders WHERE id='$id'";

    $result1 = $mysqli->query($sql1);
    $row1 = $result1->fetch_assoc();

  }

  if(isset($_POST['add'])) {

    //check sender name
    if (empty($_POST['sender_name'])) {  
      $errors['sender_name'] = "ပေးပို့သူအမည်ဖြည့်ရန်လိုအပ်ပါသည်";
    } 
    else if (!preg_match("/^[a-zA-Z ]*$/",$_POST['sender_name'])) {  
      $errors['sender_name'] = "Alphabetsနဲ့ white spaceသာဖြည့်လို့ရပါသည်"; 
    } 
    else { 
      $sender_name = trim($_POST['sender_name']);  
      $sender_name = stripslashes($sender_name);  
      $sender_name = htmlspecialchars($sender_name);
    }

    //check sender phone
    if (empty($_POST['sender_phone'])) {  
      $errors['sender_phone'] = "ပေးပို့သူဖုန်းနံပါတ်ဖြည့်ရန်လိုအပ်ပါသည်";  
    } 
    else if (!preg_match ("/^[0-9]*$/", $_POST['sender_phone']) ) {  
      $errors['sender_phone']  = "နံပါတ်များသာဖြည့်လို့ရပါသည်";  
    }
    else if (!preg_match ("/^09/", $_POST['sender_phone'])) {
      $errors['sender_phone']  = "09ဖြင့်စသောဖုန်းနံပါတ်သာဖြည့်လို့ရပါသည်";
    }
    else if (strlen ($_POST['sender_phone']) != 11) {  
      $errors['sender_phone']  = "ဖုန်းနံပါတ်သည်နံပါတ်အလုံးရေ(၁၁)လုံးဖြစ်ရပါသည်";  
    } 
    else {
      $sender_phone = trim($_POST['sender_phone']);  
      $sender_phone = stripslashes($sender_phone);  
      $sender_phone = htmlspecialchars($sender_phone);
    }

    //check pickup address
    if (empty($_POST['pickup_address'])) {  
      $errors['pickup_address']  = "အော်ဒါလာကောက်ရမည့်နေရပ်လိပ်စာဖြည့်ရန်လိုအပ်ပါသည်";
    } 
    else { 
      $pickup_address = trim($_POST['pickup_address']);  
      $pickup_address = stripslashes($pickup_address);  
      $pickup_address = htmlspecialchars($pickup_address);
    }

    //check pickup date
    if (empty($_POST['pickup_date'])) {  
      $errors['pickup_date']  = "အော်ဒါလာကောက်ရမည့်နေ့ရွေးရန်လိုအပ်ပါသည်";  
    }
    else {
      $pickup_date = $_POST['pickup_date'];
    } 

    //check pickup vehicle
    if (empty($_POST['pickup_vehicle'])) {  
      $errors['pickup_vehicle'] = "အော်ဒါလာကောက်ရမည့်ယာဉ်အမျိုးအစားရွေးရန်လိုအပ်ပါသည်";  
    }
    else {
      $pickup_vehicle = $_POST['pickup_vehicle'];
    }

    //check receiver name
    if (empty($_POST['receiver_name'])) {  
      $errors['receiver_name'] = "လက်ခံသူအမည်ဖြည့်ရန်လိုအပ်ပါသည်";
    } 
    else if (!preg_match("/^[a-zA-Z ]*$/",$_POST['receiver_name'])) {  
      $errors['receiver_name'] = "Alphabetsနဲ့ white spaceသာဖြည့်လို့ရပါသည်"; 
    } 
    else { 
      $receiver_name = trim($_POST['receiver_name']);  
      $receiver_name = stripslashes($receiver_name);  
      $receiver_name = htmlspecialchars($receiver_name);
    }

    //check receiver phone
    if (empty($_POST['receiver_phone'])) {  
      $errors['receiver_phone'] = "လက်ခံသူဖုန်းနံပါတ်ဖြည့်ရန်လိုအပ်ပါသည်";  
    } 
    else if (!preg_match ("/^[0-9]*$/", $_POST['receiver_phone'])) {  
      $errors['receiver_phone'] = "နံပါတ်များသာဖြည့်လို့ရပါသည်";  
    }
    else if (!preg_match ("/^09|01/", $_POST['receiver_phone'])) {
      $errors['receiver_phone'] = "09ဖြင့်စသောဖုန်းနံပါတ်သာဖြည့်လို့ရပါသည်";
    }
    else if (strlen ($_POST['receiver_phone']) != 11) {  
      $errors['receiver_phone'] = "ဖုန်းနံပါတ်သည်နံပါတ်အလုံးရေ(၁၁)လုံးဖြစ်ရပါမည်";  
    } 
    else {
      $receiver_phone = trim($_POST['receiver_phone']);  
      $receiver_phone = stripslashes($receiver_phone);  
      $receiver_phone = htmlspecialchars($receiver_phone);
    }

    //check receiver address
    if (empty($_POST['receiver_address'])) {  
      $errors['receiver_address'] = "လက်ခံသူနေရပ်လိပ်စာဖြည့်ရန်လိုအပ်ပါသည်";
    } 
    else { 
      $receiver_address = trim($_POST['receiver_address']);  
      $receiver_address = stripslashes($receiver_address);  
      $receiver_address = htmlspecialchars($receiver_address);
    }

    //check delivery method
    if (empty($_POST['deliver_method'])) {  
      $errors['deliver_method'] = "ပို့ဆောင်မည့်နည်းလမ်းရွေးရန်လိုအပ်ပါသည်";  
    }
    else {
      $deliver_method = $_POST['deliver_method'];
    }

    //check payment method
    if (empty($_POST['payment_method'])) {  
      $errors['payment_method'] = "ငွေချေမည့်ပုံစံရွေးရန်လိုအပ်ပါသည်";  
    }
    else {
      $payment_method = $_POST['payment_method'];
    }

    //check parcel price
    if(isset($_POST['payment_method'])) {
      if($_POST['payment_method'] == "လက်ခံသူရှင်း") {
        if (empty($_POST['parcel_price'])) {  
          $errors['parcel_price'] = "ပစ္စည်းတန်ဖိုးဖြည့်ရန်လိုအပ်ပါသည်";  
        } 
        else if (!preg_match ("/^[0-9]*$/", $_POST['parcel_price']) ) {  
          $errors['parcel_price'] = "နံပါတ်များသာဖြည့်လို့ရပါသည်";  
        }
        else {
          $parcel_price = trim($_POST['parcel_price']);  
          $parcel_price = stripslashes($parcel_price);  
          $parcel_price = htmlspecialchars($parcel_price);
        }
      }
      else {
        $parcel_price = NULL;
      }
    }

    //Note
    $sender_note = $_POST['sender_note'];

    //Estimate Arrival Date
    $estimate_arrival_date = $_POST['estimate_arrival_date'];

    //Delivery Fee
    $delivery_fee = $_POST['delivery_fee'];

    //Parcel weight
    $parcel_weight = $_POST['parcel_weight'];

    //Order Status
    $order_status = $_POST['order_status'];

    //Order Number
    $order_number = $row1['order_number'];

    //redirect to next page if no errors
    if(!array_filter($errors)) {
      //will work no errors in the form

      $sql2 = "UPDATE orders SET 
      sender_name='$sender_name', sender_phone='$sender_phone', pickup_address='$pickup_address', pickup_date='$pickup_date',
      pickup_vehicle='$pickup_vehicle', receiver_name='$receiver_name', receiver_phone='$receiver_phone', receiver_address='$receiver_address',
      estimate_arrival_date='$estimate_arrival_date', deliver_method='$deliver_method', payment_method='$payment_method', parcel_price='$parcel_price',
      delivery_fee='$delivery_fee', parcel_weight='$parcel_weight', sender_note='$sender_note', order_status='$order_status'
      WHERE order_number='$order_number'";

        //save database and check
        if ($mysqli->query($sql2)) {
          echo "<script>
          const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          
          Toast.fire({
            icon: 'success',
            title: 'Your Data is Updated!'
          }).then(function() {
            window.location = 'order_details.php?id=$id';
          });
          </script>";
        }
        else {
          //error
          printf("Could not insert record into table: %s<br />", $mysqli→error);
        }

     $mysqli->close();
    }
  }

?>

  <section class="order_form">
    <div class="container-fluid pt-4 px-4">
      <div class="text-center rounded p-4" style="background-color: #07509E">
        <div class="row">
          <div class="col-md-8 col-sm mb-4">
            <h3 class="mb-0 text-start">Edit Order</h3>
          </div>
          <div class="col-md-4 col-sm mb-4">
            <a href="orders.php" class="btn float-end w-25 back-btn" style="background-color: #FFCE00; color: #07509E;">Back</a>
          </div>
        </div>
        <form method = "POST" action = "<?php $_PHP_SELF ?>">
          <div class="row text-start">
            <div class="col-sm">
              <div class="mb-4">
                <label for="order_number" class="form-label mb-3">Order Number</label>
                <input type="text" class="form-control" disabled="true"  id="order_number" name="order_number" value="<?php if(isset($row1['order_number'])){ echo $row1['order_number']; } ?>">
              </div>
              <div class="mb-4">
                <label for="sender_name" class="form-label mb-3">Sender Name *</label>
                <input type="text" class="form-control" id="sender_name" name="sender_name" value="<?php if(isset($row1['sender_name'])){ echo $row1['sender_name']; } ?>">
                <small class="error"><?php if(isset($errors['sender_name'])){ echo $errors['sender_name']; }?> </small> 
              </div>
              <div class="mb-4">
                <label for="sender_phone" class="form-label mb-3">Sender Phone *</label>
                <input type="text" class="form-control" id="sender_phone" name="sender_phone" value="<?php if(isset($row1['sender_phone'])){ echo $row1['sender_phone']; } ?>">
                <small class="error"><?php if(isset($errors['sender_phone'])){ echo $errors['sender_phone']; }?> </small>
              </div>
              <div class="mb-4">
                <label for="pickup_address" class="form-label mb-3">Pickup Address *</label>
                <textarea class="form-control" id="pickup_address" name="pickup_address"><?php if(isset($row1['pickup_address'])){ echo $row1['pickup_address']; } ?></textarea>
                <small class="error"><?php if(isset($errors['pickup_address'])){ echo $errors['pickup_address']; }?> </small>
              </div>
              <div class="mb-4">
                <label for="pickup_date" class="form-label mb-3">Pickup Date *</label>
                <input type="date" class="form-control" id="pickup_date" name="pickup_date" value="<?php if(isset($row1['pickup_date'])){ echo $row1['pickup_date']; } ?>">
                <small class="error"><?php if(isset($errors['pickup_date'])){ echo $errors['pickup_date']; }?> </small>
              </div>
              <div class="mb-4">
                <label for="pickup_vehicle" class="form-label mb-3">Pickup Vehicle *</label>
                <select class="form-select" name="pickup_vehicle">
                <option value="" disabled selected>Choose Pickup Vehicle</option>
                  <option value="စက်ဘီး" <?php if(isset($row1['pickup_vehicle'])){ if($row1['pickup_vehicle'] == "စက်ဘီး"){ echo "selected"; }} ?>>စက်ဘီး</option>
                  <option value="ကား" <?php if(isset($row1['pickup_vehicle'])){ if($row1['pickup_vehicle'] == "ကား"){ echo "selected"; }} ?>>ကား</option>
                </select>
                <small class="error"><?php if(isset($errors['pickup_vehicle'])){ echo $errors['pickup_vehicle']; }?> </small>
              </div>
              <div class="mb-4">
                <label for="delivery_fee" class="form-label mb-3">Delivery Fee</label>
                <input type="text" class="form-control" id="delivery_fee" name="delivery_fee" value="<?php if(isset($row1['delivery_fee'])){ echo $row1['delivery_fee']; } ?>">
              </div>
              <div class="mb-4">
                <label for="estimate_arrival_date	" class="form-label mb-3">Estimate Arrival Date</label>
                <input type="date" class="form-control" id="estimate_arrival_date" name="estimate_arrival_date" value="<?php if(isset($row1['estimate_arrival_date'])){ echo $row1['estimate_arrival_date']; }  ?>">
              </div>
            </div>

            <div class="col-sm">
            <div class="mb-4">
                <label for="receiver_name" class="form-label mb-3">Receiver Name *</label>
                <input type="text" class="form-control" id="receiver_name" name="receiver_name" value="<?php if(isset($row1['receiver_name'])){ echo $row1['receiver_name']; } ?>">
                <small class="error"><?php if(isset($errors['receiver_name'])){ echo $errors['receiver_name']; }?> </small>
              </div>
              <div class="mb-4">
                <label for="receiver_phone" class="form-label mb-3">Receiver Phone *</label>
                <input type="text" class="form-control" id="receiver_phone" name="receiver_phone" value="<?php if(isset($row1['receiver_phone'])){ echo $row1['receiver_phone']; } ?>">
                <small class="error"><?php if(isset($errors['receiver_phone'])){ echo $errors['receiver_phone']; }?> </small>
              </div>
              <div class="mb-4">
                <label for="receiver_address" class="form-label mb-3">Receiver Address *</label>
                <textarea class="form-control" id="receiver_address" name="receiver_address"><?php if(isset($row1['receiver_address'])){ echo $row1['receiver_address']; } ?></textarea>
                <small class="error"><?php if(isset($errors['receiver_address'])){ echo $errors['receiver_address']; }?> </small>
              </div>
              <div class="mb-4">
                <label for="deliver_method" class="form-label mb-3">Delivery Method *</label>
                <select class="form-select" name="deliver_method">
                <option value="" disabled selected>Choose Delivery Method</option>
                  <option value="အိမ်အရောက်" <?php if(isset($row1['deliver_method'])){ if($row1['deliver_method'] == "အိမ်အရောက်"){ echo "selected"; }} ?>>အိမ်အရောက်</option>
                  <option value="အောင်မင်္ဂလာအဝေးပြေးဂိတ်" <?php if(isset($row1['deliver_method'])){ if($row1['deliver_method'] == "အောင်မင်္ဂလာအဝေးပြေးဂိတ်"){ echo "selected"; }} ?>>အောင်မင်္ဂလာအဝေးပြေးဂိတ်</option>
                  <option value="ဒဂုံဧရာအဝေးပြေးဂိတ်" <?php if(isset($row1['deliver_method'])){ if($row1['deliver_method'] == "ဒဂုံဧရာအဝေးပြေးဂိတ်"){ echo "selected"; }} ?>>ဒဂုံဧရာအဝေးပြေးဂိတ်</option>
                </select>
                <small class="error"><?php if(isset($errors['deliver_method'])){ echo $errors['deliver_method']; }?> </small>
              </div>
              <div class="row mb-4">
                <div class="col-md-7 col-sm-12">
                  <label for="payment_method" class="form-label mb-3">Payment Method *</label>
                  <select class="form-select" id="payment_method" onchange="checkOption(this)" name="payment_method">
                    <option value="" disabled selected>Choose Payment Method</option>
                    <option value="လက်ခံသူရှင်း" <?php if(isset($row1['payment_method'])){ if($row1['payment_method'] == "လက်ခံသူရှင်း"){ echo "selected"; }} ?>>လက်ခံသူရှင်း</option>
                    <option value="ပို့သူရှင်း" <?php if(isset($row1['payment_method'])){ if($row1['payment_method'] == "ပို့သူရှင်း"){ echo "selected"; }} ?>>ပို့သူရှင်း</option>
                  </select>
                  <small class="error"><?php if(isset($errors['payment_method'])){ echo $errors['payment_method']; }?> </small>
                </div>
                <div class="col-md col-sm-12 parcel-price-col">
                  <label for="parcel_price" class="form-label mb-3">Parcel Price</label>
                  <input type="text" class="form-control parcel-price" id="parcel_price" name="parcel_price" value="<?php if(isset($row1['parcel_price'])){ echo $row1['parcel_price']; } ?>">
                  <small class="error"><?php if(isset($errors['parcel_price'])){ echo $errors['parcel_price']; }?> </small>
                </div>
              </div>
              <div class="mb-4">
                <label for="sender_note" class="form-label mb-3">Sender Note</label>
                <input type="text" class="form-control" id="sender_note" name="sender_note" value="<?php if(isset($row1['sender_note'])){ echo $row1['sender_note']; } ?>">
              </div>
              <div class="mb-4">
                <label for="parcel_weight" class="form-label mb-3">Parcel Weight</label>
                <input type="text" class="form-control" id="parcel_weight" name="parcel_weight" value="<?php if(isset($row1['parcel_weight'])){ echo $row1['parcel_weight']; } ?>">
              </div>
              <div class="mb-4">
                <label for="order_status" class="form-label mb-3">Order Status</label>
                <select class="form-select" name="order_status">
                <option value="" disabled selected>Choose Order Status</option>
                  <option value="အော်ဒါတင်ထားဆဲ" <?php if(isset($row1['order_status'])){ if($row1['order_status'] == "အော်ဒါတင်ထားဆဲ"){ echo "selected"; }} ?>>အော်ဒါတင်ထားဆဲ</option>
                  <option value="ပစ္စည်းလာယူနေဆဲ" <?php if(isset($row1['order_status'])){ if($row1['order_status'] == "ပစ္စည်းလာယူနေဆဲ"){ echo "selected"; }} ?>>ပစ္စည်းလာယူနေဆဲ</option>
                  <option value="ပစ္စည်းယူဆောင်ပြီး" <?php if(isset($row1['order_status'])){ if($row1['order_status'] == "ပစ္စည်းယူဆောင်ပြီး"){ echo "selected"; }} ?>>ပစ္စည်းယူဆောင်ပြီး</option>
                  <option value="ဂိုထောင်ရောက်ရှိ" <?php if(isset($row1['order_status'])){ if($row1['order_status'] == "ဂိုထောင်ရောက်ရှိ"){ echo "selected"; }} ?>>ဂိုထောင်ရောက်ရှိ</option>
                  <option value="ပို့ဆောင်နေပါပြီ" <?php if(isset($row1['order_status'])){ if($row1['order_status'] == "ပို့ဆောင်နေပါပြီ"){ echo "selected"; }} ?>>ပို့ဆောင်နေပါပြီ</option>
                  <option value="ပို့ဆောင်ပြီးပါပြီ" <?php if(isset($row1['order_status'])){ if($row1['order_status'] == "ပို့ဆောင်ပြီးပါပြီ"){ echo "selected"; }} ?>>ပို့ဆောင်ပြီးပါပြီ</option>
                </select>
              </div>
            </div>
          </div>
          <div class="d-grid gap-2 col-md-4 col-sm-12 mx-auto mt-3 mb-4">
            <button class="btn pickup-btn" type="submit" name="add">Update</button>
          </div>
        </form>
      </div>
    </div>
    
  </section>

  <script>
    function checkOption(obj) {
      var input = document.getElementById("parcel_price");
      input.disabled = obj.value == "ပို့သူရှင်း";
    }
  </script>

<?php require __DIR__. '/fragments/footer.php'?>