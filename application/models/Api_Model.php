<?php
class Api_Model extends CI_Model
{
	public function insert($tbl,$data)
	{
		$this->db->insert($tbl,$data);
		return $this->db->insert_id();

	}
	public function selectfindin($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->where('find_in_set("'.$con.'", unique_id) <> 0');
		$q = $this->db->get();
		return $q->result();

	}
	public function selectrow($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);

		if ($con)
			$this->db->where($con);

			if ($con1)
				$this->db->where($con1);

				if ($con2)
					$this->db->where($con2);

					if ($con3)
						$this->db->where($con3);
					


		$q = $this->db->get();
		return $q->row();

	}
	public function selectrowlike($search)
	{
		$this->db->select('*');
        $this->db->from('product');
        $this->db->like($search);
		//$this->db->like('title', $search, 'after');
        //$this->db->where($search);
        $query = $this->db->get();
        return $query->result();
	}
	public function selectrowlikesuggestion($search)
	{
		$this->db->select('*');
        $this->db->from('product');
        $this->db->like('title', $search, 'both');
		//$this->db->like('title', $search, 'after');
        //$this->db->where($search);
        $query = $this->db->get();
        return $query->result();
	}
	public function select_price_min_max($product)
	{
		$this->db->select('MAX(sale_price) as max_fare, MIN(sale_price) as min_fare');
		$this->db->from('product');
		$query = $this->db->get();
		//$this->db->last_query();die;
		return $query->row();
	}

	public function select_color($product)
	{
		$this->db->select('color');
		$this->db->from('product');
		$query = $this->db->get();
		//$this->db->last_query();die;
		return $query->result();
	}

	public function select_star($product)
	{
		$this->db->select('rating_num,rating_total');
		$this->db->from('product');
		$query = $this->db->get();
		//$this->db->last_query();die;
		return $query->result();
	}

	public function select_month($product,$month)
	{
		$this->db->select('add_timestamp');
		$this->db->from('product');
		$this->db->where('add_timestamp <=',$month);
		$query = $this->db->get();
		//$this->db->last_query();die;
		return $query->result();
	}

	public function get_sort_producs($product,$category,$price)
	{
		$this->db->select('*');
      $this->db->from($product);
			if ($price=='high')
				$this->db->order_by("sale_price", "desc");
			if ($price=='low')
				$this->db->order_by("sale_price", "asc");
				if ($category)
					$this->db->where('category',$category);

					$query = $this->db->get();
      				return $query->result();
	}
public function get_filter_producs_filter($product,$category,$start_price,$end_price,$brand,$discount,$color) {

      $this->db->select('*');
      $this->db->from($product);
      if ($start_price && $end_price)
      {
      		if($start_price>$end_price)
      		{
      			$this->db->where('sale_price <=',$start_price);
        		$this->db->where('sale_price >=',$end_price);
      		}
      		else
      		{
      			$this->db->where('sale_price >=',$start_price);
        		$this->db->where('sale_price <=',$end_price);
      		}
      }
			if ($brand)
				$this->db->where('brand',$brand);

				if ($discount)
					$this->db->where('discount',$discount);

					if ($color)
						$this->db->where('color',$color);
					
					if ($category)
						$this->db->where('category',$category);

      $query = $this->db->get();
      return $query->result();
  }
	public function get_filter_producs($product,$category,$start_price,$end_price,$brand,$discount,$color,$tag) {

      $this->db->select('*');
      $this->db->from($product);
      if ($start_price && $end_price)
      {
      		if($start_price>$end_price)
      		{
      			$this->db->where('sale_price <=',$start_price);
        		$this->db->where('sale_price >=',$end_price);
      		}
      		else
      		{
      			$this->db->where('sale_price >=',$start_price);
        		$this->db->where('sale_price <=',$end_price);
      		}
      }
			if ($brand)
				$this->db->where('brand',$brand);

				if ($discount)
					$this->db->where('discount',$discount);

					if ($color)
						$this->db->where('color',$color);
					
					if ($category)
						$this->db->where('category',$category);
					
					if ($tag == 'most_viewed') {
            $this->db->order_by('number_of_view', 'desc');
        }

        if ($tag == 'recently_viewed') {
            $this->db->order_by('last_viewed', 'desc');
        }

        if ($tag == 'featured') {
            $this->db->where('featured', 'ok');
        }

        if ($tag == 'bundle') {
            $this->db->where('is_bundle', 'yes');
        }

        if ($tag == 'vendor_featured') {
            $this->db->where('vendor_featured', 'ok');
            $this->db->where('added_by', json_encode(array('type' => 'vendor', 'id' => $id)));
        }

        if ($tag == 'deal') {
            $this->db->where('deal', 'ok');
        }
       
       
      $query = $this->db->get();
      return $query->result();
  }



	public function selectrowjoin($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->join('brand', 'product.brand = brand.brand_id');
		$this->db->join('category', 'product.category = category.category_id');
		$this->db->join('sub_category', 'product.sub_category = sub_category.sub_category_id');
		$this->db->where($con);
		$this->db->where($con);
		$q = $this->db->get();
		return $q->result();

	}

	public function selectrepair($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->join('category', 'repair.category_name = category.category_id');
		$this->db->join('brand', 'repair.brand = brand.brand_id');
		$this->db->join('sub_category', 'repair.modal = sub_category.sub_category_id');
		$q = $this->db->get();
		return $q->result();

	}
	public function selectorderjoin($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->join('user', 'sale.buyer = user.user_id');
		$this->db->where($con);
		$q = $this->db->get();
		return $q->result();

	}

	public function selectcart($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->join('product', 'cart.id = product.product_id');
		$this->db->where($con);
		$this->db->where('cart.status',0);
		$q = $this->db->get();
		return $q->result();

	}
	public function selectrowjoinreview($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->join('user', 'user_rating.user_id = user.user_id');
		$this->db->where($con);
		$q = $this->db->get();
		return $q->result();

	}
	public function select($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);

		if ($con)
			$this->db->where($con);

			if ($con1)
				$this->db->where($con1);

				if ($con2)
					$this->db->where($con2);

					if ($con3)
						$this->db->where($con3);

		$q = $this->db->get();
		return $q->result();

	}

	public function selectnotification($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);

		if ($con)
			$this->db->where($con);

			if ($con1)
				$this->db->where($con1);

				if ($con2)
					$this->db->where($con2);

					if ($con3)
						$this->db->where($con3);
					$this->db->order_by('id', 'DESC');
		$q = $this->db->get();
		return $q->result();

	}

	public function selectproduct($tbl,$con='',$con1='')
	{
		$this->db->select('*');
		$this->db->from($tbl);

		if ($con)
			$this->db->where($con);
					

		$q = $this->db->get();
		return $q->result();

	}

	public function selectcount($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);

		if ($con)
			$this->db->where($con);

			if ($con1)
				$this->db->where($con1);

				if ($con2)
					$this->db->where($con2);

					if ($con3)
						$this->db->where($con3);



	  return $num_results = $this->db->count_all_results();

	}

	public function selectslider($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);

		if ($con)
			$this->db->where($con);

			if ($con1)
				$this->db->where($con1);

				if ($con2)
					$this->db->where($con2);

					if ($con3)
						$this->db->where($con3);
					$this->db->limit( 6);
					$this->db->order_by('slides_id', 'DESC');



		$q = $this->db->get();
		return $q->result();

	}

	public function selectrowdesc($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);

		if ($con)
			$this->db->where($con);

			if ($con1)
				$this->db->where($con1);

				if ($con2)
					$this->db->where($con2);

					if ($con3)
						$this->db->where($con3);

					$this->db->order_by('user_id', 'DESC');

		$q = $this->db->get();
		return $q->row();

	}
	public function update($tbl,$data,$con='')
	{
		if($con)
		$this->db->where($con);
		$this->db->update($tbl,$data);
		return $this->db->affected_rows();
	}
	public function delete($tbl,$con)
	{
		$this->db->where($con);
		$this->db->delete($tbl);
		return TRUE;
	}
}
?>