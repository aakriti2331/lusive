<?php
class Product_api extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
    $this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('email');
		$this->load->model('Api_Model');
		date_default_timezone_set("Asia/Kolkata");
	}

	public function best_seller()
	{
		echo "string";die;
		$box_style =  $this->db->get_where('ui_settings',array('ui_settings_id' => 60))->row()->value;
					$limit =  $this->db->get_where('ui_settings',array('ui_settings_id' => 61))->row()->value;
                    $todays_deal=$this->crud_model->product_list_set('deal',$limit);
                    foreach($todays_deal as $row){
                		$sdata['user']= $this->html_model->product_box($row, 'grid', $box_style);
					}
					echo json_encode($sdata);
	}

}

?>