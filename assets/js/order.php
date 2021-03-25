<?php include'include/header.php'; ?>
<section class="pt-5 back-g pb-5">
<div class="container">
<div class="row">
<div class="col-md-4 col-sm-4 col-12">
<div class="wishes p-4 bg-white">
<div class="u_im">
<div class="user_img">
<img src="images/circle.png" alt="user">
</div>
<div class="hi">
<p>Hi</p>
<p><b>Karan Bajwa</b></p>
</div>
</div>
<hr class="pt-2 pb-2">


<ul class="vendor-sidebar">
<li><a href="dashboard.php"><i class="fas fa-border-all"></i>&nbsp; Dashboard</a></li>
<li><a href="vendor-account.php" > <i class="far fa-id-badge"></i>&nbsp; Profile Information</a></li>
<li><a href="vendor-password.php"><i class="fas fa-lock"></i>&nbsp; Change Password</a></li>

<li><a href="vendor-items.php"> <i class="fas fa-list-alt"></i>&nbsp; Items( Products )</a></li>
<li><a href="order.php" ><i class="fas fa-heart"></i>&nbsp; Orders </a></li>
<li><a href="shipping.php"><i class="fas fa-truck-moving"></i>&nbsp; Shipping</a></li>
<li><a href="javascript:void(0);"><i class="fas fa-shopping-bag"></i>&nbsp; Offers</a></li>
<li><a href="payment.php" class="active"><i class="far fa-credit-card"></i>&nbsp; Payments</a></li>
<li><a href="javascript:void(0);"><i class="fas fa-sign-out-alt"></i>&nbsp; Logout</a></li>
</ul>

</div>
</div>

<div class="col-md-8 col-sm-8 col-12 bg-white">
<div class="order-manage bg-white p-3">
<h3>Order Management</h3>
</div>
<div class="bg-greys">
<div class="orerss">
<div class="chiller_cb">
<input id="order" type="checkbox">
<label for="order">45 Order</label>
<span></span>
</div>
</div>

<div class="filt-pro">
<div class="filltr">
<div class="filterby">
<a href="#"><img src="img/filter.png" alt=""> <span>Flter By</span></a>
</div>

<div class="filterby">
<a href="#"><img src="img/sort.png" alt=""> <span>Sort By</span></a>
</div>
</div>
</div>
</div>

<!-- 1st sec stat here -->


<div class="ord-check">
<div class="chiller">
<input type="checkbox" id="ord" name="ord">
</div>
<div class="order-name">
<h3>Order Id : 20200621232145</h3>
<p>21 June 2020, 04:36 PM</p>
</div>

<div class="order-date">
<h4>Expected Shipping : 26 June 2020</h4>
<h5>Buyer : <span>Customer Name,</span></h5>	
</div>
</div>

<div class="samsung-aura">
<div class="noteten">
<img src="img/note10.jpg" alt="note10">
<h3>Samsung Galaxy Note10 Lite<br>
(Aura Black, 128 GB)  (8 GB RAM)</h3>


</div>
<div class="note-price">
<h4>Price: $585</h4>
</div>
</div>
<div class="product-type">
<div class="p-type">
<h5>Product ID: V2C0061620121</h5>
</div>
<div class="p-quantity">
<h5>Quantity:1</h5>
</div>
</div>

<div class="shipss-ad">
<div class="ships-cont">
<h5>Shipping Address</h5>
<p>Akshya Nagar 1st Block 1st Cross,
Rammurthy nagar, Bangalore-560016</p>
</div>
<div class="ships-cont">
<h5>Additional Details</h5>
<p>Storage : 64 gb / 4gb
Color : Aura Black</p>
</div>
</div>

<div class="payment-method">
<div class="pay-fifty">
<p><img src="img/tick.png" alt="tick">Payment Method : Net Banking</p>
</div>
<div class="payment-fifty">
<button type="button" id="print"> Print Packing Slip</button>
<button type="button" id="cancel"> Cancel Order</button>
</div>
</div>
<!-- 1st sec end here -->
<hr>


<!-- 1st sec stat here -->


<div class="ord-check">
<div class="chiller">
<input type="checkbox" id="ord" name="ord">
</div>
<div class="order-name">
<h3>Order Id : 20200621232145</h3>
<p>21 June 2020, 04:36 PM</p>
</div>

<div class="order-date">
<h4>Expected Shipping : 26 June 2020</h4>
<h5>Buyer : <span>Customer Name,</span></h5>	
</div>
</div>

<div class="samsung-aura">
<div class="noteten">
<img src="img/note10.jpg" alt="note10">
<h3>Samsung Galaxy Note10 Lite<br>
(Aura Black, 128 GB)  (8 GB RAM)</h3>


</div>
<div class="note-price">
<h4>Price: $585</h4>
</div>
</div>
<div class="product-type">
<div class="p-type">
<h5>Product ID: V2C0061620121</h5>
</div>
<div class="p-quantity">
<h5>Quantity:1</h5>
</div>
</div>

<div class="shipss-ad">
<div class="ships-cont">
<h5>Shipping Address</h5>
<p>Akshya Nagar 1st Block 1st Cross,
Rammurthy nagar, Bangalore-560016</p>
</div>
<div class="ships-cont">
<h5>Additional Details</h5>
<p>Storage : 64 gb / 4gb
Color : Aura Black</p>
</div>
</div>

<div class="payment-method">
<div class="pay-fifty">
<p><img src="img/tick.png" alt="tick">Payment Method : Net Banking</p>
</div>
<div class="payment-fifty">
<button type="button" id="print"> Print Packing Slip</button>
<button type="button" id="cancel"> Cancel Order</button>
</div>
</div>
<!-- 1st sec end here -->
<hr>
</div>




</div>
</div>
</section>


<script>
CKEDITOR.replace( 'editor1' );
</script>

<?php include'include/footer.php'; ?>
