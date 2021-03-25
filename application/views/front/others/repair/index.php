<!-- PAGE -->
<?php 
    $contact_address =  $this->db->get_where('general_settings',array('type' => 'contact_address'))->row()->value;
    $contact_phone =  $this->db->get_where('general_settings',array('type' => 'contact_phone'))->row()->value;
    $contact_email =  $this->db->get_where('general_settings',array('type' => 'contact_email'))->row()->value;
    $contact_website =  $this->db->get_where('general_settings',array('type' => 'contact_website'))->row()->value;
    $contact_about =  $this->db->get_where('general_settings',array('type' => 'contact_about'))->row()->value;
?>
<section class="rep-banner">
<div class="container">
<div class="row">
<div class="col-md-7 col-sm-7 col-12">
<div class="rep-img">
<img src="<?php echo base_url(); ?>assets/images/repair-banner.png" alt="">
</div>
</div>
<div class="col-md-5 col-sm-5 col-12">
    <?php if($this->session->flashdata('message')){?>
  <div class="alert alert-success">

    <?php echo $this->session->flashdata('message')?>
  </div>
<?php } ?>
<div class="right-form bg-white p-4 shadow mt-5 pt-5 contact-fom">
<form method="post" action="<?php echo base_url().'home/add_repair';?>">
<h3>Book a Repair</h3>

    <div class="form-group">
<input type="text" name="firstname" id="name" class="form-control" placeholder="Name">
<?php echo form_error('firstname'); ?>
</div>

<div class="form-group">
<input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile">
<?php echo form_error('mobile'); ?>
</div>

<div class="form-group select">
    
<select class="form-control" id="categoryid" name="category_name">
    <option selected="true" disabled="disabled">-Select Device Type-</option>
    <?php 
    if(!empty($category))
    {
        foreach ($category as $row)
        {
        ?>
            
            <option value="<?php echo $row->category_id;?>"><?php echo $row->category_name;?></option>
<?php } } ?>
</select>
<?php echo form_error('category_name'); ?>
<span class="down-arrow black-i"><i class="fas fa-sort-down"></i></span>


</div>

<div class="form-group select">
<select class="form-control" name="brand" id="brand">
<option selected="true" disabled="disabled">-Select Brand-</option>
</select>
<?php echo form_error('brand'); ?>
<span class="down-arrow black-i"><i class="fas fa-sort-down"></i></span>
</div>

<div class="form-group select">
<select class="form-control" id="modal" name="modal">
<option value="select Modal">-Select Modal-</option>
</select>
<?php echo form_error('modal'); ?>
<span class="down-arrow black-i"><i class="fas fa-sort-down"></i></span>
</div>

<div class="form-group select" id="location">
<input type="text" name="location" id="location" class="form-control" placeholder="Location">
<?php echo form_error('location'); ?>
</div>

<div class="submit">
<input type="submit" value="submit">
</div>

</form>
</div>
</div>
</div>
</div>
</section>

<section class="we-fix mt-5">
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-12">
<div class="fix p-4 bg-white">
<h4>We fix your mobile at your convenience</h4>
<p class="text-grey">V2C Repair is a progressive help intended to improve portable fixes without making them excessively hard on your wallet. Locate the portable that requirements to get fixed, select its shading, and that is it. You will be given our scope of administrations to look over, as - mobile screen, mic, battery, speaker, receiver, charging jack replacement of the most ideal statement for your cell phone fix.</p> 

<p class="text-grey">V2C Repair even offers a 6-month guarantee and seven days in length unconditional promise. Would it be able to show signs of improvement than this?</p>
</div>
</div>
</div>
</div>
</section>

<section class="whyus mt-5">
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-12">
<div class="why">
<h2>Why Us</h2>
</div>
</div>
</div>

<div class="row mt-2">
<div class="col-md-6 col-sm-6 col-12">
<div class="premium bg-white p-3">
<div class="part-content">
<div class="part">
<img src="<?php echo base_url(); ?>assets/images/icon/star.png" alt="">
</div>
<div class="p-content">
<h3>Premium Parts</h3>
<p class="text-grey">V2C Repair is a progressive help intended to improve portable.</p>
</div>

</div>
</div>
</div>

<div class="col-md-6 col-sm-6 col-12">
<div class="premium bg-white p-3">
<div class="part-content">
<div class="part">
<img src="<?php echo base_url(); ?>assets/images/icon/tag.png" alt="">
</div>
<div class="p-content">
<h3>Unbeatable Prices</h3>
<p class="text-grey">V2C Repair is a progressive help intended to improve portable fixes .</p>
</div>

</div>
</div>
</div>
</div>


<div class="row mt-4">
<div class="col-md-6 col-sm-6 col-12">
<div class="premium bg-white p-3">
<div class="part-content">
<div class="part">
<img src="<?php echo base_url(); ?>assets/images/icon/user.png" alt="">
</div>
<div class="p-content">
<h3>Expert Technicians</h3>
<p class="text-grey">V2C Repair is a progressive help intended to improve portable.</p>
</div>

</div>
</div>
</div>

<div class="col-md-6 col-sm-6 col-12">
<div class="premium bg-white p-3">
<div class="part-content">
<div class="part">
<img src="<?php echo base_url(); ?>assets/images/icon/mobile.png" alt="">
</div>
<div class="p-content">
<h3>Guaranteed Safety</h3>
<p class="text-grey">V2C Repair is a progressive help intended to improve portable fixes .</p>
</div>

</div>
</div>
</div>
</div>
</div>
</section>

<section class="mt-4">
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-12">
<div class="why">
<h2>Top Brands</h2>
</div>
</div>
</div>

<div class="row mt-3">
<div class="col-md-12 col-sm-12 col-12">
<div class="owl-carousel owl-theme bg-white" id="brand-owl1">
<div class="item">
<div class="brand-logo">
<img src="<?php echo base_url(); ?>assets/images/icon/logo/apple.png" alt="">
</div>
</div>

<div class="item">
<div class="brand-logo">
<img src="<?php echo base_url(); ?>assets/images/icon/logo/google.png" alt="">
</div>
</div>

<div class="item">
<div class="brand-logo">
<img src="<?php echo base_url(); ?>assets/images/icon/logo/lenovo.png" alt="">
</div>
</div>

<div class="item">
<div class="brand-logo">
<img src="<?php echo base_url(); ?>assets/images/icon/logo/moto.png" alt="">
</div>
</div>

<div class="item">
<div class="brand-logo">
<img src="<?php echo base_url(); ?>assets/images/icon/logo/oppo.png" alt="">
</div>
</div>

<div class="item">
<div class="brand-logo">
<img src="<?php echo base_url(); ?>assets/images/icon/logo/samsung.png" alt="">
</div>
</div>

</div>
</div>
</div>

<div class="row mt-5">
<div class="col-md-12 col-sm-12 col-12">
<div class="why">
<h2>Our Happy Customer</h2>
</div>
</div>
</div>

<div class="row mt-3">
<div class="owl-carousel owl-theme" id="customer-owl2">
<div class="item">
<div class="happy-c bg-white p-3">
<h4>Customer Name</h4>
<h5>Exellent Services</h5>
<div class="pri_star">
<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i>
</div>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
</div>
</div>

<div class="item">
<div class="happy-c bg-white p-3">
<h4>Customer Name</h4>
<h5>Exellent Services</h5>
<div class="pri_star">
<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i>
</div>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
</div>
</div>

<div class="item">
<div class="happy-c bg-white p-3">
<h4>Customer Name</h4>
<h5>Exellent Services</h5>
<div class="pri_star">
<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i>
</div>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
</div>
</div>

<div class="item">
<div class="happy-c bg-white p-3">
<h4>Customer Name</h4>
<h5>Exellent Services</h5>
<div class="pri_star">
<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i>
</div>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
</div>
</div>

<div class="item">
<div class="happy-c bg-white p-3">
<h4>Customer Name</h4>
<h5>Exellent Services</h5>
<div class="pri_star">
<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i>
</div>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
</div>
</div>
</div>
</div>

</div>
</section>
<!-- /PAGE -->
<script>
    $("body").on('change','.email',function(){
        var value=$(this).val();
        var here=$(this);
        var txt='<?php echo translate('enter_valid_email_address')?>';
        if(isValidEmailAddress(value) !== true){
            here.css({borderColor: 'red'});
            here.closest('div').find('.require_alert').remove();
            here.closest('.form-group').append(''
                +'  <span id="" class="require_alert" >'
                +'      '+txt
                +'  </span>'
            );
        } else{
        }
    });
     $('#contact-form').on('click','.submitter12', function(){
        var herea = $(this); // alert div for show alert message
        var form = herea.closest('form');
        var ing = herea.data('ing');
        var msg = herea.data('msg');
        var prv = herea.html();
        var sent = '<?php echo translate('message_sent_successfully')?>';
        var can = '';
        var captcha_incorrect = '<?php echo translate('please_fill_the_captcha'); ?>'
        var incorrect = '<?php echo translate('incorrect_information').'. '.translate('check_again').'!';?>'
        var l = '';
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
        var email=$('.email').val();
        if(isValidEmailAddress(email)==true){
            can ='yes';
        }else{
            can ='no';
        }
        $('#contact-form .test').each(function() {
            var it=$(this);
            if(it.val()==''){
                it.css({borderColor: 'red'});
                it.closest('div').find('.require_alert').remove();
                it.closest('.form-group').append(''
                    +'  <span id="" class="require_alert" >'
                    +'      <?php echo translate('this_field_is_required!')?>'
                    +'  </span>'
                );
                can ='no';
            }
        });
        
        if(can !== 'no'){
            $.ajax({
                url: form.attr('action'), // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                data: formdata ? formdata : form.serialize(), // serialize form data 
                cache       : false,
                contentType : false,
                processData : false,
                beforeSend: function() {
                    herea.html(ing); // change submit button text
                },
                success: function(data) {
                    herea.fadeIn();
                    herea.html(prv);
                    if(data == 'sent'){
                        //sound('message_sent');
                        notify(sent,'success','bottom','right');
                        setTimeout(
                            function() {
                                location.replace("<?php echo base_url(); ?>home/contact");
                            }, 2000
                        );
                    } else if (data == 'captcha_incorrect'){
                        //sound('captcha_incorrect');
                        $('#recaptcha_reload_btn').click();
                        notify(captcha_incorrect,'warning','bottom','right');
                        
                    }else {
                        notify(data,'warning','bottom','right');
                    }
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }else{
            notify(incorrect,'warning','bottom','right');
        }
    });
    
    $("#contact-form").on('change','.test',function(){
        var here = $(this);
        here.css({borderColor: '#dcdcdc'});
        
        if (here.attr('type') == 'email'){
            if(isValidEmailAddress(here.val())){
                here.closest('div').find('.require_alert').remove();
            }
        } else {
            here.closest('div').find('.require_alert').remove();
        }
        if(here.is('select')){
            here.closest('div').find('.chosen-single').css({borderColor: '#dcdcdc'});
        }
    });
    
    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    };
</script>