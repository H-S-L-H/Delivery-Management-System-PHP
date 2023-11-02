<?php 
  $title = 'Users'; 
  $activePage = 'user_form.php'; 
  require __DIR__. '/fragments/header.php';
  require __DIR__. '/database/dbcon.php';

  $errors = [
    'user_name'=>'', 
    'user_phone'=>'', 
    'user_email'=>'',
    'user_password'=>'',
    'retype_password'=>''
  ]; //will arrive to this array if any errors

  if(isset($_POST['add'])) {

    //check sender name
    if (empty($_POST['user_name'])) {  
      $errors['user_name'] = "Name is required!";
    } 
    else if (!preg_match("/^[a-zA-Z ]*$/",$_POST['user_name'])) {  
      $errors['user_name'] = "Only alphabets and white space can  fill!"; 
    } 
    else { 
      $user_name = trim($_POST['user_name']);  
      $user_name = stripslashes($user_name);  
      $user_name = htmlspecialchars($user_name);
    }

    //check sender phone
    if (empty($_POST['user_phone'])) {  
      $errors['user_phone'] = "Phone Number is required!";  
    } 
    else if (!preg_match ("/^[0-9]*$/", $_POST['user_phone']) ) {  
      $errors['user_phone']  = "Only number must be!";  
    }
    else if (!preg_match ("/^09/", $_POST['user_phone'])) {
      $errors['user_phone']  = "Only number start with 09 must be!";
    }
    else if (strlen ($_POST['user_phone']) != 11) {  
      $errors['user_phone']  = "Number must be included 11 numbers!";  
    } 
    else {
      $user_phone = trim($_POST['user_phone']);  
      $user_phone = stripslashes($user_phone);  
      $user_phone = htmlspecialchars($user_phone);
    }

    // check user email

    if (empty($_POST['user_email'])) {  
      $errors['user_email'] = "Email is required!";
    } 
    else if (!filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL)) {  
       $errors['user_email'] = "Email is invalid"; 
    } 
    else { 
      $user_email = trim($_POST['user_email']);  
      $user_email = stripslashes($user_email);  
      $user_email = htmlspecialchars($user_email);
    }

    // check user password

    if (empty($_POST['user_password'])) {  
      $errors['user_password'] = "Password is required!";
    } 
    else if (strlen($_POST['user_password']) != 8) {
      $errors['user_password'] = 'Password length must be included 8 character!';
    }
    else { 
      $user_password = trim($_POST['user_password']);  
      $user_password = htmlspecialchars($user_password);
     }

     // check retype password

     if (empty($_POST['retype_password'])) {  
      $errors['retype_password'] = "Retype-password is required!";
    } 
    else if ($_POST['user_password'] !== $_POST['retype_password']){
      $errors['retype_password'] = 'Password not same!';
    }
    else{
      $hash_password = password_hash($_POST['user_password'] ,  PASSWORD_BCRYPT);
    }

    // check user role
    if(isset($_POST['user_role'])) {
      $user_role = $_POST['user_role'];
    }
    else {
      $user_role = 0;
    }
    //echo $user_role;

    //redirect to next page if no errors
    if(!array_filter($errors)) {
      //will work no errors in the form
        $sql = "INSERT INTO users 
        (user_name, user_phone, user_email, user_password, roles) VALUES 
        ('$user_name', '$user_phone', '$user_email', '$hash_password', '$user_role')";

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
            title: 'Form Submitted Successfully!'
          }).then(function() {
            window.location = 'users.php';
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
            <h3 class="mb-0 text-start">Add User</h3>
          </div>
          <div class="col-md-4 col-sm mb-4">
            <a href="users.php" class="btn float-end w-25 back-btn" style="background-color: #FFCE00; color: #07509E;">Back</a>
          </div>
        </div>
        <form method = "POST" action = "<?php $_PHP_SELF ?>" class="text-start">
          <div class="mb-4">
            <label for="user_name" class="form-label mb-3">Name *</label>
            <input type="text" class="form-control" id="user_name" name="user_name" value="<?php if(isset($user_name)){ echo $user_name; } ?>">
            <small class="error"><?php if(isset($errors['user_name'])){ echo $errors['user_name']; }?> </small> 
          </div>
          <div class="mb-4">
            <label for="user_phone" class="form-label mb-3">Phone *</label>
            <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?php if(isset($user_phone)){ echo $user_phone; } ?>">
            <small class="error"><?php if(isset($errors['user_phone'])){ echo $errors['user_phone']; }?> </small>
          </div>
          <div class="mb-4">
            <label for="user_email" class="form-label mb-3">Email *</label>
            <input type="text" class="form-control" id="user_email" name="user_email" value="<?php if(isset($user_email)){ echo $user_email; } ?>">
            <small class="error"><?php if(isset($errors['user_email'])){ echo $errors['user_email']; }?> </small>
          </div>
          <div class="mb-4">
            <label for="user_password" class="form-label mb-3">Password *</label>
            <input type="password" class="form-control" id="user_password" name="user_password" value="<?php if(isset($user_password)){ echo $user_password; } ?>">
            <small class="error"><?php if(isset($errors['user_password'])){ echo $errors['user_password']; }?> </small>
          </div>
          <div class="mb-4">
            <label for="user_password" class="form-label mb-3">Retype-password *</label>
            <input type="password" class="form-control" id="retype_password" name="retype_password" value="<?php if(isset($retype_password)){ echo $retype_password; } ?>">
            <small class="error"><?php if(isset($errors['retype_password'])){ echo $errors['retype_password']; }?> </small> 
          </div>
          <div class="mb-4">
            <label for="user_role" class="form-label mb-3">Role</label>
            <select class="form-select" name="user_role">
              <option value="" disabled selected>Choose User Role</option>
              <option value="0" <?php if(isset($user_role)){ if($user_role == 0){ echo "selected"; }} ?>>User</option>
              <option value="1" <?php if(isset($user_role)){ if($user_role == 1){ echo "selected"; }} ?>>Admin</option>
            </select>
          </div>
          <div class="d-grid gap-2 col-md-4 col-sm-12 mx-auto mt-3 mb-4">
            <button class="btn pickup-btn" type="submit" name="add">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </section>

<?php require __DIR__. '/fragments/footer.php'?>