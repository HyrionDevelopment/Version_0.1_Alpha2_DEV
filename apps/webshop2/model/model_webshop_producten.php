<?php
class model_webshop_producten extends Model
{
	public function __construct()
    {
        parent::construct();
    }

	public function get_product_name($pr_name, $user_id=null)
	{
		if($user_id == null)
		{
			if(isset($_SESSION['user_id']))
			{
				$user_id = $_SESSION['user_id'];
			}
			else
			{
				$user_id = 0;
			}
		}
		$sql = "SELECT * FROM webshop_items WHERE item_title_alias='".$this->mysql->escape($pr_name)."'";
		$result = mysql_query($sql);
		$result_array = array();
		while($row = mysql_fetch_assoc($result))
		{
			$row['item_price2'] = str_replace(".", ",", strval($row['item_price']));
			$row['user_id'] = $user_id;
			
			$sql2 = "SELECT * FROM webshop_categories WHERE webshop_category_id=".$this->mysql->escape($row['webshop_category_id']);
			$result2 = mysql_query($sql2);
			$row2 = mysql_fetch_assoc($result2);
			
			if($row['webshop_category_id'] != 0)
			{
				$row['category_name'] = $row2['category_name'];
			}else{
				$row['category_name'] = "Geen categorie";
			}

			array_push($result_array, $row);
		}
		return $result_array;
	}
	
	public function search_request($item_name)
	{
		$sql = "SELECT * FROM webshop_items WHERE item_title LIKE '%".$this->mysql->escape($item_name)."%'";
		if($this->mysql->num_row($sql) > 0)
		{
			$result = mysql_query($sql);
			$result_array = array();
			while($row = mysql_fetch_assoc($result))
			{
				$row['item_price2'] = str_replace(".", ",", strval($row['item_price']));

				array_push($result_array, $row);
			}
			return $result_array;
		}else{
			return false;
		}
	}
	
	public function get_all_products($page=null, $number_item=null)
	{	
		if(isset($page))
		{
			$start_point = $page*$number_item;
		}else{
			$start_point = 0;
		}
		$sql = "SELECT * FROM webshop_items LIMIT ".$this->mysql->escape($start_point).",".$this->mysql->escape($number_item);
		if($this->mysql->num_row($sql) > 0)
		{
			$result = mysql_query($sql);
			$result_array = array();
			while($row = mysql_fetch_assoc($result))
			{
				array_push($result_array, $row);
			}
			return $result_array;
		}else{
			return false;
		}
	}
}