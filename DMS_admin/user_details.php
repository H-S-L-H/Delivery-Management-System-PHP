<?php 
  $title = 'Users'; 
  $activePage = 'user_details.php'; 
  require __DIR__. '/fragments/header.php';
  require __DIR__. '/database/dbcon.php';

  if(isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $result = $mysqli->query($sql);

    $row = $result->fetch_assoc();

  }
  
?>

<section class="order_detail">
  <div class="container-fluid pt-4 px-4">
    <div class="text-center rounded p-4" style="background-color: #07509E">
      <div class="row">
        <div class="col-md-8 col-sm mb-4">
          <h3 class="mb-0 text-start">User Details</h3>
        </div>
        <div class="col-md-4 col-sm mb-4">
          <a href="users.php" class="btn float-end w-25 back-btn" style="background-color: #FFCE00; color: #07509E;">Back</a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered text-white align-middle mb-3">
          <tbody class="text-start">
            <tr style="border: 1px solid white">
              <th>Name</th>
              <td><?php echo $row['user_name'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Phone</th>
              <td><?php echo $row['user_phone'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Email</th>
              <td><?php echo $row['user_email'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Password</th>
              <td><?php echo $row['user_password'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Role</th>
              <td><?php  if($row["roles"] == 0){ echo "User";}else { echo "Admin"; }; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__. '/fragments/footer.php'?>