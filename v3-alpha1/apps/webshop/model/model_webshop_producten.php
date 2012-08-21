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
			
			if(empty($row['item_image']) || $row['item_image'] == '0')
			{
				$row['item_image'] = 'http://www.sdujuridischeopleidingen.nl/export/e4/e45332P0UgXSnAEeW.gif';
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
				
				if(empty($row['item_image']) || $row['item_image'] == '0')
				{
					$row['item_image'] = 'http://www.sdujuridischeopleidingen.nl/export/e4/e45332P0UgXSnAEeW.gif';
				}

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
	
	public function GetFromCategoryAlias($CategoryAlias)
	{
		$sql1 = "SELECT * FROM webshop_categories WHERE category_alias='".$this->mysql->escape($CategoryAlias)."'";
		$result1 = mysql_query($sql1);
		if(mysql_num_rows($result1) == 0)
		{
			return false;
		}
		$row1 = mysql_fetch_assoc($result1);
		$CategoryID = $row1['webshop_category_id'];
		
		$sql2 = "SELECT * FROM webshop_items WHERE webshop_category_id=".$this->mysql->escape($CategoryID);
		$result2 = mysql_query($sql2);
		if(mysql_num_rows($result2) == 0)
		{
			return false;
		}
		
		$return_array = array();
		while($row2 = mysql_fetch_assoc($result2))
		{
			$row2['item_price2'] = str_replace(".", ",", strval($row2['item_price']));
			array_push($return_array, $row2);
		}
		return $return_array;
	}
}