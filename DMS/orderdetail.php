<?php 
  session_start();
  $title = 'အော်ဒါအသေးစိတ်'; 
  $activePage = 'orderdetail.php'; 
  require __DIR__. '/fragments/header.php';
  require __DIR__. '/database/dbcon.php';
?>

<section class="order-detail mb-5">
  <div class="container">
    <h3 class="text-center text-white mt-3 mb-5">အော်ဒါအသေးစိတ်</h3>

<?php
  $sql = "SELECT * FROM orders WHERE user_id = ". $_SESSION['userid']." ORDER BY id DESC";

  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
?>

      <div class="row order-detail-row mt-3">
        <div class="col pt-2 pb-2 text-center">
          <p class="fw-bold">အော်ဒါနံပါတ်</p>
          <p><?php echo $row["order_number"] ?></p>
        </div>
        <div class="col pt-2 pb-2 text-center">
          <p class="fw-bold">ပေးပို့သူအမည်</p>
          <p><?php echo $row["sender_name"];  ?></p>
        </div>
        <div class="col pt-2 pb-2 text-center">
          <p class="fw-bold">အ‌ခြေအနေ</p>
          <p><?php echo $row["order_status"] ?></p>
          <a href="#" id="<?php echo $row["id"] ?>" class="detail_link text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id'] ?>">အသေးစိတ်ကြည့်ရန် >></a>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <p class="modal-title fw-bold" id="exampleModalLabel">အော်ဒါနံပါတ် : <span class="fw-normal"><?php echo $row["order_number"] ?></span></p>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                  <p class="fw-bold">ပေးပို့သူအမည် : <span class="fw-normal"><?php echo $row["sender_name"] ?></span></p>
                  <p class="fw-bold">ပေးပို့သူဖုန်းနံပါတ် : <span class="fw-normal"><?php echo $row["sender_phone"] ?></span></p>
                  <p class="fw-bold">ပေးပို့သူလိပ်စာ : <span class="fw-normal"><?php echo $row["pickup_address"] ?></span></p>
                  <p class="fw-bold">အော်ဒါလာကောက်သောနေ့ : <span class="fw-normal"><?php echo $row["pickup_date"] ?></span></p>
                  <p class="fw-bold">အော်ဒါလာကောက်သောယာဉ်အမျိုးအစား : <span class="fw-normal"><?php echo $row["pickup_vehicle"] ?></span></p>
                  <p class="fw-bold">အထူးမှာကြားချက် : <span class="fw-normal"><?php if($row["sender_note"]==NULL){ echo "မရှိခဲ့ပါ"; } else {echo $row["sender_note"];} ?></span></p>
                  <hr>
                  <p class="fw-bold">လက်ခံသူအမည်: <span class="fw-normal"><?php echo $row["receiver_name"] ?></span></p>
                  <p class="fw-bold">လက်ခံသူဖုန်းနံပါတ်: <span class="fw-normal"><?php echo $row["receiver_phone"] ?></span></p>
                  <p class="fw-bold">လက်ခံသူလိပ်စာ: <span class="fw-normal"><?php echo $row["receiver_address"] ?></span></p>
                  <p class="fw-bold">ပစ္စည်းရောက်မည့်ခက်မှန်းရက်: <span class="fw-normal"><?php if($row["estimate_arrival_date"] == NULL){ echo "မသတ်မှတ်ရသေးပါ"; }else { echo $row["estimate_arrival_date"]; }  ?></span></p>
                  <p class="fw-bold">ပို့ဆောင်မည့်နည်းလမ်း: <span class="fw-normal"><?php echo $row["deliver_method"] ?></span></p>
                  <p class="fw-bold">ငွေချေမည့်ပုံစံ: <span class="fw-normal"><?php echo $row["payment_method"] ?></span></p>
                  <p class="fw-bold">ပစ္စည်းတန်ဖိုး: <span class="fw-normal"><?php if($row["parcel_price"]==0){ echo "ရှင်းပြီး"; } else {echo $row["parcel_price"];} ?></span></p>
                  <p class="fw-bold">ပို့ဆောင်ခ: <span class="fw-normal"><?php if($row["delivery_fee"]==0){ echo "မသတ်မှတ်ရသေးပါ"; } else {echo $row["delivery_fee"];} ?></span></p>
                  <hr>
                  <p class="fw-bold">ပစ္စည်းအလေးချိန်: <span class="fw-normal"><?php if($row["parcel_weight"]==0){ echo "မသတ်မှတ်ရသေးပါ"; } else {echo $row["parcel_weight"];} ?></span></p>
                  <hr>
                  <p class="fw-bold">အ‌ခြေအနေ: <span class="fw-normal"><?php echo $row["order_status"] ?></span></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
          }
        }
        else {
      ?>
        <div class="mb-5 mt-5 text-center">
          <img src="images/empty.png" class="img-fluid" style="width: 60px;">
          <h5 class="text-white">No Record Found</h5>
        </div>
      <?php  
      } 
        mysqli_free_result($result);

        $mysqli->close();
      ?>
  </div>
</section>

<?php require __DIR__. '/fragments/footer.php'?>