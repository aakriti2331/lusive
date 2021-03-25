<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('manage_product_(_physical_)');?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding: 5px;">
                        <button class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right"
                                onclick="ajax_set_full('add','<?php echo translate('add_product'); ?>','<?php echo translate('successfully_added!'); ?>','product_add',''); proceed('to_list');"><?php echo translate('create_product');?>
                        </button>
                        <button class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn"
                                style="display:none;"  onclick="ajax_set_list();  proceed('to_add');"><?php echo translate('back_to_product_list');?>
                        </button>
                    </div>
                    <!-- LIST -->
                    <div class="tab-pane fade active in" id="list" style="border:1px solid #ebebeb; border-radius:4px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="mod"></div>
<div id="mynewModal" class="modal fade" role="dialog">
               <div class="modal-dialog">
               <form name="regfrm" method="post" action="<?php echo base_url(); ?>admin/rejext_product">
               <input type="hidden" name="new_pro_id" id="new_pro_id" value="">
                 <!-- Modal content-->
                 <div class="modal-content">
                   <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Rejection Reason</h4>
                   </div>
                   <div class="modal-body">
                   <label>Rejection Reason</label>
                     <textarea name="rejection_reason" class="form-control"></textarea>
                     <br>
                    <input type="submit" name="submit" value="submit" class="btn btn-primary"> <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                   </div>
           
                 </div>
             </form>
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
	
	function proceed(type){
		if(type == 'to_list'){
			$(".pro_list_btn").show();
			$(".add_pro_btn").hide();
		} else if(type == 'to_add'){
			$(".add_pro_btn").show();
			$(".pro_list_btn").hide();
		}
	}

    $('myModal').modal('show');
</script>

