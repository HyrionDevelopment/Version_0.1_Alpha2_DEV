<?php
class model_admin_webshop_items extends CW_Admin_Model
{
	public function __construct()
	{
		parent::construct();
	}
	
	public function add($data=null)
	{
		$mysql = new mysql();
		if(isset($data))
		{
			foreach($data as $key=>$val)
			{
				if($key != 'img_url')
				{
					if($val == '')
					{
						return false;
					}
				}
			}
		
			$price = str_replace(',', '.', $data['item_price']);
			$price = intval($price);
			//echo $price;
			
			
			$sql = "INSERT INTO webshop_items 
			(item_title, item_title_alias, item_price, item_image, item_description, item_short_description)
			VALUE
			(
			'".$mysql->escape($data['item_name'])."', 
			'".$mysql->escape($data['item_alias'])."', 
			".$mysql->escape($price).", 
			'".$mysql->escape($data['img_url'])."', 
			'".$mysql->escape($data['description'])."', 
			'".$mysql->escape($data['short_description'])."'
			)";
			return $mysql->query($sql);
		}
	}
	
	public function edit($item_id=null, $data=null)
	{
		$mysql = new mysql();
		if(isset($data) && isset($item_id))
		{
			foreach($data as $key=>$val)
			{
				if($key != 'images')
				{
					if($key == 'item_price')
					{
						$val = str_replace(',','.', $val);
					}
					if(!is_numeric($val))
					{
						$update = "UPDATE webshop_items SET ".$key."='".$val."' WHERE item_id=".$item_id;
					}else{
						$update = "UPDATE webshop_items SET ".$key."=".$val." WHERE item_id=".$item_id;
					}
					$mysql->query($update);
				}
			}
			return true;
		}
	}
	
	public function load_product($item_id)
	{
		$mysql = new mysql();
		$seg1 = new CW_admin_segments();
		$seg = $seg1->get_segments();
		
		$return = array();
		$select = "SELECT * FROM webshop_items WHERE item_id=".$mysql->escape($seg[4]);
		if($mysql->num_row($select) == 1)
		{
			$query = mysql_query($select);
			$row = $mysql->fetch_assoc($query);
			if($row['item_image'] == null || $row['item_image'] == 0)
			{
				$row['item_image'] = '';
			}
			//print_r( $row);
			return $row;
		}else{
			return false;
		}
	}
}