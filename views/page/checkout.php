<?php
    include_once('../partials/header.php');
    include_once('../../database/db.class.php');
?>

<section class="sub-bnr" data-stellar-background-ratio="0.5" style="background-position: 0% -69px;">
    <div class="position-center-center">
      <div class="container">
        <h4>Thanh toán</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus maximus vehicula. 
          Sed feugiat, tellus vel tristique posuere, diam</p>
        <ol class="breadcrumb">
          <li><a href="#">Trang chủ</a></li>
          <li><a href="#">SHOP</a></li>
          <li class="active">Thanh toán</li>
        </ol>
      </div>
    </div>
</section>

<div id="content"> 
    
    <!--======= PAGES INNER =========-->
    <section class="chart-page padding-top-100 padding-bottom-100">
      <div class="container"> 
        
        <!-- Payments Steps -->
        <div class="shopping-cart"> 
          
          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info">
            <div class="row"> 
              
              <!-- ESTIMATE SHIPPING & TAX -->
              <div class="col-sm-7">
                <h6>Chi tiết hóa đơn</h6>
                <?php
                    $username = "";
                    $infoUser;
                    if(isset($_SESSION['user']) != ""){
                        $username = $_SESSION['user'];
                        $user      = mysqli_query($con,"SELECT * FROM tbl_khachhang WHERE email= '$username' ");
                        $infoUser  = mysqli_fetch_array($user);
                    }
                ?>
                <form method="POST" enctype="multipart/form-data" >
                  <ul class="row">
                    
                    <!-- Name -->
                    <li class="col-md-6">
                      <label> *Email
                        <input type="text" value="<?php echo $infoUser['name']; ?>" name="first-name" value="" placeholder="">
                      </label>
                    </li>
                    <!-- LAST NAME -->
                    <li class="col-md-6">
                      <label> *SĐT
                        <input type="text" value="<?php echo $infoUser['phone']; ?>" name="last-name" value="" placeholder="">
                      </label>
                    </li>
                    <li class="col-md-6"> 
                      <!-- COMPANY NAME -->
                      <label> *Địa chỉ
                        <input type="text" value="<?php echo $infoUser['address']; ?>"  name="company" value="" placeholder="">
                      </label>
                    </li>
                    <!-- <li class="col-md-6"> 
                      <label>*ADDRESS
                        <input type="text" name="address" value="" placeholder="">
                      </label>
                    </li>
                    <li class="col-md-6">
                      <label>*TOWN/CITY
                        <input type="text" name="town" value="" placeholder="">
                      </label>
                    </li>
                    
                    <li class="col-md-6">
                      <label> COUNTRY
                        <input type="text" name="contry-state" value="" placeholder="">
                      </label>
                    </li>
                    
                    <li class="col-md-6">
                      <label> *EMAIL ADDRESS
                        <input type="text" name="contry-state" value="" placeholder="">
                      </label>
                    </li>
                    <li class="col-md-6">
                      <label> *PHONE
                        <input type="text" name="postal-code" value="" placeholder="">
                      </label>
                    </li>
                    
                    <li class="col-md-6">
                      <button type="submit" class="btn">continue</button>
                    </li>
                    
                    <li class="col-md-6">
                      <div class="checkbox margin-0 margin-top-20">
                        <input id="checkbox1" class="styled" type="checkbox">
                        <label for="checkbox1"> Ship to a different address </label>
                      </div>
                    </li> -->
                  </ul>
                </form>
                
                <!-- SHIPPING info -->
                <!-- <h6 class="margin-top-50">SHIPPING info</h6>
                <form>
                  <ul class="row">
                    
                    <li class="col-md-6">
                      <label> *FIRST NAME
                        <input type="text" name="first-name" value="" placeholder="">
                      </label>
                    </li>
                    <li class="col-md-6">
                      <label> *LAST NAME
                        <input type="text" name="last-name" value="" placeholder="">
                      </label>
                    </li>
                    <li class="col-md-6"> 
                      <label>COMPANY NAME
                        <input type="text" name="company" value="" placeholder="">
                      </label>
                    </li>
                    <li class="col-md-6"> 
                      <label>*ADDRESS
                        <input type="text" name="address" value="" placeholder="">
                      </label>
                    </li>
                    <li class="col-md-6">
                      <label>*TOWN/CITY
                        <input type="text" name="town" value="" placeholder="">
                      </label>
                    </li>
                    
                    <li class="col-md-6">
                      <label> COUNTRY
                        <input type="text" name="contry-state" value="" placeholder="">
                      </label>
                    </li>
                    
                    <li class="col-md-6">
                      <label> *EMAIL ADDRESS
                        <input type="text" name="contry-state" value="" placeholder="">
                      </label>
                    </li>
                    <li class="col-md-6">
                      <label> *PHONE
                        <input type="text" name="postal-code" value="" placeholder="">
                      </label>
                    </li>
                    
                    <li class="col-md-6">
                      <button type="submit" class="btn">SUBMIT</button>
                    </li>
                  </ul>
                </form> -->
              </div>
              
              <!-- SUB TOTAL -->
              <div class="col-sm-5">
                <h6>Đơn hàng của bạn</h6>
                <div class="order-place">
                  <div class="order-detail">
                  <?php
                        $total_money = 0;
                        if(isset( $_SESSION["cart_items"]) && count($_SESSION["cart_items"]) > 0 ){
                            foreach($_SESSION["cart_items"] as $item){
                                $id           = $item["pro_id"];
                                $product      = mysqli_query($con,"SELECT * FROM tbl_sanpham WHERE sanpham_id= '$id' ");
                                $prod         = mysqli_fetch_array($product);
                                $totalPrice   = $item["quantity"] * $prod["sanpham_gia"];
                                // $prod         = reset($product);
                                $total_money  += $item["quantity"] * $prod["sanpham_gia"];
                    ?>
                    <p><?php echo $prod["sanpham_name"];?> (<?php echo $item["quantity"];?>) <span><?php echo $totalPrice; ?> VND </span></p>
                    <?php
                            }
                        }else{
                            echo "Không có sản phẩm nào trong giỏ hàng";
                        }
                    ?>
                    
                    <!-- SUB TOTAL -->
                    <p class="all-total">Tổng <span> <?php echo $total_money; ?> VND</span></p>
                  </div>
                  <div class="pay-meth">
                    <ul>
                      <li>
                        <div class="radio">
                          <input type="radio" name="radio1" id="radio1" value="option1" checked="">
                          <label for="radio1"> Chuyển tiền qua ngân hàng </label>
                        </div>
                      </li>
                      <!-- <li>
                        <div class="radio">
                          <input type="radio" name="radio1" id="radio2" value="option2">
                          <label for="radio2"> CASH ON DELIVERY</label>
                        </div>
                      </li>
                      <li>
                        <div class="radio">
                          <input type="radio" name="radio1" id="radio3" value="option3">
                          <label for="radio3"> CHEQUE PAYMENT </label>
                        </div>
                      </li>
                      <li>
                        <div class="radio">
                          <input type="radio" name="radio1" id="radio4" value="option4">
                          <label for="radio4"> PAYPAL </label>
                        </div>
                      </li> -->
                      <li>
                        <div class="checkbox">
                          <input id="checkbox3-4" class="styled" type="checkbox">
                          <label for="checkbox3-4"> Tôi đã đọc và chấp nhận <span class="color"> Điều kiện &amp; Điều khoản </span> </label>
                        </div>
                      </li>
                    </ul>
                    <a class="btn  btn-dark pull-right margin-top-30 btnOrder">Đặt hàng</a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- About -->
    <section class="small-about padding-top-150 padding-bottom-150">
      <div class="container"> 
        
        <!-- Main Heading -->
        <div class="heading text-center">
          <h4>Thông tin về XTSPORTS</h4>
          <p>Cửa hàng cung cấp đồ thể thao lớn nhất Sài Gòn </p>
        </div>
        
        <!-- Social Icons -->
        <ul class="social_icons">
          <li><a href="#."><i class="icon-social-facebook"></i></a></li>
          <li><a href="#."><i class="icon-social-twitter"></i></a></li>
          <li><a href="#."><i class="icon-social-tumblr"></i></a></li>
          <li><a href="#."><i class="icon-social-youtube"></i></a></li>
          <li><a href="#."><i class="icon-social-dribbble"></i></a></li>
        </ul>
      </div>
    </section>
    
    <!-- News Letter -->
    <section class="news-letter padding-top-150 padding-bottom-150">
      <div class="container">
        <div class="heading light-head text-center margin-bottom-30">
          <h4>NEWSLETTER</h4>
          <span>Phasellus lacinia fermentum bibendum. Interdum et malesuada fames ac ante ipsumien lacus, eu posuere odi </span> </div>
        <form>
          <input type="email" placeholder="Enter your email address" required="">
          <button type="submit">SEND ME</button>
        </form>
      </div>
    </section>
</div>

<?php
    include_once('../partials/footer.php');
?>
<script>

    $(document).on("click", ".btnOrder", function(){
      toastr.success("Thanh toán thành công", "Thông Báo")
      setTimeout(() => {
       window.location.href = "/ecommerce-php/views/page/checkout-success.php"
      }, 2000);
    })

</script>