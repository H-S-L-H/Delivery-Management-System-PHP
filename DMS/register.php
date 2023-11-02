<?php 
  $title = 'စာရင်းသွင်းရန်'; 
  $activePage = 'register.php'; 
  require __DIR__. '/fragments/header.php';
  require __DIR__. '/database/dbcon.php';

  $errors = [
    'user_name'=>'', 
    'user_phone'=>'', 
    'user_email'=>'', 
    'password'=>'', 
    'retype_password'=>''
  ];

  if(isset($_POST['add'])) {

    //check user name
    if (empty($_POST['user_name'])) {  
      $errors['user_name'] = "အမည်ဖြည့်ရန်လိုအပ်ပါသည်";
    } 
    else if (!preg_match("/^[a-zA-Z ]*$/",$_POST['user_name'])) {  
      $errors['user_name'] = "Alphabetsနဲ့ white spaceသာဖြည့်လို့ရပါသည်"; 
    } 
    else { 
      $user_name = trim($_POST['user_name']);  
      $user_name = stripslashes($user_name);  
      $user_name = htmlspecialchars($user_name);
    }

    //check user phone
    if (empty($_POST['user_phone'])) {  
      $errors['user_phone'] = "ဖုန်းနံပါတ်ဖြည့်ရန်လိုအပ်ပါသည်";  
    } 
    else if (!preg_match ("/^[0-9]*$/", $_POST['user_phone']) ) {  
      $errors['user_phone']  = "နံပါတ်များသာဖြည့်လို့ရပါသည်";  
    }
    else if (!preg_match ("/^09/", $_POST['user_phone'])) {
      $errors['user_phone']  = "09ဖြင့်စသောဖုန်းနံပါတ်သာဖြည့်လို့ရပါသည်";
    }
    else if (strlen ($_POST['user_phone']) != 11) {  
      $errors['user_phone']  = "ဖုန်းနံပါတ်သည်နံပါတ်အလုံးရေ(၁၁)လုံးဖြစ်ရပါသည်";  
    } 
    else {
      $user_phone = trim($_POST['user_phone']);  
      $user_phone = stripslashes($user_phone);  
      $user_phone = htmlspecialchars($user_phone);
    }

    // check user email

    if (empty($_POST['user_email'])) {  
      $errors['user_email'] = "အီးမေးလ်ဖြည့်ရန်လိုအပ်ပါသည်";
    } 
    else if (!filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL)) {  
       $errors['user_email'] = "အီးမေးလ်ပုံစံအမှန်ဖြည့်ရန်လိုအပ်ပါသည်"; 
    } 
    else { 
      $user_email = trim($_POST['user_email']);  
      $user_email = stripslashes($user_email);  
      $user_email = htmlspecialchars($user_email);
    }

    // check password

    // $hashed_password = password_hash($_POST['password'] , PASSWORD_DEFAULT);
    // $hash_password = md5($password);

    if (empty($_POST['password'])) {  
      $errors['password'] = "လျှို့ဝှက်နံပါတ်ဖြည့်ရန်လိုအပ်ပါသည်";
    } 
    else if (strlen($_POST['password']) != 8) {
      $errors['password'] = 'လျှို့ဝှက်နံပါတ်၈လုံးဖြည့်ရန်လိုအပ်ပါသည်';
    }
    else { 
      $password = trim($_POST['password']);  
      $password = htmlspecialchars($password);
     }

    // check retype password

      if (empty($_POST['retype_password'])) {  
        $errors['retype_password'] = "လျှို့ဝှက်နံပါတ်ဖြည့်ရန်လိုအပ်ပါသည်";
      } 

      else if ($_POST['password'] !== $_POST['retype_password']){
        $errors['retype_password'] = 'လျှို့ဝှက်နံပါတ်မတူပါ';
      }
      else{
        $retype_password = trim($_POST['retype_password']);  
        $retype_password = htmlspecialchars($retype_password);
        $hash_password = password_hash($_POST['password'] ,  PASSWORD_BCRYPT);
      }

    if(!array_filter($errors)) {
      //will work no errors in the form
        $sql = "INSERT INTO users
        (user_name,user_phone,user_email,user_password) VALUES
        ('$user_name','$user_phone','$user_email','$hash_password')";

        //save database and check
        if ($mysqli->query($sql)) {
           echo "<script>
          window.location = 'login.php';
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

<section class="register">
  <div class="container">
    <div class="register-form mt-4 mb-5 py-5">
      <div class="text-center">
        <img src="images/register_delivery_man.png" alt="register_delivery_man" class="img-fluid w-25">
      </div>
      <div class="text-center">
        <h4 class="pt-5 mb-5">စာရင်းသွင်းရန်</h4>
      </div>
      <div class="row">
        <div class="mx-auto col-10 col-md-6 col-lg-5">
          <form action="<?php $_PHP_SELF ?>" method="POST">
            <!-- Username input -->
            <div class="input-with-icon mb-4">
              <input type="text" class="form-control" id="user_name" name="user_name" placeholder="အမည်" value="<?php if(isset($user_name)){ echo $user_name; } ?>" >
              <i class="fa-solid fa-user"></i>
              <small class="error"><?php if(isset($errors['user_name'])){ echo $errors['user_name']; }?> </small> 
            </div>
            <!-- Phonenumber input -->
            <div class="input-with-icon mb-4">
              <input type="text" class="form-control" id="user_phone" name="user_phone" placeholder="ဖုန်းနံပါတ်" value="<?php if(isset($user_phone)){ echo $user_phone; } ?>">
              <i class="fa-solid fa-phone"></i>
              <small class="error"><?php if(isset($errors['user_phone'])){ echo $errors['user_phone']; }?> </small> 
            </div>
            <!-- Email input -->
            <div class="input-with-icon mb-4">
              <input type="text" class="form-control" id="user_email" name="user_email" placeholder="အီးမေးလ်လိပ်စာ" value="<?php if(isset($user_email)){ echo $user_email; } ?>">
              <i class="fa-solid fa-envelope"></i>
              <small class="error"><?php if(isset($errors['user_email'])){ echo $errors['user_email']; }?> </small> 
            </div>
            <!-- Password input -->
            <div class="input-with-icon mb-4">
              <input type="password" class="form-control" id="password" name="password" placeholder="လျှို့ဝှက်နံပါတ်" value="<?php if(isset($password)){ echo $password; } ?>">
              <small class="error"><?php if(isset($errors['password'])){ echo $errors['password']; }?> </small> 
              <i class="fa-solid fa-lock"></i>
            </div>
            <!-- Repeat Password input -->
            <div class="input-with-icon mb-4">
              <input type="password" class="form-control" id="retype_password" name="retype_password" placeholder="လျှို့ဝှက်နံပါတ်ပြန်ရိုက်ထည့်ပေးပါ" value="<?php if(isset($retype_password)){ echo $retype_password; } ?>">
              <small class="error"><?php if(isset($errors['retype_password'])){ echo $errors['retype_password']; }?> </small> 
              <i class="fa-solid fa-lock"></i>
            </div>
            <div class=" text-lg-start mt-4 d-grid gap-2 col-6 mx-auto">
              <button type="submit" class="btn" name="add">စာရင်းသွင်းမည်</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__. '/fragments/footer.php'?>