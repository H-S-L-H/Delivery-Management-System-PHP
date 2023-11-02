<?php 

  $title = 'ဆက်သွယ်ရန်'; 
  $activePage = 'contactus.php'; 
  require __DIR__. '/fragments/header.php';
  require __DIR__. '/database/dbcon.php';

  $errors = [
    'contact_name'=>'', 
    'contact_phone'=>'', 
    'contact_description'=>''
  ]; //will arrive to this array if any errors

  if(isset($_POST['add'])) {

    //check contact name
    if (empty($_POST['contact_name'])) {  
      $errors['contact_name'] = "ပေးပို့သူအမည်ဖြည့်ရန်လိုအပ်ပါသည်";
    } 
    else if (!preg_match("/^[a-zA-Z ]*$/",$_POST['contact_name'])) {  
      $errors['contact_name'] = "Alphabetsနဲ့ white spaceသာဖြည့်လို့ရပါသည်"; 
    } 
    else { 
      $contact_name = trim($_POST['contact_name']);  
      $contact_name = stripslashes($contact_name);  
      $contact_name = htmlspecialchars($contact_name);
    }

    //check sender phone
    if (empty($_POST['contact_phone'])) {  
      $errors['contact_phone'] = "ပေးပို့သူဖုန်းနံပါတ်ဖြည့်ရန်လိုအပ်ပါသည်";  
    } 
    else if (!preg_match ("/^[0-9]*$/", $_POST['contact_phone']) ) {  
      $errors['contact_phone']  = "နံပါတ်များသာဖြည့်လို့ရပါသည်";  
    }
    else if (!preg_match ("/^09/", $_POST['contact_phone'])) {
      $errors['contact_phone']  = "09ဖြင့်စသောဖုန်းနံပါတ်သာဖြည့်လို့ရပါသည်";
    }
    else if (strlen ($_POST['contact_phone']) != 11) {  
      $errors['contact_phone']  = "ဖုန်းနံပါတ်သည်နံပါတ်အလုံးရေ(၁၁)လုံးဖြစ်ရပါသည်";  
    } 
    else {
      $contact_phone = trim($_POST['contact_phone']);  
      $contact_phone = stripslashes($contact_phone);  
      $contact_phone = htmlspecialchars($contact_phone);
    }

    //check pickup address
    if (empty($_POST['contact_description'])) {  
      $errors['contact_description']  = "ပေးပို့ချင်သည့်အကြောင်းအရာဖြည့်ရန်လိုအပ်ပါသည်";
    } 
    else { 
      $contact_description = trim($_POST['contact_description']);  
      $contact_description = stripslashes($contact_description);  
      $contact_description = htmlspecialchars($contact_description);
    }

    //successful message if no errors
    if(!array_filter($errors)) {
      //will work no errors in the form
        $sql = "INSERT INTO contactus 
        (contact_name, contact_phone, contact_description) VALUES 
        ('$contact_name', '$contact_phone', '$contact_description')";

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
            window.location = 'contactus.php';
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

<section class="contact-us mb-5">
  <div class="container">
    <h3 class="text-center text-white mt-3 mb-5">ဆက်သွယ်ရန်</h3>
    <div class="row first-row mb-5">
      <div class="col-sm pt-5 ps-5">
        <h3 class="title mb-3">Fast Box Delivery Service</h3>
        <p class="text mb-4">
            Fast Box Delivery Serviceသည် 2023ခုနှစ်မှစတင်၍ မြန်မာနိုင်ငံ၏ထိပ်တန်းDelivery Service Companyအဖြစ်ရပ်တည်လာခဲ့သည်။.
        </p>
        <div class="ps-5 mb-4">
          <p>အမှတ်(၁၀)၊ မြေညီထပ်၊ လှိုင်မြို့နယ်၊ ရန်ကုန်</p>
          <p>info@fastboxdelivery.service.com</p>
          <p>09979668782</p>
        </div>
        <div class="social-media mb-5">
          <p>Social Media :</p>
          <div class="social-icons">
            <a href="#">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>
        </div>
      </div>
      <div class="col-sm pt-5 ps-5">
        <form method = "POST" action = "<?php $_PHP_SELF ?>">
          <div class="mb-4 pe-5">
            <label for="contact_name" class="form-label mb-2">အမည်</label>
            <input type="text" class="form-control" id="contact_name" name="contact_name" value="<?php if(isset($contact_name)){ echo $contact_name; } ?>">
            <small class="error"><?php if(isset($errors['contact_name'])){ echo $errors['contact_name']; }?> </small>
          </div>
          <div class="mb-4 pe-5">
            <label for="contact_phone" class="form-label mb-2">ဖုန်းနံပါတ်</label>
            <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="<?php if(isset($contact_phone)){ echo $contact_phone; } ?>">
            <small class="error"><?php if(isset($errors['contact_phone'])){ echo $errors['contact_phone']; }?> </small>
          </div>
          <div class="mb-4 pe-5">
            <label for="contact_description" class="form-label mb-2">အကြောင်းအရာ</label>
            <textarea class="form-control" name="contact_description" id="contact_description"><?php if(isset($contact_description)){ echo $contact_description; } ?></textarea>
            <small class="error"><?php if(isset($errors['contact_description'])){ echo $errors['contact_description']; }?> </small>
          </div>
          <div class="float-end mb-4 pe-5">
            <button class="btn contact-btn" type="submit" name="add">ပေးပို့မည်</button>
          </div>
        </form>
      </div>
    </div>

    <div class="row second-row gap-3 mb-3">
      <div class="col-sm">
        <p class="pt-3 ps-3 fw-bold">ရန်ကုန်ရုံးချုပ်</p>
        <p class="ps-3"><i class="fa-solid fa-location-dot"></i> အမှတ်(၁၀)၊ မြေညီထပ်၊ လှိုင်မြို့နယ်၊ ရန်ကုန်</p>
        <p class="ps-3"><i class="fa-solid fa-phone"></i> 09979668782</p>
      </div>
      <div class="col-sm">
        <p class="pt-3 ps-3 fw-bold">မန္တလေးရုံးချုပ်</p>
        <p class="ps-3"><i class="fa-solid fa-location-dot"></i> အမှတ်(၈၀)၊ မန္တလေးမြို့</p>
        <p class="ps-3"><i class="fa-solid fa-phone"></i> 09979668782</p>
      </div>
      <div class="col-sm">
        <p class="pt-3 ps-3 fw-bold">နေပြည်တော်ရုံးချုပ်</p>
        <p class="ps-3"><i class="fa-solid fa-location-dot"></i> အမှတ်(၁၂၀)၊ နေပြည်တော်မြို့</p>
        <p class="ps-3"><i class="fa-solid fa-phone"></i> 09979668782</p>
      </div>
      <div class="col-sm">
        <p class="pt-3 ps-3 fw-bold">ပဲခူးရုံးချုပ်</p>
        <p class="ps-3"><i class="fa-solid fa-location-dot"></i> အမှတ်(၇၀)၊ ပဲခူးမြို့</p>
        <p class="ps-3"><i class="fa-solid fa-phone"></i> 09979668782</p>
      </div>
    </div>

    <div class="row third-row gap-3">
      <div class="col-sm">
        <p class="pt-3 ps-3 fw-bold">မကွေးရုံးချုပ်</p>
        <p class="ps-3"><i class="fa-solid fa-location-dot"></i> အမှတ်(၄၃)၊ ပွင့်ဖြူမြို့နယ်၊ မကွေး</p>
        <p class="ps-3"><i class="fa-solid fa-phone"></i> 09979668782</p>
      </div>
      <div class="col-sm">
        <p class="pt-3 ps-3 fw-bold">စစ်ကိုင်းရုံးချုပ်</p>
        <p class="ps-3"><i class="fa-solid fa-location-dot"></i> အမှတ်(၁၀)၊ မုံရွာမြို့</p>
        <p class="ps-3"><i class="fa-solid fa-phone"></i> 09979668782</p>
      </div>
      <div class="col-sm">
        <p class="pt-3 ps-3 fw-bold">ဧရာဝတီရုံးချုပ်</p>
        <p class="ps-3"><i class="fa-solid fa-location-dot"></i> အမှတ်(၁၄၀)၊ ပုသိမ်မြို့</p>
        <p class="ps-3"><i class="fa-solid fa-phone"></i> 09979668782</p>
      </div>
      <div class="col-sm">
        <p class="pt-3 ps-3 fw-bold">တနသ်ာရီရုံးချုပ်</p>
        <p class="ps-3"><i class="fa-solid fa-location-dot"></i> အမှတ်(၂၀၈)၊ မြိတ်မြို့</p>
        <p class="ps-3"><i class="fa-solid fa-phone"></i> 09979668782</p>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__. '/fragments/footer.php'?>