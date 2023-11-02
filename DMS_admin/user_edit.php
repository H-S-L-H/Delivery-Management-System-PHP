<?php 
  $title = 'Users'; 
  $activePage = 'user_edit.php'; 
  require __DIR__. '/fragments/header.php';
  require __DIR__. '/database/dbcon.php';

  $errors = [
    'user_name'=>'', 
    'user_phone'=>'', 
    'user_email'=>'',
    'user_password'=>'',
    'user_role'=>''
  ]; //will arrive to this array if any errors

  if(isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql1 = "SELECT * FROM users WHERE user_id='$user_id'";

    $result1 = $mysqli->query($sql1);
    $row1 = $result1->fetch_assoc();

  }

  if(isset($_POST['update'])) {

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
    else { 
      $user_password = trim($_POST['user_password']);  
      $user_password = stripslashes($user_password);  
      $user_password = htmlspecialchars($user_password);
    }

    // check user role
    $user_role = $_POST['user_role'];

    //redirect to next page if no errors
    if(!array_filter($errors)) {
      //will work no errors in the form

      $sql2 = "UPDATE users SET 
      user_name='$user_name', user_phone='$user_phone', user_email='$user_email', user_password='$user_password', roles='$user_role'
      WHERE user_id='$user_id'";

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
            window.location = 'user_details.php?id=$user_id';
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
            <h3 class="mb-0 text-start">Edit User</h3>
          </div>
          <div class="col-md-4 col-sm mb-4">
            <a href="users.php" class="btn float-end w-25 back-btn" style="background-color: #FFCE00; color: #07509E;">Back</a>
          </div>
        </div>
        <form method = "POST" action = "<?php $_PHP_SELF ?>">
          <div class="row text-start">
            <div class="mb-4">
              <label for="user_name" class="form-label mb-3">Name *</label>
              <input type="text" class="form-control" id="user_name" name="user_name" value="<?php if(isset($row1['user_name'])){ echo $row1['user_name']; } ?>">
              <small class="error"><?php if(isset($errors['user_name'])){ echo $errors['user_name']; }?> </small> 
            </div>
            <div class="mb-4">
              <label for="user_phone" class="form-label mb-3">Phone *</label>
              <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?php if(isset($row1['user_phone'])){ echo $row1['user_phone']; } ?>">
              <small class="error"><?php if(isset($errors['user_phone'])){ echo $errors['user_phone']; }?> </small>
            </div>
            <div class="mb-4">
              <label for="user_email" class="form-label mb-3">Email *</label>
              <input type="text" class="form-control" id="user_email" name="user_email" value="<?php if(isset($row1['user_email'])){ echo $row1['user_email']; } ?>">
              <small class="error"><?php if(isset($errors['user_email'])){ echo $errors['user_email']; }?> </small>
            </div>
            <div class="mb-4">
              <label for="user_password" class="form-label mb-3">Password *</label>
              <input type="text" class="form-control" id="user_password" name="user_password" value="<?php if(isset($row1['user_password'])){ echo $row1['user_password']; } ?>">
              <small class="error"><?php if(isset($errors['user_password'])){ echo $errors['user_password']; }?> </small>
            </div>
            <div class="mb-4">
              <label for="user_role" class="form-label mb-3">Role *</label>
              <select class="form-select" name="user_role">
                <option value="" disabled selected>Choose User Role</option>
                <option value="0" <?php if(isset($row1['roles'])){ if($row1['roles'] == 0){ echo "selected"; }} ?>>User</option>
                <option value="1" <?php if(isset($row1['roles'])){ if($row1['roles'] == 1){ echo "selected"; }} ?>>Admin</option>
              </select>
              <small class="error"><?php if(isset($errors['user_role'])){ echo $errors['user_role']; }?> </small>
            </div>
            <div class="d-grid gap-2 col-md-4 col-sm-12 mx-auto mt-3 mb-4">
              <button class="btn pickup-btn" type="submit" name="update">Update</button>
            </div>
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