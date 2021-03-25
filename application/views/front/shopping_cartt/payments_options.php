    <?php
    $user_id=$this->session->userdata('user_id');
        $system_title = $this->db->get_where('general_settings',array('type' => 'system_title'))->row()->value;
        $total = $this->cart->total();
        if ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'product_wise') {
            $shipping = $this->crud_model->cart_total_it('shipping');
        } elseif ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'fixed') {
            $shipping = $this->crud_model->get_type_name_by_id('business_settings', '2', 'value');
        }
        $tax = $this->crud_model->cart_total_it('tax');
        $grand = $total + $shipping + $tax;
        $exchange = exchange('usd');
        $final_amount = (int)$grand/$exchange;
    ?>
    <?php
        $p_set = $this->db->get_where('business_settings',array('type'=>'paypal_set'))->row()->value;
        $bitcoin_set = $this->db->get_where('business_settings',array('type'=>'bitcoin_set'))->row()->value;
        $razorpaykey = $this->db->get_where('business_settings',array('type'=>'razorpay'))->row()->value;
        $razorpaykeyapi = $this->db->get_where('business_settings',array('type'=>'razorpaykey'))->row()->value;
        $c_set = $this->db->get_where('business_settings',array('type'=>'cash_set'))->row()->value;
        $s_set = $this->db->get_where('business_settings',array('type'=>'stripe_set'))->row()->value;
        $c2_set = $this->db->get_where('business_settings',array('type'=>'c2_set'))->row()->value;
        $vp_set = $this->db->get_where('business_settings',array('type'=>'vp_set'))->row()->value;
        $pum_set = $this->db->get_where('business_settings',array('type'=>'pum_set'))->row()->value;
        $ssl_set = $this->db->get_where('business_settings',array('type'=>'ssl_set'))->row()->value;
        $balance = $this->wallet_model->user_balance();
        $productinfo = "nice";
$txnid = time();
$surl = site_url().'/home/success';
$furl = site_url().'/home/failed';        
$key_id = $razorpaykeyapi;
$currency_code = "INR";            
$total = ($final_amount* 100); 
$amount = $final_amount;
$merchant_order_id = $user_id;
$card_holder_name = 'TechArise Team';
$email = 'info@techarise.com';
$phone = '8168149353';
$name = APPLICATION_NAME;
$return_url = site_url().'/home/callback';
    ?>


<div class="row">
    <?php
        if($p_set == 'ok'){ ?>
            <div class="cc-selector col-sm-3">
                <input id="visa" type="radio" style="display:block;" checked name="payment_type" value="paypal"/>
                <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; " for="visa" onclick="radio_check('visa')">
                    <img src="<?php echo base_url(); ?>template/front/img/preview/payments/paypal.jpg" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('paypal');?>" />

                </label>
            </div>
    <?php }
    if($razorpaykey == 'ok'){
    ?>

    <form name="razorpay-form" id="razorpay-form" action="<?php echo site_url().'/home/callback' ?>" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
</form>
        <div class="cc-selector col-sm-3">
            
            <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; height: 130px; overflow:hidden; " onclick="razorpaySubmit(this);">
                <img src="<?php echo base_url(); ?>template/front/img/preview/payments/razor.png" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('razor');?>" />

            </label>
        </div>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var razorpay_options = {
    key: "<?php echo $key_id; ?>",
    amount: "<?php echo $total; ?>",
    name: "<?php echo $name; ?>",
    description: "Order # <?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "<?php echo $currency_code; ?>",
    prefill: {
      name:"<?php echo $card_holder_name; ?>",
      email: "<?php echo $email; ?>",
      contact: "<?php echo $phone; ?>"
    },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form').submit();
    },
    "modal": {
        "ondismiss": function(){
            location.reload()
        }
    }
  };
  var razorpay_submit_btn, razorpay_instance;

  function razorpaySubmit(el){
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }  
</script>
    <?php } if($s_set == 'ok'){
    ?>
        <div class="cc-selector col-sm-3">
            <input id="mastercardd" style="display:block;" type="radio" name="payment_type" value="stripe"/>
            <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; " for="mastercardd" id="customButtong" onclick="radio_check('mastercardd')">
                <img src="<?php echo base_url(); ?>template/front/img/preview/payments/stripe.jpg" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('stripe');?>" />

            </label>
        </div>
        <script>
            $(document).ready(function(e) {
                //<script src="https://js.stripe.com/v2/"><script>
                //https://checkout.stripe.com/checkout.js
                var handler = StripeCheckout.configure({
                    key: '<?php echo $this->db->get_where('business_settings' , array('type' => 'stripe_publishable'))->row()->value; ?>',
                    image: '<?php echo base_url(); ?>template/front/img/stripe.png',
                    token: function(token) {
                        // Use the token to create the charge with a server-side script.
                        // You can access the token ID with `token.id`
                        $('#cart_form').append("<input type='hidden' name='stripeToken' value='" + token.id + "' />");
                        if($( "#visa" ).length){
                            $( "#visa" ).prop( "checked", false );
                        }
                        if($( "#mastercard" ).length){
                            $( "#mastercard" ).prop( "checked", false );
                        }
                        $( "#mastercardd" ).prop( "checked", true );
                        notify('<?php echo translate('your_card_details_verified!'); ?>','success','bottom','right');
                        setTimeout(function(){
                            $('#cart_form').submit();
                        }, 500);
                    }
                });

                $('#customButtong').on('click', function(e) {
                    // Open Checkout with further options
                    var total = $('#grand').html();
                    total = total.replace("<?php echo currency(); ?>", '');
                    //total = parseFloat(total.replace(",", ''));
                    total = total/parseFloat(<?php echo exchange(); ?>);
                    total = total*100;
                    handler.open({
                        name: '<?php echo $system_title; ?>',
                        description: '<?php echo translate('pay_with_stripe'); ?>',
                        amount: total
                    });
                    e.preventDefault();
                });

                // Close Checkout on page navigation
                $(window).on('popstate', function() {
                    handler.close();
                });
            });
        </script>

    <?php } 

    if($bitcoin_set == 'ok') { ?>



        <div class="cc-selector col-sm-3">
            <input id="bitcoin" style="display:block;" type="radio" name="payment_type" value="bitcoin"/>
            <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; " for="bitcoin"  onclick="radio_check('bitcoin')">
                <img src="<?php echo base_url(); ?>template/front/img/preview/payments/bitcoin.png" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('bitcoin');?>" />
            </label>
        </div>
    <?php
        } if($c2_set == 'ok'){
            ?>
            <div class="cc-selector col-sm-3">
                <input id="mastercardc2" style="display:block;" type="radio" name="payment_type" value="c2"/>
                <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; " for="mastercardc2" onclick="radio_check('mastercardc2')">
                    <img src="<?php echo base_url(); ?>template/front/img/preview/payments/c2.jpg" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('cash_on_delivery');?>" />

                </label>
            </div>
    <?php }
        if($vp_set == 'ok'){
            ?>
            <div class="cc-selector col-sm-3">
                <input id="mastercardc3" style="display:block;" type="radio" name="payment_type" value="vp"/>
                <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; " for="mastercardc3" onclick="radio_check('mastercardc3')">
                    <img src="<?php echo base_url(); ?>template/front/img/preview/payments/vp.jpg" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('voguepay');?>" />

                </label>
            </div>
        <?php }
        if($pum_set == 'ok'){
            ?>
            <div class="cc-selector col-sm-3">
                <input id="mastercard_pum" style="display:block;" type="radio" name="payment_type" value="pum"/>
                <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; " for="mastercard_pum" onclick="radio_check('mastercard_pum')">
                    <img src="<?php echo base_url(); ?>template/front/img/preview/payments/pum.png" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('payumoney');?>" />

                </label>
            </div>
        <?php
        }
        /* if($ssl_set == 'ok'){
    ?>
    <div class="cc-selector col-sm-3">
        <input id="mastercardc4" style="display:block;" type="radio" name="payment_type" value="sslcommerz"/>
        <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; " for="mastercardc4" onclick="radio_check('mastercardc4')">
                <img src="<?php echo base_url(); ?>template/front/img/preview/payments/sslcommerz.jpg" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('sslcommerz');?>" />

        </label>
    </div>
    <?php
        } */
        if($c_set == 'ok'){
            if($this->crud_model->get_type_name_by_id('general_settings','68','value') == 'ok'){
                ?>
                <div class="cc-selector col-sm-3">
                    <input id="mastercard" style="display:block;" type="radio" name="payment_type" value="cash_on_delivery"/>
                    <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; " for="mastercard" onclick="radio_check('mastercard')">
                        <img src="<?php echo base_url(); ?>template/front/img/preview/payments/cash.jpg" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('cash_on_delivery');?>" />

                    </label>
                </div>
                <?php
                }
            }
    ?>
    <?php
        if ($this->crud_model->get_type_name_by_id('general_settings','84','value') == 'ok') {
            if ($this->session->userdata('user_login') == 'yes') { ?>
                <div class="cc-selector col-sm-3">
                    <input id="mastercarddd" style="display:block;" type="radio" name="payment_type" value="wallet"/>
                    <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; text-align:center;" for="mastercarddd" onclick="radio_check('mastercarddd')">
                        <img src="<?php echo base_url(); ?>template/front/img/preview/payments/wallet.jpg" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('wallet');  ?> : <?php echo currency($this->wallet_model->user_balance()); ?>" />
                        <span style="position: absolute;margin-top: -8%;margin-left: -26px;color: #000000;"><?php echo currency($this->wallet_model->user_balance()); ?></span>
                    </label>
                </div>
                <?php
            }
        }
    ?>
</div>

<style>
    .cc-selector input{
        margin:0;padding:0;
        -webkit-appearance:none;
           -moz-appearance:none;
                appearance:none;
    }

    .cc-selector input:active +.drinkcard-cc
    {
        opacity: 1;
        border:4px solid #169D4B;
    }
    .cc-selector input:checked +.drinkcard-cc{
        -webkit-filter: none;
        -moz-filter: none;
        filter: none;
        border:4px solid black;
    }
    .drinkcard-cc{
        cursor:pointer;
        background-size:contain;
        background-repeat:no-repeat;
        display:inline-block;
        -webkit-transition: all 100ms ease-in;
        -moz-transition: all 100ms ease-in;
        transition: all 100ms ease-in;
        -webkit-filter:opacity(.5);
        -moz-filter:opacity(.5);
        filter:opacity(.5);
        transition: all .6s ease-in-out;
        border:4px solid transparent;
        border-radius:5px !important;
    }
    .drinkcard-cc:hover{
    -webkit-filter:opacity(1);
    -moz-filter: opacity(1);
    filter:opacity(1);
    transition: all .6s ease-in-out;
    border:4px solid #8400C5;

}
</style>
