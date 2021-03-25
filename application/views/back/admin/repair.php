<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('manage_repair');?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    
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
                    <?php echo translate('mobile');?>
                </th>

                <th data-field="current_stock" data-sortable="true">
                    <?php echo translate('product');?>
                </th>
                <th data-field="deal" data-sortable="false">
                    <?php echo translate("brand");?>
                </th>
                <th data-field="publish" data-sortable="false">
                    <?php echo translate('modal');?>
                </th>
                <th data-field="featured" data-sortable="false">
                    <?php echo translate('location');?>
                </th>
            </tr>
        </thead>
        <body>
            <?php
            if(!empty($repair))
            {
                $id=1;
                foreach ($repair as $row)
                {
                           
            ?>
            <tr>
                <td><?php echo $id; $id++;?></td>
                <td><?php echo $row->firstname;?></td>
                <td><?php echo $row->mobile;?></td>
                <td><?php echo $row->category_name;?></td>
                <td><?php echo $row->name;?></td>
                <td><?php echo $row->sub_category_name;?></td>
                <td><?php echo $row->location;?></td>
                <td><?php echo $row->created_at;?></td>
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