<style>
body {
	padding: 40px;
}
.columns {
	text-align: center;
}
.column {
	box-shadow: inset 0 0 0 2px #202c50;
	border-radius: 8px;
	display: inline-block;
	padding: 50px;
	width: 60%;
	color: #202c50;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	line-height: 1.4em;
}
.divider {
	width: 40%;
	height: 2px;
	margin-left: auto;
	margin-right: auto;
	background-color: #202c50;
	border: 0 none;
	margin-top: 14px;
	margin-bottom: 40px;
}
.success-extras p {
	color: #202c50;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 2em;
	font-weight: 300;
	padding: 0 0 20px 0;
	line-height: 1.2em;
}
p.success-lrg {
	font-size: 2.4em;
}
.fa-check-circle {
	color: #202c50;
	font-size: 6em;
	margin: 0 0 30px 0;
}
.action.primary {
	background: #202c50;
	border: none;
	color: #fff;
	display: inline-block;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-weight: 300;
	font-size: 1.4rem;
	box-sizing: border-box;
	vertical-align: middle;
	padding: 20px 20px;
	margin: 20px 0 0 0;
	text-decoration: none;
}
.action.primary:hover {
	background: #2e3f73;
}
@media screen and (max-width: 600px) { 
		.column{
			width: 80%;
		}
	}
</style>

<?php
	include_once('../../database/db.class.php');
	session_start();

	$username = "";
	$infoUser;
	if(isset($_SESSION['user']) != ""){
		$username = $_SESSION['user'];
		$user      = mysqli_query($con,"SELECT * FROM tbl_khachhang WHERE email= '$username' ");
		$infoUser  = mysqli_fetch_array($user);
	}

	$total_money = 0;
	if(isset( $_SESSION["cart_items"]) && count($_SESSION["cart_items"]) > 0 ){
		foreach($_SESSION["cart_items"] as $item){
			$id           = $item["pro_id"];
			$product      = mysqli_query($con,"SELECT * FROM tbl_sanpham WHERE sanpham_id= '$id' ");
			$prod         = mysqli_fetch_array($product);
			$totalPrice   = $item["quantity"] * $prod["sanpham_gia"];
			// $prod         = reset($product);
			$total_money  += $item["quantity"] * $prod["sanpham_gia"];
			$order        = mysqli_query($con,"INSERT INTO tbl_donhang (sanpham_id, soluong, khachhang_id) 
										VALUES ('".$id."','".$item["quantity"]."','".$infoUser["khachhang_id"]."')");
		}
?>
	

<div class="columns">
	<div class="column main"><input name="form_key" type="hidden" value="PefvQbePmuX6e2ZN">
		<div id="authenticationPopup" data-bind="scope:'authenticationPopup'">
			<div class="success-extras">
				<i class="far fa-check-circle"></i>
				<p>Thanks for your order!</p>
				<p class="success-lrg">
					Sit back, relax or even better...go for a run! We'll take care of the rest.
				</p>
				<hr class="divider">
			</div>
		</div>
		<div class="checkout-success">
			<p>Your order # is: <span>000166954</span>.</p>
			<p>We'll email you an order confirmation with details and tracking info.</p>
			<div class="actions-toolbar">
				<div class="primary">
					<a class="action primary continue" href="/ecommerce-php/views/page/index.php">Continue Shopping</a>
				</div>
			</div>
		</div>
		<!-- <div id="registration" data-bind="scope:'registration'">
			<br>
			<div data-role="checkout-messages" class="messages" data-bind="visible: isVisible(), click: removeAll"></div>
			<div>
				<p data-bind="i18n: 'You can track your order status by creating an account.'">You can track your order status by creating an account.</p>
				<p><span data-bind="i18n: 'Email Address'">Email Address</span>: <span data-bind="text: getEmailAddress()">test@test.co</span></p>
				<form method="get" data-bind="attr: { action: getUrl() }" action="https://run4it-225.thesixbysix.co.uk/checkout/account/delegateCreate/">
					<input type="submit" class="action primary" data-bind="value: $t('Create an Account')" value="Create an Account">
				</form>
			</div>
		</div> -->
	</div>
</div>
<?php
}

?>