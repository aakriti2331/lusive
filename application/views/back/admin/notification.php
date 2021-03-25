<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('manage_notification');?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <a href="<?php echo base_url('admin/addnotification')?>" class="btn btn-success btn-sm mt-3 mb-3">Add Notification </a>
                    <!-- LIST -->
                    <div class="tab-pane fade active in"  style="border:1px solid #ebebeb; border-radius:4px;">
                        <script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-table/extensions/export/bootstrap-table-export.js"></script>
<div class="panel-body" id="demo_s">
    <table id="events-table" class="table table-striped"  data-url="<?php echo base_url(); ?>admin/product/list_data" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"  data-show-refresh="true" data-search="true"  data-show-export="true" >
        <thead>
            <tr>
                <th data-field="image" data-align="right" data-sortable="true">
                    <?php echo translate('id');?>
                </th>
                <th data-field="title" data-align="center" data-sortable="true">
                    <?php echo translate('name');?>
                </th>
                
                <th data-field="added_by" data-sortable="true">
                    <?php echo translate('title');?>
                </th>

                <th data-field="current_stock" data-sortable="true">
                    <?php echo translate('description');?>
                </th>
                <th data-field="deal" data-sortable="false">
                    <?php echo translate("image");?>
                </th>
                <th data-field="publish" data-sortable="false">
                    <?php echo translate('created');?>
                </th>
                <th data-field="featured" data-sortable="false">
                    <?php echo translate('action');?>
                </th>
            </tr>
        </thead>
        <body>
            <?php
            if(!empty($notification))
            {
                $i=1;
                foreach ($notification as $row)
                {
                           
            ?>
            <tr>
                <td><?php echo $i; $i++;?> </td>
                <td><?php echo $row->name;?> </td>
                <td><?php echo $row->title;?> </td>
                <td><?php echo $row->description;?> </td>
                
                <td><img style="width: 200px; height: 140px;" src="<?php echo base_url(); ?>url/<?= $row->image ?>" alt="No Image" download /> </td>
                <td><?php echo $row->created_at;?> </td>
                <td>
                  <a href="<?php echo base_url('admin/editnotification/').$row->id; ?>" class="btn btn-success btn-sm mr-2">Edit </a><a href="<?php echo base_url('admin/deletenotification/').$row->id; ?>" class="btn btn-danger btn-sm">Delete </a><a href="<?php echo base_url('admin/sendnotification/').$row->id; ?>" class="btn btn-primary btn-sm">Send </a></td>
            </tr>
            <?php  }
            }      ?>
        </body>
    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>