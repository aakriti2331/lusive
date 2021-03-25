<?php
$physical_check = $this->crud_model->get_type_name_by_id('general_settings','68','value');
$digital_check = $this->crud_model->get_type_name_by_id('general_settings','69','value');
$bundle_check = $this->crud_model->get_type_name_by_id('general_settings','82','value');
$customer_product_check = $this->crud_model->get_type_name_by_id('general_settings','83','value');
?>
<nav id="mainnav-container">
    <div id="mainnav">
        <!--Menu-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content" style="overflow-x:auto;">
                    <ul id="mainnav-menu" class="list-group">
                        <!--Category name-->
                        <li class="list-header"></li>
                        <!--Menu list item-->
                        <li <?php if($page_name=="dashboard"){?> class="active-link" <?php } ?> 
                        	style="border-top:1px solid rgba(69, 74, 84, 0.7);">
                            <a href="<?php echo base_url(); ?>admin/">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
									<?php echo translate('dashboard');?>
                                </span>
                            </a>
                        </li>
                        <?php
						if($physical_check == 'ok' && $digital_check == 'ok'){
							if($this->crud_model->admin_permission('category') ||
                                    $this->crud_model->admin_permission('sub_category') ||
										$this->crud_model->admin_permission('brand') || 
                                        	$this->crud_model->admin_permission('product') || 
                                            	$this->crud_model->admin_permission('stock') ||
                                                    $this->crud_model->admin_permission('product_bundle') ||
													   $this->crud_model->admin_permission('category_digital') ||
                                    					   $this->crud_model->admin_permission('sub_category_digital') ||
                                        					       $this->crud_model->admin_permission('digital') ){
						?>
                        <li <?php if($page_name=="category" || 
                                        $page_name=="sub_category" || 
                                            $page_name=="product" || 
                                                $page_name=="stock" ||
                                                    $page_name=="product_bundle" ||
													    $page_name=="category_digital" || 
                                        				    $page_name=="sub_category_digital"||
                                           					        $page_name=="digital" ){?>
                                                     			class="active-sub" 
                                                       				<?php } ?> >
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                    <span class="menu-title">
                                        <?php echo translate('products');?>
                                    </span>
                                	<i class="fa arrow"></i>
                            </a>
            
                            <!--PRODUCT------------------>
                            <ul class="collapse <?php if($page_name=="category" || 
                                                            $page_name=="sub_category" ||  
                                                                $page_name=="product" || 
                                                                $page_name=="product_bulk_upload" ||
                                                                    $page_name=="brand" ||
                                                                        $page_name=="stock" ||
                                                                            $page_name=="product_bundle" ||
                                                                                $page_name=="category_digital" || 
                                                                                    $page_name=="sub_category_digital" ||
                                                                                        
                                                                                            $page_name=="digital" ){?>
                                                                             		in
                                                                                		<?php } ?> >" >
							<?php
                                if($this->crud_model->admin_permission('category') ||
                                    $this->crud_model->admin_permission('sub_category') ||
										$this->crud_model->admin_permission('brand') || 
                                            $this->crud_model->admin_permission('product') || 
                                            $this->crud_model->admin_permission('product_bulk_upload') ||
                                                $this->crud_model->admin_permission('stock') ||
                                                    $this->crud_model->admin_permission('product_bundle')){
                            ?>
                            <!--Menu list item-->
                                <li <?php if($page_name=="category" || 
                                                $page_name=="sub_category" || 
													$page_name=="brand" ||
                                                    $page_name=="product" || 
                                                        $page_name=="product_bulk_upload" ||
                                                            $page_name=="stock" ||
                                                                $page_name=="product_bundle"){?>
                                                                class="active-sub" 
                                                                    <?php } ?> >
                                      <?php
                                            if($this->crud_model->admin_permission('category')){
                                        ?>                                            
                                            <li <?php if($page_name=="category"){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/category">
                                                    <i class="fa fa-circle fs_i"></i>
                                                        <?php echo translate('category');?>
                                                </a>
                                            </li>
										<?php
                                        	} if($this->crud_model->admin_permission('brand')){
                                        ?>
                                            <li <?php if($page_name=="brand"){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/brand">
                                                    <i class="fa fa-circle fs_i"></i>
                                                        <?php echo translate('brands');?>
                                                </a>
                                            </li>
                                        <?php
                                            } if($this->crud_model->admin_permission('sub_category')){
                                        ?>
                                            <li <?php if($page_name=="sub_category"){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/sub_category">
                                                    <i class="fa fa-circle fs_i"></i>
                                                        <?php echo translate('sub-category');?>
                                                </a>
                                            </li>
                                        <?php
                                        } if($this->crud_model->admin_permission('product')){
                                            ?>
                                            <li <?php if($page_name=="product"){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/product">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('all_products');?>
                                                </a>
                                            </li>
                                        <?php
                                        } if($this->crud_model->admin_permission('product_bulk_upload')){
                                            ?>
                                            <li <?php if($page_name=="product_bulk_upload"){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/product_bulk_upload">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('Product bulk upload');?>
                                                </a>
                                            </li>
                                        <?php
                                            } if($this->crud_model->admin_permission('stock')){
                                        ?>
                                            <li <?php if($page_name=="stock"){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/stock">
                                                    <i class="fa fa-circle fs_i"></i>
                                                        <?php echo translate('product_stock');?>
                                                </a>
                                            </li>
                                        <?php
                                            } if($this->crud_model->admin_permission('product_bundle') && $bundle_check == 'ok'){
                                        ?>
                                            
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </li>
                          
                            <?php
                                }
                            ?>
                        </li>
                        <?php
							}
						}
						?>
                        <?php
						if($physical_check == 'ok' && $digital_check !== 'ok'){
							if($this->crud_model->admin_permission('category') ||
								$this->crud_model->admin_permission('sub_category') ||
									$this->crud_model->admin_permission('brand') || 
									$this->crud_model->admin_permission('product') || 
										$this->crud_model->admin_permission('product_bundle') ||
                                        $this->crud_model->admin_permission('stock') ){
						?>
						<!--Menu list item-->
							<li <?php if($page_name=="category" || 
											$page_name=="sub_category" || 
												$page_name=="brand" ||
                                                $page_name=="product" || 
                                                    $page_name=="product_bulk_upload" ||
												        $page_name=="product_bundle" || 
													        $page_name=="stock" ){?>
														        class="active-sub" 
															     <?php } ?> >
								<a href="#">
									<i class="fa fa-list"></i>
										<span class="menu-title">
											<?php echo translate('products');?>
										</span>
										<i class="fa arrow"></i>
								</a>
				
								<!--PRODUCT------------------>
								<ul class="collapse <?php if($page_name=="category" || 
																$page_name=="sub_category" ||  
																	$page_name=="product" ||
																	    $page_name=="product_bulk_upload" ||
																		    $page_name=="brand" ||
                                                                                $page_name=="product_bundle" ||
																			        $page_name=="stock" ){?>
																				        in
																					        <?php } ?> " >
									
									<?php
										if($this->crud_model->admin_permission('category')){
									?>                                            
										<li <?php if($page_name=="category"){?> class="active-link" <?php } ?> >
											<a href="<?php echo base_url(); ?>admin/category">
												<i class="fa fa-circle fs_i"></i>
													<?php echo translate('category');?>
											</a>
										</li>
									<?php
										} if($this->crud_model->admin_permission('brand')){
									?>
										<li <?php if($page_name=="brand"){?> class="active-link" <?php } ?> >
											<a href="<?php echo base_url(); ?>admin/brand">
												<i class="fa fa-circle fs_i"></i>
													<?php echo translate('brands');?>
											</a>
										</li>
									<?php
										} if($this->crud_model->admin_permission('sub_category')){
									?>
										<li <?php if($page_name=="sub_category"){?> class="active-link" <?php } ?> >
											<a href="<?php echo base_url(); ?>admin/sub_category">
												<i class="fa fa-circle fs_i"></i>
													<?php echo translate('sub-category');?>
											</a>
										</li>
									<?php
										} if($this->crud_model->admin_permission('product')){
									?>
										<li <?php if($page_name=="product"){?> class="active-link" <?php } ?> >
											<a href="<?php echo base_url(); ?>admin/product">
												<i class="fa fa-circle fs_i"></i>
													<?php echo translate('all_products');?>
											</a>
										</li>
    									<?php
                                            } if($this->crud_model->admin_permission('product_bulk_upload')){
                                                ?>
                                                <li <?php if($page_name=="product_bulk_upload"){?> class="active-link" <?php } ?> >
                                                    <a href="<?php echo base_url(); ?>admin/product_bulk_upload">
                                                        <i class="fa fa-circle fs_i"></i>
                                                        <?php echo translate('Product bulk upload');?>
                                                    </a>
                                                </li>
    									<?php
										} 
                                        ?>
                                        <?php
                                         if($this->crud_model->admin_permission('stock')){
									?>
										<li <?php if($page_name=="stock"){?> class="active-link" <?php } ?> >
											<a href="<?php echo base_url(); ?>admin/stock">
												<i class="fa fa-circle fs_i"></i>
													<?php echo translate('product_stock');?>
											</a>
										</li>
									<?php
										}
									?>
								</ul>
							</li>
					  
						<?php
							}
						}
						?>
                        <?php
                            if($this->crud_model->admin_permission('delete_all_categories') ||
                                $this->crud_model->admin_permission('delete_all_products') || 
                                        $this->crud_model->admin_permission('delete_all_brands') ||
                                            $this->crud_model->admin_permission('delete_all_classified') ){
                        ?>
                        <!--Menu list item-->
                            <li <?php if($page_name=="delete_all_categories" || 
                                            $page_name=="delete_all_products" ||
                                                $page_name=="delete_all_brands" ||
                                                    $page_name=="delete_all_classified"){?>
                                                         class="active-sub" 
                                                            <?php } ?> >
                                <a href="#">
                                    <i class="fa fa-trash"></i>
                                        <span class="menu-title">
                                            <?php echo translate('delete_contents');?>
                                        </span>
                                        <i class="fa arrow"></i>
                                </a>
                                <!--digital------------------>
                                <ul class="collapse <?php if($page_name=="delete_all_categories" || 
                                                                $page_name=="delete_all_products" ||
                                                                    $page_name=="delete_all_brands" ||
                                                                        $page_name=="delete_all_classified"){?>
                                                                                 in
                                                                                    <?php } ?> >" >
                                    
                                    <?php
                                        if($this->crud_model->admin_permission('category')){
                                    ?>                                            
                                        <li <?php if($page_name=="delete_all_categories"){?> class="active-link" <?php } ?> >
                                            <a href="<?php echo base_url(); ?>admin/delete_all_categories">
                                                <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('delete_all_categories');?>
                                            </a>
                                        </li>
                                    <?php
                                        } if($this->crud_model->admin_permission('sub_category')){
                                    ?>
                                        <li <?php if($page_name=="delete_all_products"){?> class="active-link" <?php } ?> >
                                            <a href="<?php echo base_url(); ?>admin/delete_all_products">
                                                <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('delete_all_products');?>
                                            </a>
                                        </li>
                                    <?php
                                        } if($this->crud_model->admin_permission('delete_all_brands')){
                                    ?>
                                        <li <?php if($page_name=="delete_all_brands"){?> class="active-link" <?php } ?> >
                                            <a href="<?php echo base_url(); ?>admin/delete_all_brands">
                                                <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('delete_all_brands');?>
                                            </a>
                                        </li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </li>
                      
                        <?php
                            }
                        ?> 
						<?php
							if($this->crud_model->admin_permission('sale')){
						?>
                        <li <?php if($page_name=="sales"){?> class="active-link" <?php } ?>>
                            <a href="<?php echo base_url(); ?>admin/sales/">
                                <i class="fa fa-usd"></i>
                                    <span class="menu-title">
                                		<?php echo translate('sale');?>
                                    </span>
                            </a>
                        </li>
                        <?php
							}
						?>
                        <?php
                            if($this->crud_model->admin_permission('coupon')){
                        ?>
                        <li <?php if($page_name=="coupon"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>admin/coupon/">
                                <i class="fa fa-tag"></i>
                                    <span class="menu-title">
                                        <?php echo translate('discount_coupon');?>
                                    </span>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                        <?php
							if($this->crud_model->admin_permission('report')){
						?>
                        <li <?php if($page_name=="report" || 
                                        $page_name=="report_stock" ||
                                            $page_name=="report_wish" ){?>
                                                     class="active-sub" 
                                                        <?php } ?>>
                            <a href="#">
                                <i class="fa fa-file-text"></i>
                                    <span class="menu-title">
                                		<?php echo translate('reports');?>
                                    </span>
                                		<i class="fa arrow"></i>
                            </a>
                            
                            <!--REPORT-------------------->
                            <ul class="collapse <?php if($page_name=="report" || 
                                                            $page_name=="report_stock" ||
                                                                $page_name=="report_wish" ){?>
                                                                             in
                                                                                <?php } ?> ">
                                <?php
                                if($physical_check=='ok'){
								?>
                                <li <?php if($page_name=="report_stock"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/report_stock/">
                                    	<i class="fa fa-circle fs_i"></i>
                                        	<?php echo translate('product_stock');?>
                                    </a>
                                </li>
                                <?php
								}
								?>
                            </ul>
                        </li>
                        <?php
							}
						?>
                        <?php
						if($this->crud_model->get_type_name_by_id('general_settings','58','value') == 'ok'){
                            if($this->crud_model->admin_permission('vendor') ||
                                $this->crud_model->admin_permission('membership_payment') ||
                                    $this->crud_model->admin_permission('membership')){
                        ?>
                        <li <?php if($page_name=="vendor" || 
                                    $page_name=="vendor_commission" ||
                                        $page_name=="membership_payment" ||
											$page_name=="slides_vendor" ||
                                            	$page_name=="membership" ){?>
                                                     class="active-sub" 
                                                        <?php } ?>>
                            <a href="#">
                                <i class="fa fa-user-plus"></i>
                                    <span class="menu-title">
                                        <?php echo translate('vendors');?>
                                    </span>
                                        <i class="fa arrow"></i>
                            </a>
                            
                            <!--REPORT-------------------->
                            <ul class="collapse <?php if($page_name=="vendor" || 
                                                        $page_name=="vendor_commission" ||
                                                            $page_name=="membership_payment" ||
																$page_name=="pay_to_vendor" ||
																	$page_name=="slides_vendor" ||
                                                                		$page_name=="membership" ){?>
                                                                             in
                                                                                <?php } ?> ">
                                <li <?php if($page_name=="vendor"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/vendor/">
                                        <i class="fa fa-circle fs_i"></i>
                                            <?php echo translate('vendor_list');?>
                                    </a>
                                </li>
                                <li <?php if($page_name=="pay_to_vendor"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/pay_to_vendor/">
                                        <i class="fa fa-circle fs_i"></i>
                                        <?php echo translate('pay_to_vendor');?>
                                    </a>
                                </li>
                                <li <?php if($page_name=="membership_payment"){?> class="active-link" <?php } ?> >
                                    <?php if($this->db->get_where('business_settings', array('type' => 'commission_set'))->row()->value == 'no'){?>
                                    <a href="<?php echo base_url(); ?>admin/membership_payment/">
                                        <i class="fa fa-circle fs_i"></i>
                                        <?php echo translate('package_payments');?>
                                    </a>
                                    <?php }?>
                                </li>
                                <li <?php if($page_name=="membership"){?> class="active-link" <?php } ?> >
                                    <?php if($this->db->get_where('business_settings', array('type' => 'commission_set'))->row()->value == 'no'){?>
                                    <a href="<?php echo base_url(); ?>admin/membership/">
                                        <i class="fa fa-circle fs_i"></i>
                                        <?php echo translate('vendor_packages');?>
                                    </a>
                                    <?php }?>
                                </li>
                                <li <?php if($page_name=="vendor_commission"){?> class="active-link" <?php } ?> >
                                    <?php if($this->db->get_where('business_settings', array('type' => 'commission_set'))->row()->value == 'yes'){?>
                                    <a href="<?php echo base_url(); ?>admin/vendor_commission/">
                                        <i class="fa fa-circle fs_i"></i>
                                        <?php echo translate('vendor_commission');?>
                                    </a>
                                    <?php }?>
                                </li>
                            </ul>
                        </li>
                        <?php
                            }
						}
                        ?>
                        <?php
                            if($this->crud_model->admin_permission('user') ){
                        ?>
                        <li <?php if($page_name=="user" || 
                                        $page_name=="wallet_load" ||
                                            $page_name=="package"){?>
                                             class="active-sub" 
                                                <?php } ?> >
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span class="menu-title">
                                    <?php echo translate('customers');?>
                                </span>
                                <i class="fa arrow"></i>
                            </a>
            
                            <ul class="collapse <?php if($page_name=="user" || 
                                                            $page_name=="wallet_load" || $page_name=="package"){?>
                                                                 in
                                                                    <?php } ?>" >
                                
                                <?php
                                    if($this->crud_model->admin_permission('user')){
                                ?>
                                <li <?php if($page_name=="user"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/user">
                                        <i class="fa fa-circle fs_i"></i>
                                            <?php echo translate('customers');?>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>                                
                            </ul>
                        </li>
                        <?php
                            }
                        ?>
                        <?php
                        	if($this->crud_model->admin_permission('newsletter') ||
								$this->crud_model->admin_permission('contact_message') ){
						?>
                        <li <?php if($page_name=="newsletter" || 
                                        $page_name=="contact_message" ){?>
                                             class="active-sub" 
                                                <?php } ?> >
                            <a href="#">
                                <i class="fa fa-envelope"></i>
                                <span class="menu-title">
                                	<?php echo translate('messaging');?>
                                </span>
                                <i class="fa arrow"></i>
                            </a>
            
                            <ul class="collapse <?php if($page_name=="newsletter" || 
															$page_name=="contact_message"){?>
                                                                 in
                                                                    <?php } ?>" >
                                
								<?php
                                    if($this->crud_model->admin_permission('newsletter')){
                                ?>
                                <li <?php if($page_name=="newsletter"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/newsletter">
                                        <i class="fa fa-circle fs_i"></i>
                                        	<?php echo translate('newsletters');?>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                                
                                <?php
                                    if($this->crud_model->admin_permission('contact_message')){
                                ?>
                                <li <?php if($page_name=="contact_message"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/contact_message">
                                        <i class="fa fa-circle fs_i"></i>
                                        	<?php echo translate('contact_messages');?>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>
						<?php
                            }
                        ?>
            			<?php
                        	if($this->crud_model->admin_permission('slider') ||
                                  	$this->crud_model->admin_permission('slides') || 
										$this->crud_model->admin_permission('display_settings') ||
											$this->crud_model->admin_permission('site_settings') ||
												$this->crud_model->admin_permission('email_template') ||
                                        			$this->crud_model->admin_permission('captha_n_social_settings') ||
														$this->crud_model->admin_permission('page')){
						?>
                        <li <?php if($page_name=="slider" || 
										$page_name=="slides" || 
											$page_name=="display_settings"||
												$page_name=="site_settings" || 
													$page_name=="email_template" ||
														$page_name=="captha_n_social_settings" ||
															$page_name=="default_images" ||
																$page_name=="page" ){?>
																	class="active-sub" 
																		<?php } ?> >
                            <a href="#">
                                <i class="fa fa-desktop"></i>
                                    <span class="menu-title">
                                		<?php echo translate('frontend_settings');?>
                                    </span>
                                		<i class="fa arrow"></i>
                            </a>
                            <!--Submenu-->
                            <ul class="collapse <?php if($page_name=="slider" || 
                                                			$page_name=="slides" || 
																$page_name=="display_settings"||
																	$page_name=="site_settings" || 
																		$page_name=="email_template" ||
																			$page_name=="captha_n_social_settings" ||
																				$page_name=="default_images" ||
																					$page_name=="page"){?>
																						in
																						<?php } ?>" >
                                
								<?php
                                    if($this->crud_model->admin_permission('slider') ||
                                        $this->crud_model->admin_permission('slides')){
                                ?>
                                <li <?php if($page_name=="slider" || 
                                                $page_name=="slides"){?>
                                                     class="active-sub" 
                                                        <?php } ?>>
                                    <a href="#">
                                        <i class="fa fa-sliders"></i>
                                            <span class="menu-title">
                                                <?php echo translate('slider_settings');?>
                                            </span>
                                                <i class="fa arrow"></i>
                                    </a>
                                    
                                    <!--REPORT-------------------->
                                    <ul class="collapse <?php if($page_name=="slider" || 
                                                                    $page_name=="slides" ){?>
                                                                         in
                                                                            <?php } ?> ">
                                        <li <?php if($page_name=="slider"){?> class="active-link" <?php } ?> >
                                            <a href="<?php echo base_url(); ?>admin/slider/">
                                                <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('layer_slider');?>
                                            </a>
                                        </li>
                                        <li <?php if($page_name=="slides"){?> class="active-link" <?php } ?> >
                                            <a href="<?php echo base_url(); ?>admin/slides/">
                                                <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('top_slides');?>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <?php
                                    }
                                ?>
							
                                
								<?php
                                    if($this->crud_model->admin_permission('site_settings') ||
										$this->crud_model->admin_permission('email_template') ||
                                         $this->crud_model->admin_permission('captha_n_social_settings')){
                                ?>
                                <li <?php if($page_name=="site_settings" || 
												$page_name=="email_template" ||
                                                	$page_name=="captha_n_social_settings" ){?>
                                                 		class="active-sub" 
                                                    		<?php } ?> >
                                    <a href="#">
                                        <i class="fa fa-wrench"></i>
                                            <span class="menu-title">
                                                <?php echo translate('site_settings');?>
                                            </span>
                                                <i class="fa arrow"></i>
                                    </a>
                                    <!--Submenu-->
                                    <ul class="collapse <?php if($page_name=="site_settings" ||
																	$page_name=="email_template" || 
                                                                    	$page_name=="captha_n_social_settings" ){?>
                                                                     		in
                                                                        		<?php } ?>" >
                                        
                                        <?php
                                            if($this->crud_model->admin_permission('site_settings')){
                                        ?>                      
                                            <li <?php if($page_name=="site_settings"){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url();?>admin/site_settings/general_settings/">
                                                    <i class="fa fa-circle fs_i"></i>
                                                        <?php echo translate('general_settings');?>
                                                </a>
                                            </li>
                                        <?php
                                            }
                                        ?>
                                        
                                        <?php
                                            if($this->crud_model->admin_permission('email_template')){
                                        ?>                      
                                            <li <?php if($page_name=="email_template"){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url();?>admin/email_template/">
                                                    <i class="fa fa-circle fs_i"></i>
                                                        <?php echo translate('email_templates');?>
                                                </a>
                                            </li>
                                        <?php
                                            }
                                        ?>
                                        
                                        
                                    </ul>
                                </li>
                                <?php
                                    }
                                ?>
              
                           	</ul>
                        </li>
						<?php
                            }
                        ?>
      
            			<?php
                        	if($this->crud_model->admin_permission('role') ||
								$this->crud_model->admin_permission('admin') ){
						?>
                        <li <?php if($page_name=="role" || 
                                        $page_name=="admin" ){?>
                                             class="active-sub" 
                                                <?php } ?> >
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span class="menu-title">
                                	<?php echo translate('staffs');?>
                                </span>
                                <i class="fa arrow"></i>
                            </a>
            
                            <ul class="collapse <?php if($page_name=="admin" || 
															$page_name=="role"){?>
                                                                 in
                                                                    <?php } ?>" >
                                
								<?php
                                    if($this->crud_model->admin_permission('admin')){
                                ?>
                                <li <?php if($page_name=="admin"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/admins/">
                                        <i class="fa fa-circle fs_i"></i>
                                        	<?php echo translate('all_staffs');?>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($this->crud_model->admin_permission('role')){
                                ?>
                                <!--Menu list item-->
                                <li <?php if($page_name=="role"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/role/">
                                        <i class="fa fa-circle fs_i"></i>
                                        	<?php echo translate('staff_permissions');?>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>
						<?php
                            }
                        ?>
                        <?php
                            if($this->crud_model->admin_permission('seo')){
                        ?>
                        <li <?php if($page_name=="seo_settings"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>admin/seo_settings">
                                <i class="fa fa-search-plus"></i>
                                <span class="menu-title">
                                    SEO
                                </span>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>
</nav>
<style>
.activate_bar{
border-left: 3px solid #1ACFFC;	
transition: all .6s ease-in-out;
}
.activate_bar:hover{
border-bottom: 3px solid #1ACFFC;
transition: all .6s ease-in-out;
background:#1ACFFC !important;
color:#000 !important;	
}
ul ul ul li a{
	padding-left:80px !important;
}
ul ul ul li a:hover{
	background:#2f343b !important;
}
</style>