<?php 
  $title = 'Contacts'; 
  $activePage = 'contact_details.php'; 
  require __DIR__. '/fragments/header.php';
  require __DIR__. '/database/dbcon.php';

  if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM contactus WHERE id='$id'";
    $result = $mysqli->query($sql);

    $row = $result->fetch_assoc();

  }
  
?>

<section class="order_detail">
  <div class="container-fluid pt-4 px-4">
    <div class="text-center rounded p-4" style="background-color: #07509E">
      <div class="row">
        <div class="col-md-8 col-sm mb-4">
          <h3 class="mb-0 text-start">Contact Details</h3>
        </div>
        <div class="col-md-4 col-sm mb-4">
          <a href="contacts.php" class="btn float-end w-25 back-btn" style="background-color: #FFCE00; color: #07509E;">Back</a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered text-white align-middle mb-3">
          <tbody class="text-start">
            <tr style="border: 1px solid white">
              <th>Name</th>
              <td><?php echo $row['contact_name'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Phone</th>
              <td><?php echo $row['contact_phone'] ?></td>
            </tr>
            <tr style="border: 1px solid white">
              <th>Description</th>
              <td><?php echo $row['contact_description'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__. '/fragments/footer.php'?>