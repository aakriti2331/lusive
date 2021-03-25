<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('add_notification');?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding: 5px;">
                        
                        
                    </div>
                    <?php if($this->session->flashdata('message')){?>
  <div class="alert alert-success">

    <?php echo $this->session->flashdata('message')?>
  </div>
<?php } ?>
<?php if($this->session->flashdata('mess')){?>
  <div class="alert alert-info">

    <?php echo $this->session->flashdata('mess')?>
  </div>
<?php } ?>
                    <!-- LIST -->
                    <div class="tab-pane fade active in" style="border:1px solid #ebebeb; border-radius:4px;">
                        <?php
                    echo form_open(base_url() . 'admin/update_notification', array(
                        'class' => 'form-login',
                        'method' => 'post',
                        'id' => 'sign_form',
                'enctype' => 'multipart/form-data'
                    ));
                   
                ?>
                   <input type="hidden"  name="id" value="<?php echo $notification_info->id; ?>">
                <div class="card-body">
               
                  <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                       <label for="exampleInputEmail1">Name</label>
                   <input type="text" class="form-control" required value="<?php echo $notification_info->name; ?>" name="name" placeholder="Enter name">
                    <?php echo form_error('name'); ?>
                    </div>
                    <div class="col-md-3">
                         <label for="exampleInputEmail1">Image</label>
                    <input type="file" class="form-control" name="url" placeholder="Image">
                    
                    </div>
                    <div class="col-md-3">
                       <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" value="<?php echo $notification_info->title; ?>" name="title" placeholder="Enter title">
                    <?php echo form_error('title'); ?>
                    </div>
                    <div class="col-md-3">
                         <label for="exampleInputEmail1">Description</label>
                    <input type="text" class="form-control" value="<?php echo $notification_info->description; ?>" name="description" placeholder="Enter description">
                    <?php echo form_error('description'); ?>
                    </div>
                    <div class="col-md-3">
                       <label for="exampleInputEmail1">Select User</label>
                   <select name="user[]" required class="form-control" multiple>
                    <option selected="true" disabled="disabled">-- Choose User --</option>
                    <?php
                    foreach ($users as $row)
                    {
                    ?>
                    <option value="<?php echo $row->user_id;?>"><?php echo $row->username.' - '.$row->email; ?></option>
                      <?php
                    }
                      ?>                 
                   </select>
                   <?php echo form_error('user'); ?>
                    </div>
                  </div>
                  </div>
                     
                  </div>   
                  
                     
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-danger" name="new_user">Submit</button>
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

