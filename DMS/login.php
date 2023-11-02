<?php 
session_start(); 
$title = 'အကောင့်ဝင်ရန်'; 
$activePage = 'login.php'; 
require __DIR__. '/fragments/header.php';
require __DIR__. '/database/dbcon.php';


$errors = [
  'email'=>'',  
  'password'=>'', 
];

if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  
//check phone
if (empty($_POST['email'])) {  
  $errors['email'] = "အီးမေးလ်ဖြည့်ရန်လိုအပ်ပါသည်";  
} 
else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {  
  $errors['email'] = "အီးမေးလ်ပုံစံအမှန်ဖြည့်ရန်လိုအပ်ပါသည်"; 
} 

// check password

if (empty($_POST['password'])) {  
  $errors['password'] = "လျှို့ဝှက်နံပါတ်ဖြည့်ရန်လိုအပ်ပါသည်";
} 

if (!array_filter($errors)) {
  $query = "SELECT * FROM users WHERE user_email='$email'";
  $results = $mysqli->query($query);
  if ($results->num_rows > 0) {
    $data = mysqli_fetch_array($results);
    if(password_verify($password, $data['user_password'])) {
      $_SESSION['username'] = $data['user_name'];
      $_SESSION['userid'] =  $data['user_id'];
      $_SESSION['role'] =  $data['roles'];
  	  $_SESSION['logged_in'] = true;
      if($data['roles'] == 1) {
        header('location: http://localhost:8080/DMS_admin/index.php');
      }
      else {
        header('location: index.php');
      } 
    }
    else {
      $errors['password'] = "အမည် သို့မဟုတ် လျှို့ဝှက်နံပါတ်မှားနေပါသည်";
    }
  }else {
    $errors['password'] = "အမည် သို့မဟုတ် လျှို့ဝှက်နံပါတ်မှားနေပါသည်";
  }
}
 
$mysqli->close();

}

?>

<section class="login">
  <div class="container">
    <div class="login-form mt-4 mb-5 py-5">
      <div class="row ">
        <div class="col-md-6 col-sm-12 text-center">
          <img src="images/login.png" alt="login" class="img-fluid mb-4 w-75">
          <p class="small fw-bold pt-1 mb-2">စာရင်းမသွင်းရသေးပါက စာရင်းအရင်သွင်းပြီးမှ အကောင့်ဝင်ပေးပါ။</p>
          <a href="register.php"class=""> စာရင်းသွင်းရန်</a>
        </div>
        <div class="col-md-6 col-sm-12 ps-4">
          <form action="<?php $_PHP_SELF ?>" method="POST" class="ps-3 pe-3 ms-5 justify-content-center">
            <h4 class="pt-5 mb-4">အကောင့်ဝင်ရန်</h4>
             <!-- Username input -->
            <div class="input-with-icon mb-4">
              <input type="text" class="form-control w-75" id="email" name="email" placeholder="အီးမေးလ်" value="<?php if(isset($email)){ echo $email; } ?>">  
              <small class="error"><?php if(isset($errors['email'])){ echo $errors['email']; }?> </small> 
              <i class="fa-solid fa-envelope"></i>
            </div>
             <!-- Password input -->
            <div class="input-with-icon mb-4">
              <input type="password" class="form-control w-75" id="inputPassword" name="password" placeholder="လျှို့ဝှက်နံပါတ်" value="<?php if(isset($password)){ echo $password; } ?>">
              <small class="error"><?php if(isset($errors['password'])){ echo $errors['password']; }?> </small> 
              <i class="fa-solid fa-lock"></i>
            </div>
             <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="checkbox">
              <label class="form-check-label" for="checkbox">
                Remember me
              </label>
            </div>
            <div class=" text-lg-start mt-4">
            <button type="btn" name="login" class="btn">အကောင့်ဝင်မည်</button>
            </div>
          </form>  
        </div>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__. '/fragments/footer.php'?>