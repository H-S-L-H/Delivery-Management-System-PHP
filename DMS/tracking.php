<?php 
$title = 'ပါဆယ်အခြေအနေ'; 
$activePage = 'tracking.php'; 
require __DIR__. '/fragments/header.php';
require __DIR__. '/database/dbcon.php';

  if (isset($_POST['track'], $_POST['order_id'])){ 
    $order_id = trim($_POST['order_id']);
    $order_id = htmlspecialchars($order_id); 
 }
?>

<section class="about-us mb-5">
  <div class="container">
    <h3 class="text-center text-white mt-3 mb-5">ပါဆယ်အခြေအနေ အသေးစိတ်</h3>
  </div>

<?php

  //$s1_color = '#D9D9D9';
  $sql = " SELECT order_status FROM orders WHERE order_number='$order_id' ";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row["order_status"] == "အော်ဒါတင်ထားဆဲ")
    {
      $order_status = "အော်ဒါတင်ထားဆဲ";
      $s1_color = '#FFCE00';
      
    }
    elseif ($row["order_status"] == "ပစ္စည်းလာယူနေဆဲ")
    {
      $order_status = "ပစ္စည်းလာယူနေဆဲ";
      $s1_color = '#FFCE00';
      $s2_color = '#FFCE00';
    }
    elseif ($row["order_status"] == "ပစ္စည်းယူဆောင်ပြီး")
    {
        $order_status = "ပစ္စည်းယူဆောင်ပြီး";
        $s1_color = '#FFCE00';
        $s2_color = '#FFCE00';
        $s3_color = '#FFCE00';
            
    } 
  elseif ($row["order_status"] == "ဂိုထောင်ရောက်ရှိ")
    {
      $order_status = "ဂိုထောင်ရောက်ရှိ";
      $s1_color = '#FFCE00';
      $s2_color = '#FFCE00';
      $s3_color = '#FFCE00';
      $s4_color = '#FFCE00';
    } 
    elseif ($row["order_status"] == "ပို့ဆောင်နေပါပြီ")
    {
      $order_status = "ပို့ဆောင်နေပါပြီ";
      $s1_color = '#FFCE00';
      $s2_color = '#FFCE00';
      $s3_color = '#FFCE00';
      $s4_color = '#FFCE00';
      $s5_color = '#FFCE00';
    }

  else 
  {
        $order_status = "ပို့ဆောင်ပြီးပါပြီ";
        $s1_color = '#FFCE00';
        $s2_color = '#FFCE00';
        $s3_color = '#FFCE00';
        $s4_color = '#FFCE00';
        $s5_color = '#FFCE00';
        $s6_color = '#FFCE00';
  }     
?> 
          <div class="container">
            <h4 class="text-center text-white mt-3 mb-4">ပါဆယ်အခြေအနေ :<span style="color:<?php echo $s1_color; ?>; "><?php echo  $order_status; ?></span></h4> 
            <h5 class="text-center text-white mt-3 mb-5">အော်ဒါနံပါတ် : <?php echo $order_id;?> </h5>
          
  
            <div class="row">
              <div class="col-lg-2 col-sm-6 mb-5">
                <img src="images/tracking1.png" class="img-fluid mx-auto d-block" alt="door_to_door" style="background: <?php if(isset($s1_color)){echo $s1_color;}else {echo "#D9D9D9";}; ?>; padding: 8px; width: 50px; height: 50px; object-fit: cover;">
                <p class=" text-center text-white mt-4" ><span style="color:<?php echo $s1_color; ?>;">အော်ဒါတင်ထားဆဲ</span></p>
              </div><!-- /.col-lg-4 -->
              <div class="col-lg-2 col-sm-6 mb-5">
                <img src="images/tracking2.png" class="img-fluid mx-auto d-block" alt="door_to_door" style="background: <?php if(isset($s2_color)){echo $s2_color;}else {echo "#D9D9D9";}; ?>; padding: 8px; width: 50px; height: 50px; object-fit: cover;">
                <p class=" text-center text-white mt-4" ><span style="color:<?php echo $s2_color; ?>;">ပစ္စည်းလာယူနေဆဲ</span></p>
              </div><!-- /.col-lg-4 -->
              <div class="col-lg-2 col-sm-6 mb-5">
                <img src="images/tracking3.png" class="img-fluid mx-auto d-block" alt="cash_on_delivery" style="background: <?php if(isset($s3_color)){echo $s3_color;}else {echo "#D9D9D9";}; ?>; padding: 8px; width: 50px; height: 50px; object-fit: cover;">
                <p class=" text-center text-white mt-4"><span style="color:<?php echo $s3_color; ?>;">ပစ္စည်းယူဆောင်ပြီး</span></p>
              </div><!-- /.col-lg-4 -->
              <div class="col-lg-2 col-sm-6 mb-5">
                <img src="images/tracking4.png" class="img-fluid mx-auto d-block" alt="free_shipping" style="background: <?php if(isset($s4_color)){echo $s4_color;}else {echo "#D9D9D9";}; ?>; padding: 8px; width: 50px; height: 50px; object-fit: cover;">
                <p class=" text-center text-white mt-4"><span style="color:<?php echo $s4_color; ?>;">ဂိုထောင်ရောက်ရှိ</span></p>
              </div><!-- /.col-lg-4 -->
              <div class="col-lg-2 col-sm-6 mb-5">
                <img src="images/tracking5.png" class="img-fluid mx-auto d-block" alt="product_return" style="background: <?php if(isset($s5_color)){echo $s5_color;}else {echo "#D9D9D9";}; ?>; padding: 8px; width: 50px; height: 50px; object-fit: cover;">
                <p class=" text-center text-white mt-4"><span style="color:<?php echo $s5_color; ?>;">ပို့ဆောင်နေပါပြီ</span></p>
              </div><!-- /.col-lg-4 -->
              <div class="col-lg-2 col-sm-6 mb-5">
                <img src="images/tracking6.png" class="img-fluid mx-auto d-block" alt="tracking" style="background: <?php if(isset($s6_color)){echo $s6_color;}else {echo "#D9D9D9";}; ?>; padding: 8px; width: 50px; height: 50px; object-fit: cover;">
                <p class=" text-center text-white mt-4"><span style="color:<?php echo $s6_color; ?>;">ပို့ဆောင်ပြီးပါပြီ</span></p>
              </div><!-- /.col-lg-4 -->
            </div>
          </div>

<?php
}
else {
  ?>
    <div class="mb-5 mt-5 text-center">
      <img src="images/empty.png" class="img-fluid mb-3" style="width: 60px;">
      <h5 class="text-white">ပါဆယ်အခြေအနေရှာမရပါ / အော်ဒါနံပါတ်ပြန်စစ်ကြည့်ပါ</h5>
    </div>
  <?php  
  } 
    mysqli_free_result($result);

    $mysqli->close();
  ?>
  
    
</section>

<?php require __DIR__. '/fragments/footer.php'?>


            