<?php 
  session_start();
  $title = 'ပစ္စည်းပို့ရန်'; 
  $activePage = 'pickupform.php'; 
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

  $user_id = $_SESSION['userid'];

  if(isset($_POST['add'])) {

    //generate an order id
    $order_number = "#".random_int(10000000, 99999999);

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

    //redirect to next page if no errors
    if(!array_filter($errors)) {
      //will work no errors in the form
        $sql = "INSERT INTO orders 
        (order_number,sender_name, sender_phone, pickup_address, pickup_date, pickup_vehicle, 
        receiver_name, receiver_phone, receiver_address, deliver_method, payment_method, 
        parcel_price, sender_note, order_status, user_id) VALUES 
        ('$order_number', '$sender_name', '$sender_phone', '$pickup_address', '$pickup_date','$pickup_vehicle', 
        '$receiver_name','$receiver_phone', '$receiver_address', '$deliver_method','$payment_method', 
        '$parcel_price', '$sender_note', 'အော်ဒါတင်ထားဆဲ', '$user_id')";

        //save database and check
        if ($mysqli->query($sql)) {
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
            title: 'အောင်မြင်စွာဖောင်ဖြည့်ပြီးပါပြီ!'
          }).then(function() {
            window.location = 'orderdetail.php';
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

<section class="pickup-form mb-5">
  <div class="container">
    <h3 class="text-center text-white mt-3 mb-5">ပစ္စည်းပို့ရန်</h3>
    <form method = "POST" action = "<?php $_PHP_SELF ?>">
      <div class="row">
        <div class="col-sm">
          <div class="mb-4">
            <label for="sender_name" class="form-label mb-3">ပေးပို့သူအမည် *</label>
            <input type="text" class="form-control" id="sender_name" name="sender_name" value="<?php if(isset($sender_name)){ echo $sender_name; } ?>">
            <small class="error"><?php if(isset($errors['sender_name'])){ echo $errors['sender_name']; }?> </small> 
          </div>
          <div class="mb-4">
            <label for="sender_phone" class="form-label mb-3">ပေးပို့သူဖုန်းနံပါတ် *</label>
            <input type="text" class="form-control" id="sender_phone" name="sender_phone" value="<?php if(isset($sender_phone)){ echo $sender_phone; } ?>">
            <small class="error"><?php if(isset($errors['sender_phone'])){ echo $errors['sender_phone']; }?> </small>
          </div>
          <div class="mb-4">
            <label for="pickup_address" class="form-label mb-3">အော်ဒါလာကောက်ရမည့်နေရပ်လိပ်စာ *</label>
            <textarea class="form-control" id="pickup_address" name="pickup_address"><?php if(isset($pickup_address)){ echo $pickup_address; } ?></textarea>
            <small class="error"><?php if(isset($errors['pickup_address'])){ echo $errors['pickup_address']; }?> </small>
          </div>
          <div class="mb-4">
            <label for="pickup_date" class="form-label mb-3">အော်ဒါလာကောက်ရမည့်နေ့ *</label>
            <input type="date" class="form-control" id="pickup_date" name="pickup_date" value="<?php if(isset($pickup_date)){ echo $pickup_date; } ?>">
            <small class="error"><?php if(isset($errors['pickup_date'])){ echo $errors['pickup_date']; }?> </small>
          </div>
          <div>
            <label for="pickup_vehicle" class="form-label mb-3">အော်ဒါလာကောက်ရမည့်ယာဉ်အမျိုးအစား *</label>
            <div class="radio-tile-group">
              <div class="input-container">
                <input id="bike" class="radio-button" type="radio" value="စက်ဘီး" name="pickup_vehicle" <?php if(isset($pickup_vehicle)){ if($pickup_vehicle == "စက်ဘီး"){ echo "checked"; }} ?>>
                <div class="radio-tile">
                  <div class="icon bike-icon">
                    <i class="fa-solid fa-bicycle"></i>
                  </div>
                  <label for="bike" class="radio-tile-label">စက်ဘီး</label>
                </div>
              </div>

              <div class="input-container">
                <input id="van" class="radio-button" type="radio" value="ကား" name="pickup_vehicle" <?php if(isset($pickup_vehicle)){ if($pickup_vehicle == "ကား"){ echo "checked"; }} ?>>
                <div class="radio-tile">
                  <div class="icon van-icon">
                    <i class="fa-solid fa-truck"></i>
                  </div>
                  <label for="van" class="radio-tile-label">ကား</label>
                </div>
              </div>
            </div>
            <small class="error"><?php if(isset($errors['pickup_vehicle'])){ echo $errors['pickup_vehicle']; }?> </small>
          </div>
        </div>

        <div class="col-sm">
        <div class="mb-4">
            <label for="receiver_name" class="form-label mb-3">လက်ခံသူအမည် *</label>
            <input type="text" class="form-control" id="receiver_name" name="receiver_name" value="<?php if(isset($receiver_name)){ echo $receiver_name; } ?>">
            <small class="error"><?php if(isset($errors['receiver_name'])){ echo $errors['receiver_name']; }?> </small>
          </div>
          <div class="mb-4">
            <label for="receiver_phone" class="form-label mb-3">လက်ခံသူဖုန်းနံပါတ် *</label>
            <input type="text" class="form-control" id="receiver_phone" name="receiver_phone" value="<?php if(isset($receiver_phone)){ echo $receiver_phone; } ?>">
            <small class="error"><?php if(isset($errors['receiver_phone'])){ echo $errors['receiver_phone']; }?> </small>
          </div>
          <div class="mb-4">
            <label for="receiver_address" class="form-label mb-3">လက်ခံသူနေရပ်လိပ်စာ *</label>
            <textarea class="form-control" id="receiver_address" name="receiver_address"><?php if(isset($receiver_address)){ echo $receiver_address; } ?></textarea>
            <small class="error"><?php if(isset($errors['receiver_address'])){ echo $errors['receiver_address']; }?> </small>
          </div>
          <div class="mb-4">
            <label for="deliver-method" class="form-label mb-3">ပို့ဆောင်မည့်နည်းလမ်း *</label>
            <select class="form-select" name="deliver_method">
            <option value="" disabled selected>ပို့ဆောင်မည့်နည်းလမ်းရွေးချယ်ပါ</option>
              <option value="အိမ်အရောက်" <?php if(isset($deliver_method)){ if($deliver_method == "အိမ်အရောက်"){ echo "selected"; }} ?>>အိမ်အရောက်</option>
              <option value="အောင်မင်္ဂလာအဝေးပြေးဂိတ်" <?php if(isset($deliver_method)){ if($deliver_method == "အောင်မင်္ဂလာအဝေးပြေးဂိတ်"){ echo "selected"; }} ?>>အောင်မင်္ဂလာအဝေးပြေးဂိတ်</option>
              <option value="ဒဂုံဧရာအဝေးပြေးဂိတ်" <?php if(isset($deliver_method)){ if($deliver_method == "ဒဂုံဧရာအဝေးပြေးဂိတ်"){ echo "selected"; }} ?>>ဒဂုံဧရာအဝေးပြေးဂိတ်</option>
            </select>
            <small class="error"><?php if(isset($errors['deliver_method'])){ echo $errors['deliver_method']; }?> </small>
          </div>
          <div class="row mb-4">
            <div class="col">
              <label for="payment-method" class="form-label mb-3">ငွေချေမည့်ပုံစံ *</label>
              <select class="form-select" id="payment-method" onchange="checkOption(this)" name="payment_method">
                <option value="" disabled selected>ငွေချေမည့်ပုံစံရွေးချယ်ပါ</option>
                <option value="လက်ခံသူရှင်း" <?php if(isset($payment_method)){ if($payment_method == "လက်ခံသူရှင်း"){ echo "selected"; }} ?>>လက်ခံသူရှင်း</option>
                <option value="ပို့သူရှင်း" <?php if(isset($payment_method)){ if($payment_method == "ပို့သူရှင်း"){ echo "selected"; }} ?>>ပို့သူရှင်း</option>
              </select>
              <small class="error"><?php if(isset($errors['payment_method'])){ echo $errors['payment_method']; }?> </small>
            </div>
            <div class="col">
              <label for="parcel_price" class="form-label mb-3">ပစ္စည်းတန်ဖိုး</label>
              <input type="text" class="form-control parcel-price" id="parcel_price" name="parcel_price" value="<?php if(isset($parcel_price)){ echo $parcel_price; } ?>">
              <small class="error"><?php if(isset($errors['parcel_price'])){ echo $errors['parcel_price']; }?> </small>
            </div>
          </div>
          <div class="mb-4">
            <label for="sender_note" class="form-label mb-3">အထူးမှာကြားချက်</label>
            <input type="text" class="form-control" id="sender_note" name="sender_note" value="<?php if(isset($sender_note)){ echo $sender_note; } ?>">
          </div>
        </div>
      </div>
      <div class="d-grid gap-2 col-4 mx-auto mt-3 mb-4">
        <small class="text-white text-center mb-3">* ပြထားသောနေရာများကို မဖြစ်မနေဖြည့်ပေးပါရန်။</small>
        <button class="btn pickup-btn" type="submit" name="add">ပစ္စည်းပို့မည်</button>
      </div>
    </form>
  </div>
</section>

<script>
  function checkOption(obj) {
    var input = document.getElementById("parcel_price");
    input.disabled = obj.value == "ပို့သူရှင်း";
  }
</script>
<?php require __DIR__. '/fragments/footer.php'?>