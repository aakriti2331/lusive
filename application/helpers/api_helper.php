<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function wishlistfindin($product_id){
	  $a = str_replace("'", '', $product_id);
          $b = str_replace("[", '', $a);
          $c = str_replace("]", '', $b);
          $d=explode(',',$c);
  return $d;
}

function brandid_by_subcategory($brand_id)
{
	$ci =& get_instance();
	$class = $ci->db->query("SELECT * FROM sub_category WHERE brand LIKE '%$brand_id%'");
           //echo $ci->db->last_query(); die;
    $class = $class->result();
  return $class;
}

?>