<?php 
session_start(); 
$activePage = 'index.php'; 
require __DIR__. '/fragments/header.php';

$errors = [
    'location1'=>'', 
    'location2'=>''
  ]; //will arrive to this array if any errors

if(isset($_POST['price_calculator'])) {
    $weight = $_POST['weight'];

    //check location 1
    if (empty($_POST['location1'])) {  
        $errors['location1'] = "မြို့နယ်ရွေးရန်လိုအပ်သည်";  
    }
    else {
        $location1 = $_POST['location1'];
    }

    //check location 2
    if (empty($_POST['location2'])) {  
        $errors['location2'] = "မြို့နယ်ရွေးရန်လိုအပ်သည်";  
    }
    else {
        $location2 = $_POST['location2'];
    }
  
    if(isset($location1, $location2)) {
        if($weight > 5 ){
        $over_kg = ceil($weight / 5);
        $addCharges = 500 *  ($over_kg-1);
        if(($location1 == "Yangon (ရန်ကုန်)") && ($location2 == "Yangon (ရန်ကုန်)")) {
            $charges = 2000  + $addCharges;
            $duration = 2;
        } 
        else {
            $charges = 3000  + $addCharges;
            $duration = 4;
        }
        }
        else{
            if(($location1 == "Yangon (ရန်ကုန်)") && ($location2 == "Yangon (ရန်ကုန်)")) {
                $charges = 2000;
                $duration = 2;
            } 
            else {
            $charges = 3000;
            $duration = 4;
            }
        }
    }
  }
?>

<section class="home-page">
    <!-------------Main Section--------------->
    <div class="container">
        <div class="row mt-3">
            <div class="col-xs-12 col-sm-6 px-0">
                <h2 class="">အကြီးမားဆုံးနှင့် ယုံကြည်စိတ်ချရဆုံး delivery service</h2>
                <img src="images/homepage_letter.png" class="img-fluid" alt="homepage_letter">
                <p class="lead my-3 mt-5 ">သင့်ကုန်ပစ္စည်း အခြေအနေကိုလည်း Tracking Numberနှင့်တကွ ကြည့်နိုင်ပါပြီ</p>
                <form action="tracking.php" method="POST">
                    <div class="input-group w-75 mb-3">
                        <input type="text" name="order_id" required="required" class="tracking-form form-control" placeholder="Tracking Numberရိုက်ထည့်ပါ" aria-label="Tracking Number" aria-describedby="button-addon2">
                        <button class="tracking-btn btn" type="submit" id="button-addon2" name = "track">ရှာဖွေမည်</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-6 px-0 d-xs-none">
                <img src="images/delivery_man.png" class="delivery-man-img img-fluid w-75 ms-5" alt="delivery_man">
            </div>
        </div>
    </div>
    <!-------------Carousel--------------->
    <div id="carouselExampleSlidesOnly" class="carousel slide mt-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <p class="pt-4 pb-4 mb-0">တနင်္သာရီတိုင်း မြိတ်မြို့မှာ FAST BOX Deliveryဝန်ဆောင်မှုရနေပြီနော်</p>
            </div>
            <div class="carousel-item">
                <p class="pt-4 pb-4 mb-0">ဧရာဝတီတိုင်း ပုသိမ်မြို့မှာ FAST BOX Deliveryဝန်ဆောင်မှုရနေပြီနော်</p>
            </div>
            <div class="carousel-item">
                <p class="pt-4 pb-4 mb-0">စစ်ကိုင်းတိုင်း ရွှေဘိုမြို့မှာ FAST BOX Deliveryဝန်ဆောင်မှုရနေပြီနော်</p>
            </div>
        </div>
    </div>
     
    <div class="container">
     <!-------------Service--------------->
        <div class="delivery-service">
            <h3 class="text-center text-white mt-5 mb-5">ဝန်ဆောင်မှုများ</h3>
            <div class="row">
                <div class="col-lg-4 col-sm-6 mb-5">
                    <img src="images/door_to_door.png" class="service-img img-fluid w-25 mx-auto d-block" alt="door_to_door">
                    <p class=" text-center text-white mt-4">အိမ်အရောက်ပို့</p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4 col-sm-6 mb-5">
                    <img src="images/cash_on_delivery.png" class="service-img img-fluid w-25 mx-auto d-block" alt="cash_on_delivery">
                    <p class=" text-center text-white mt-4">အိမ်အရောက်ငွေချေ</p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4 col-sm-6 mb-5">
                    <img src="images/free_shipping.png" class="service-img img-fluid w-25 mx-auto d-block" alt="free_shipping">
                    <p class=" text-center text-white mt-4">အခမဲ့အော်ဒါကောက်</p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4 col-sm-6 mb-5">
                    <img src="images/product_return.png" class="service-img img-fluid w-25 mx-auto d-block" alt="product_return">
                    <p class=" text-center text-white mt-4">အခမဲ့ပြန်လည်ပို့ဆောင်</p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4 col-sm-6 mb-5">
                    <img src="images/tracking.png" class="service-img img-fluid w-25 mx-auto d-block" alt="tracking">
                    <p class=" text-center text-white mt-4">ခြေရာခံစနစ်</p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4 col-sm-6 mb-5">
                    <img src="images/pricing.png" class="service-img img-fluid w-25 mx-auto d-block" alt="pricing">
                    <p class=" text-center text-white mt-4">ဈေးနှုန်းတွက်စနစ်</p>
                </div><!-- /.col-lg-4 -->
            </div>
        </div>
        <!-------------Delivery Place-------------->
        <div class="delivery-place">
            <h3 class="text-center text-white mb-5">ပေးပို့နိုင်သောနေရာများ</h3>
            <img src="images/delivery_place.jpg" class="img-fluid rounded w-100 mx-auto d-block" alt="delivery_place">
        </div>
        <!-------------Price Calculate------------>
        <div class="price-calculate mt-5 mb-5 ">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h4 class="pt-5 mb-4 ps-5">ပို့ဆောင်ခတွက်ချက်မည်</h4>
                    <p class="ps-5">သင်ပို့ဆောင်မည့်မြို့ ၊ ပစ္စည်းအလေးချိန်အလိုက် <br> စျေးနှုန်းများတွက်ချက်နိုင်ပါသည်။</p>
                    <img src="images/price_calculate_man.png" class="img-fluid ms-5 pt-2 w-75" alt="price_calculate_man">
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 mt-5 mb-5 pe-5">
                    <form action="<?php $_PHP_SELF ?>" method="POST" class="calculate-form py-5 ps-3 pe-3 ms-5 justify-content-center">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="FromCity" class="form-label mb-3">မြို့မှ</label>
                                <select class="form-select" name="location1"  aria-label="Default select example" style="color: #07509E;">
                                    <option value="" selected disabled>မြို့ရွေးချယ်ပါ</option>
                                    <option value="Yangon (ရန်ကုန်)" <?php if(isset($location1)){ if($location1 == "Yangon (ရန်ကုန်)"){ echo "selected"; }} ?>>Yangon (ရန်ကုန်)</option>
                                    <option value="Mandalay (မန္တလေး)" <?php if(isset($location1)){ if($location1 == "Mandalay (မန္တလေး)"){ echo "selected"; }} ?>>Mandalay (မန္တလေး)</option>
                                    <option value="Naypyitaw (နေပြည်တော်)" <?php if(isset($location1)){ if($location1 == "Naypyitaw (နေပြည်တော်)"){ echo "selected"; }} ?>>Naypyitaw (နေပြည်တော်)</option>
                                    <option value="Bago (ပဲခူး)" <?php if(isset($location1)){ if($location1 == "Bago (ပဲခူး)"){ echo "selected"; }} ?>>Bago (ပဲခူး)</option>
                                    <option value="Magway (မကွေး)" <?php if(isset($location1)){ if($location1 == "Magway (မကွေး)"){ echo "selected"; }} ?>>Magway (မကွေး)</option>
                                    <option value="Arrawady (ဧရာဝတီ)" <?php if(isset($location1)){ if($location1 == "Arrawady (ဧရာဝတီ)"){ echo "selected"; }} ?>>Arrawady (ဧရာဝတီ)</option>
                                    <option value="Tanintharyi (တနင်္သာရီ)" <?php if(isset($location1)){ if($location1 == "Tanintharyi (တနင်္သာရီ)"){ echo "selected"; }} ?>>Tanintharyi (တနင်္သာရီ)</option>
                                    <option value="Sagaing (စစ်ကိုင်း)" <?php if(isset($location1)){ if($location1 == "Sagaing (စစ်ကိုင်း)"){ echo "selected"; }} ?>>Sagaing (စစ်ကိုင်း)</option>
                                </select>
                                <small class="error"><?php if(isset($errors['location1'])){ echo $errors['location1']; }?> </small>
                            </div>
                            <div class=" col-md-6 col-sm-12 mb-3">
                                <label for="ToCity" class="form-label mb-3">မြို့သို့</label>
                                <select class="form-select" name="location2" aria-label="Default select example" style="color: #07509E;">
                                    <option value="" selected disabled>မြို့ရွေးချယ်ပါ</option>
                                    <option value="Yangon (ရန်ကုန်)" <?php if(isset($location2)){ if($location2 == "Yangon (ရန်ကုန်)"){ echo "selected"; }} ?>>Yangon (ရန်ကုန်)</option>
                                    <option value="Mandalay (မန္တလေး)" <?php if(isset($location2)){ if($location2 == "Mandalay (မန္တလေး)"){ echo "selected"; }} ?>>Mandalay (မန္တလေး)</option>
                                    <option value="Naypyitaw (နေပြည်တော်)" <?php if(isset($location2)){ if($location2 == "Naypyitaw (နေပြည်တော်)"){ echo "selected"; }} ?>>Naypyitaw (နေပြည်တော်)</option>
                                    <option value="Bago (ပဲခူး)" <?php if(isset($location2)){ if($location2 == "Bago (ပဲခူး)"){ echo "selected"; }} ?>>Bago (ပဲခူး)</option>
                                    <option value="Magway (မကွေး)" <?php if(isset($location2)){ if($location2 == "Magway (မကွေး)"){ echo "selected"; }} ?>>Magway (မကွေး)</option>
                                    <option value="Arrawady (ဧရာဝတီ)" <?php if(isset($location2)){ if($location2 == "Arrawady (ဧရာဝတီ)"){ echo "selected"; }} ?>>Arrawady (ဧရာဝတီ)</option>
                                    <option value="Tanintharyi (တနင်္သာရီ)" <?php if(isset($location2)){ if($location2 == "Tanintharyi (တနင်္သာရီ)"){ echo "selected"; }} ?>>Tanintharyi (တနင်္သာရီ)</option>
                                    <option value="Sagaing (စစ်ကိုင်း)" <?php if(isset($location2)){ if($location2 == "Sagaing (စစ်ကိုင်း)"){ echo "selected"; }} ?>>Sagaing (စစ်ကိုင်း)</option>
                                </select>
                                <small class="error"><?php if(isset($errors['location2'])){ echo $errors['location2']; }?> </small>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="weight" class="form-label">အလေးချိန် (ကီလိုဂရမ်)</label>
                                    <input type="text" class="form-control" id="weight" name="weight" placeholder="123">
                                </div>
                                <div class="col-md-6 col-sm-12 ">
                                    <button class="w-100 btn calculate-btn" type="submit" name="price_calculator">တွက်ချက်မည်</button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label class="form-label">သယ်ယူပို့ဆောင်ခ ကျသင့်ငွေမှာ</label>
                                    <div class="price-result w-100 h-100 d-flex flex-column" style="border-radius: 10px; background-color: #D9D9D9;">
                                    <?php if(isset($location1,$location2)) { ?>
                                        <p class="text-dark text-center mt-3">
                                            <?php echo $location1." - ".$location2; ?>
                                        </p>
                                        <p class="text-dark text-center">
                                            <?php echo "ကျသင့်ငွေ = ".$charges."ကျပ်"; ?>
                                        </p>
                                        <p class="text-dark text-center mb-0">(၅)ကီလိုဂရမ်ကျော်လျှင် (၅၀၀)ကျပ်ပိုပေးရသည်။</p>
                                        <p class="text-dark text-center border border-dark w-75 mx-auto mt-auto">ဝန်ဆောင်မှုကြာချိန် - (<?php echo $duration; ?>)ရက်အတွင်း</p>
                                    <?php } else { ?>
                                        <p class="text-dark text-center">&nbsp;</p>
                                        <p class="text-dark text-center">&nbsp;</p>
                                        <p class="text-dark text-center border border-dark w-75 mx-auto mt-auto">ဝန်ဆောင်မှုကြာချိန် - ()ရက်အတွင်း</p>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-------------Questions-------------->
        <div class="container">
            <div class="questions">
            <h3 class="text-center text-white mt-5 mb-5">အမေးများသောမေးခွန်းများ</h3>
            <div class="accordion accordion-flush mb-5" id="accordionFlushExample">
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <span>ကြိုရှင်းဝန်ဆောင်မှုရှိပါသလား?</span> 
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                        ငွေကြိုရှင်းဝန်ဆောင်မှု မရရှိသေးပါ။
                        </div> 
                    </div>
                </div>
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <span>မပို့ဆောင်ပေးသောပစ္စည်းများရှိပါသလား?</span> 
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                        အလွယ်တကူကွဲရှလွယ်သောပစ္စည်းများ၊ စွန်းထင်းလွယ်သောchemicalပစ္စည်းများ၊ မူးယစ်ဆေးဝါးများ၊ တရားမဝင်ပစ္စည်းများ၊ သက်ရှိတိရစ္ဆာန်များ၊ ပန်းပင်များ၊ ပေါက်ကွဲလွယ်သောပစ္စည်းများ၊ ပုပ်သိုးလွယ်သော၊ အနံပြင်းသောအစားအသောက်များ
                        </div>
                    </div>
                </div>
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        <span>ဂိတ်တင် ဝန်ဆောင်မှုရှိပါသလား?</span> 
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            ဂိတ်တင် ဝန်ဆောင်မှုရှိပါသည်။ ဂိတ်တင် ဝန်ဆောင်ခ ၂၀၀၀(ကျပ်) သာ ဖြစ်ပါသည်။ (၅) ကီလိုဂရမ်ပစ္စည်းများအတွက်ဝန်ဆောင်ခသာဖြစ်ပါသည်။
                        </div>
                    </div>
                </div>
            </div>
            </div> 
        </div> 
    </div>
</section>


<?php require __DIR__. '/fragments/footer.php'?>