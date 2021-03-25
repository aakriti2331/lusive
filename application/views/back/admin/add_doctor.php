<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('add_vendor');?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="col-md-12" >
                        
                        
                    </div>
                    <!-- LIST -->
                    <div class="tab-pane fade active in" >
                        <?php
                    echo form_open(base_url() . 'admin/vendor_add/add_info/', array(
                        'class' => 'form-login',
                        'method' => 'post',
                        'id' => 'sign_form'
                    ));
                ?>
                    <div class="row box_shape">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="name" type="text" placeholder="<?php echo translate('name');?>" data-toggle="tooltip" title="<?php echo translate('name');?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="display_name" type="text" placeholder="<?php echo translate('display_name');?>" data-toggle="tooltip" title="<?php echo translate('display_name');?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                        
                            <div class="form-group">
                            <label for="profile_image">Upload profile Image:</label>
                                <input class="form-control" name="profile_image" type="file" placeholder="<?php echo translate('profile_image');?>" data-toggle="tooltip" title="<?php echo translate('profile_image');?>">
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="phone" type="text" placeholder="<?php echo translate('phone');?>" data-toggle="tooltip" title="<?php echo translate('phone');?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control emails required" name="email" type="email" placeholder="<?php echo translate('email');?>" data-toggle="tooltip" title="<?php echo translate('email');?>" required>
                            </div>
                            <div id='email_note'></div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control pass1 required" type="password" name="password1" placeholder="<?php echo translate('password');?>" data-toggle="tooltip" title="<?php echo translate('password');?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control pass2 required" type="password" name="password2" placeholder="<?php echo translate('confirm_password');?>" data-toggle="tooltip" title="<?php echo translate('confirm_password');?>" required>
                            </div>
                            <div id='pass_note'></div> 
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" name="company" type="text" placeholder="<?php echo translate('company');?>" data-toggle="tooltip" title="<?php echo translate('company');?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" name="gstno" type="text" placeholder="<?php echo translate('gstno');?>" data-toggle="tooltip" title="<?php echo translate('gstno');?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" name="licence" type="text" placeholder="<?php echo translate('licence');?>" data-toggle="tooltip" title="<?php echo translate('licence');?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="aadhar_image">Upload Aadhar Card Image:</label>
                                <input class="form-control" name="adharimg" type="file" placeholder="<?php echo translate('adharimg');?>" data-toggle="tooltip" title="<?php echo translate('adharimg');?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="pancard_image">Upload PanCard Image:</label>
                                <input class="form-control" name="pancardimg" type="file" placeholder="<?php echo translate('pancardimg');?>" data-toggle="tooltip" title="<?php echo translate('pancardimg');?>">
                            </div>
                        </div>
                       
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control required" name="address1" type="text" placeholder="<?php echo translate('address_line_1');?>" data-toggle="tooltip" title="<?php echo translate('address_line_1');?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control required" name="address2" type="text" placeholder="<?php echo translate('address_line_2');?>" data-toggle="tooltip" title="<?php echo translate('address_line_2');?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="city" type="text" placeholder="<?php echo translate('city');?>" data-toggle="tooltip" title="<?php echo translate('city');?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="state" type="text" placeholder="<?php echo translate('state');?>" data-toggle="tooltip" title="<?php echo translate('state');?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="country" type="text" placeholder="<?php echo translate('country');?>" data-toggle="tooltip" title="<?php echo translate('country');?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="zip" type="text" placeholder="<?php echo translate('zip');?>" data-toggle="tooltip" title="<?php echo translate('zip');?>">
                            </div>
                        </div>
                       
                        <div class="col-md-12">
                            <button class="btn btn-primary" style="min-width:110px" ><span class="btn btn-theme-sm btn-block btn-theme-dark pull-right logup_btn" data-ing='<?php echo translate('registering..'); ?>' data-msg="">
                                <?php echo translate('add');?>
                            </span></button>
                        </div>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<span id="prod" style="display:none;"></span>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var timer = '<?php $this->benchmark->mark_time(); ?>';
    var user_type = 'admin';
    var module = 'product';
    var list_cont_func = 'list';
    var dlt_cont_func = 'delete';
    
    
</script>

