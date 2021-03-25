<div id="content-container">
    <div id="page-title">
        <center>
        	<h1 class="page-header text-overflow">
				<?php echo translate('vendor_commission')?>
            </h1>
        </center>
    </div>
    <div class="row">
    	<div class="col-md-12">
            <div class="col-md-12">
            	<div class="panel panel-bordered panel-dark">
                    <div class="panel-heading">
                        <center>
                            <h3 class="panel-title"><?php echo translate('vendor_commission')?>s</h3>
                        </center>
                    </div>
                    <div class="panel-body">  
						<?php
                            echo form_open(base_url() . 'admin/set_commission', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'enctype' => 'multipart/form-data'
                            ));
                        ?>                                  
                            <div class="form-group">
                            	<label class="col-sm-3 control-label"><?php echo translate('set_vendor_commission');?></label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <?php 
                                            $commission_amount = $this->db->get_where('business_settings', array('type' => 'commission_amount'))->row()->value;
                                            $vendor = $this->crud_model->select('vendor',array('status'=>'approved'));
                                        ?>     
                                        <select class="chosen-container chosen-container-single chosen-with-drop chosen-container-active" style="width: 152px;height: 30px;" name="vendorid" requird>
                                            <option selected="true" disabled="disabled">-- Select vendor --</option>
                                            <?php foreach ($vendor as $row)
                                             { ?>
                                                    <option value="<?php echo $row->vendor_id; ?>"><?php echo $row->display_name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="number" name="vendor_commission" class="form-control required">
                                        <div class="input-group-addon" requird>%</div>
                                    </div>
                                </div>
                                <div class="col-sm-3">  
                                	<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left saver" data-ing="<?php echo translate('saving'); ?>.."><?php echo translate('save');?></span>
                                </div>
                            </div>
                        </form>
                        <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" >
        <thead>
            <tr>
                
                <th>No</th>
                <th>Name</th>
                <th>Commissions</th>
            </tr>
        </thead>                
        <tbody >
             <?php
                $commission = $this->crud_model->selectjoin('business_settings',array('type'=>'commission_amount'));
                $defult = $this->crud_model->selectrow('business_settings',array('type'=>'commission_amount','vendorid'=>null));
                ?>
                <tr>
                    <td>1</td>
                    <td>defult</td>
                    <td><?php echo $defult->value;?></td>
                </tr>
                <?php
                if(!empty($commission))
                {
                    $i=2;
                foreach ($commission as $row) {
            ?>
        <tr>
            <td><?php echo $i; $i++;?></td>
            <td><?php echo $row->display_name;?></td>
            <td><?php echo $row->value;?></td>
        </tr>
        <?php } } ?>
        </tbody>
    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="panel-body" id="demo_s">
    
</div>


<style>
.bg-white{
	background:#ffffff !important;
	color:#000 !important;
}
</style>
<script>
$(document).ready(function(e) {
	$("body").on('click','.saver',function(){
		var here = $(this); // alert div for show alert message
		var text = here.html(); // alert div for show alert message
		var form = here.closest('form');
		var submitting = here.data('ing');
		//var form = $(this);
		var formdata = false;
		if (window.FormData){
			formdata = new FormData(form[0]);
		}
		$.ajax({
			url: form.attr('action'), // form action url
			type: 'POST', // form submit method get/post
			dataType: 'html', // request type html/json/xml
			data: formdata ? formdata : form.serialize(), // serialize form data 
			cache       : false,
			contentType : false,
			processData : false,
			beforeSend: function() {
				here.addClass('disabled');
				here.html(submitting); // change submit button text
			},
			success: function(data) {
				here.fadeIn();
				here.html(text);
				here.removeClass('disabled');
				var loc = location.href;
				location.replace(loc);
			},
			error: function(e) {
				console.log(e)
			}
		});
	});
});


$(document).ready(function(){

});
</script>
