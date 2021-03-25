<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow"><?php echo translate('manage_vendors');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="col-md-12">
						<?php if($this->session->flashdata('message')){?>
  <div class="alert alert-success" id="mydivs" style="width:250px;">

    <?php echo $this->session->flashdata('message')?>
  </div>
<?php } ?>
						<button class="btn btn-primary btn-labeled fa fa-plus-circle pull-right"><a href="<?php echo base_url(); ?>admin/add_vendor">
                                <span class="menu-title">
                                        <?php echo translate('add_vendor');?>
                                    </span>
                            </a></button>
					</div>
					<br>
                    <!-- LIST -->
                    <div class="tab-pane fade active in" id="list" style="border:1px solid #ebebeb; border-radius:4px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'admin';
	var module = 'vendor';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';

	
        setTimeout(function() {
            $('#mydivs').hide('fast');
        }, 5000);
    
</script>
<script src="https://checkout.stripe.com/checkout.js"></script>
