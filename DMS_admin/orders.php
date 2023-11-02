<?php 
  $title = 'Orders'; 
  $activePage = 'orders.php'; 
  require __DIR__. '/fragments/header.php';
  require __DIR__. '/database/dbcon.php';
?>

<section class="orders">
  <div class="container-fluid pt-4 px-4">
    <div class="text-center rounded p-4" style="background-color: #07509E">
      <div class="row">
        <div class="col-sm mb-2">
          <h3 class="mb-0 text-start">Orders</h3>
        </div>
      </div>
      <div class="table-responsive">
          <table class="table text-center align-middle table-hover mb-3">
              <thead>
                  <tr class="text-white">
                      <th scope="col">No.</th>
                      <th scope="col">Order Number</th>
                      <th scope="col">Sender Name</th>
                      <th scope="col">Receiver Name</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
              <?php

                //get page number
                if(isset($_GET['page_no']) && $_GET['page_no'] !== "") {
                  $page_no = $_GET['page_no'];
                } else {
                  $page_no = 1;
                }

                //total rows or records to display
                $total_records_per_page = 10;

                //get the page offset for the LIMIT query
                $offset = ($page_no - 1) * $total_records_per_page;

                //get the previous page
                $previous_page = $page_no - 1;

                //get the next page
                $next_page = $page_no +1;

                //get the total count of records
                $result_count = $mysqli->query("SELECT COUNT(*) as total_records FROM orders");

                //total records
                $records = mysqli_fetch_array($result_count);

                //store total_records to a variable
                $total_records = $records['total_records'];

                //get total pages
                $total_no_of_pages = ceil($total_records / $total_records_per_page);

                $sql = "SELECT * FROM orders ORDER BY id DESC LIMIT $offset, $total_records_per_page";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {

                  $count = ($page_no>1) ? ($page_no * $total_records_per_page) - $total_records_per_page : 0;
                  $i = $count + 1;

                  while($row = $result->fetch_assoc()) { 
                    
              ?>

                    <tr class="text-white">
                      <td><?php echo $i++.".";  ?></td>
                      <td><?php echo $row["order_number"]; ?></td>
                      <td><?php echo $row["sender_name"]; ?></td>
                      <td><?php echo $row["receiver_name"]; ?></td>
                      <td><?php echo $row["order_status"]; ?></td>
                      <td>
                        <a href="order_details.php?id=<?= $row["id"] ?>" class="btn btn-sm" data-bs-toggle="tooltip" title="View Detail"><i class="fa-solid fa-eye" style="background-color: white; padding: 10px; border-radius: 50%; color: green;"></i></a>
                        <a href="order_edit.php?id=<?= $row["id"] ?>" class="btn btn-sm" data-bs-toggle="tooltip" title="Edit"><i class="fa-sharp fa-solid fa-pen" style="background-color: white; padding: 10px; border-radius: 50%; color: blue;"></i></a>
                        <a href="#" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row["id"] ?>"><i class="fa-solid fa-trash" data-bs-toggle="tooltip" title="Delete" style="background-color: white; padding: 10px; border-radius: 50%; color: red;"></i></a>
                        <!-- Delete Modal -->
                        <div class="modal" id="deleteModal<?= $row["id"] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header text-body">
                                <p class="modal-title fs-5 fw-bold" id="exampleModalLabel">Delete</p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body text-body">
                                <p class="mb-0">Are you sure you want to delete this record?</p>
                              </div>
                              <div class="modal-footer text-body">
                                <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                <a href="order_delete.php?id=<?= $row["id"] ?>" class="btn btn-primary">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                  </tr>
              <?php
                  }
                }
                else {
              ?>
                  </tbody>
                </table>
                <div class="mb-5 mt-5">
                  <img src="img/empty.png" class="img-fluid" style="width: 60px;">
                  <h5>No Record Found</h5>
                </div>
              <?php  
              } 
                mysqli_free_result($result);

                $mysqli->close();
              ?>
              </tbody>
          </table>
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item">
            <a class="page-link <?= ($page_no <= 1)? 'disabled': ''; ?>" 
            <?= ($page_no > 1)? 'href=?page_no=' . $previous_page : ''; ?> aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          
          <?php for($counter = 1; $counter <= $total_no_of_pages; $counter++) { ?>
            <li class="page-item"><a class="page-link" href="?page_no=<?= $counter; ?>"><?= $counter; ?></a></li>
          <?php } ?>

          <li class="page-item">
            <a class="page-link <?= ($page_no >= $total_no_of_pages)? 'disabled': ''; ?>" 
            <?= ($page_no < $total_no_of_pages)? 'href=?page_no=' . $next_page : ''; ?>>
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
      <div class="p-10 text-white">
        <strong>Page <?= $page_no; ?> of <?= $total_no_of_pages; ?></strong>
      </div>
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