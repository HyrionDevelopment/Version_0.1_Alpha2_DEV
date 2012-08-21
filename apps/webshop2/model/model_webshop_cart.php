<?php
class model_webshop_cart extends Model
{
	function __construct()
    {
        parent::construct();
    }
	
	function check_cart($user_id)
	{
		$sql = "SELECT * FROM webshop_cart WHERE user_id='".$this->mysql->escape($user_id)."'";
		if($this->mysql->num_row($sql) > 0)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function get_cart($user_id)
	{
		$sql = "SELECT * FROM webshop_cart WHERE user_id='".$this->mysql->escape($user_id)."'";
		$result = mysql_query($sql);
		$result_array = array();
		$invalid = array();
		while($row = mysql_fetch_assoc($result))
		{
			//echo $row['item_id']."<br />";
			$sql2 = "SELECT * FROM webshop_items WHERE item_id='".$this->mysql->escape($row['item_id'])."'";
			if($this->mysql->num_row($sql2) == 0)
			{
				$invalid[] = 1;
				//echo $this->mysql->num_row($sql2)."<br />";
				//echo "wel nul";
			}else{	
				$result2 = mysql_query($sql2);
				$row2 = mysql_fetch_assoc($result2);
				$row['item_title'] = $row2['item_title'];
				$row['item_title_alias'] = $row2['item_title_alias'];
				$row['item_price2'] = str_replace(".", ",",strval($row2['item_price']));
				$row['item_price'] = $row2['item_price'];
				$row['item_amount'] = strval($row['amount']);
				$subtotal = $row['item_amount']*$row['item_price'];
				$subtotal2 = sprintf("%01.2f", $subtotal);
				$row['item_subtotal']= str_replace(".", ",",$subtotal2);
				$invalid[] = 0;
				//echo $this->mysql->num_row($sql2)."<br />";
			}
			array_push($result_array, $row);
		}
			//print_r($invalid);
			
			$eentrue=0;
			foreach($invalid as $value){
				$eentrue=$eentrue|$value;
			}
			if($eentrue){
				return 'invalid';
				//die('invalid');
				
			}else{
				return $result_array;
				
			}
			//echo $eentrue;
	}
	
	
	function add_to_cart($user_id, $item_id, $amount)
	{
		$select = "SELECT * FROM webshop_cart WHERE user_id=".$this->mysql->escape($user_id)." AND item_id=".$this->mysql->escape($item_id);
		if($this->mysql->num_row($select, $data=null) == 0)
		{
			$sql = "INSERT INTO webshop_cart (user_id,item_id,amount) VALUES (".$this->mysql->escape($user_id).", ".$this->mysql->escape($item_id).", ".$this->mysql->escape($amount).")";
			$this->mysql->query($sql, null);
			return 'success';
		}else{
			return 'Error: 444';
		}
	}
	
	function delete_cart($user_id, $item_id)
	{
		$select = "SELECT * FROM webshop_cart WHERE user_id=".$this->mysql->escape($user_id)." AND item_id=".$this->mysql->escape($item_id);
		if($this->mysql->num_row($select, null) == 1)
		{
			$sql = "DELETE FROM webshop_cart WHERE user_id=".$this->mysql->escape($user_id)." AND item_id=".$this->mysql->escape($item_id);
			$this->mysql->query($sql, null);
			return 'success';
		}else{
			return 'Error: 439';
		}
	}
	
	function get_totalprice()
	{
		$sql = "SELECT SUM(c.amount*i.item_price) as total FROM webshop_cart AS c LEFT JOIN webshop_items AS i ON i.item_id = c.item_id WHERE c.user_id=".$this->mysql->escape($_SESSION['user_id'])." GROUP BY c.user_id";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$total = str_replace(".", ",",$row['total']);
		return $total;
	}
	
	public function backup_cart($oldcart_number=null)
	{
		if(isset($oldcart_number))
		{
			$select_cart_sql = "SELECT * FROM webshop_cart WHERE user_id=".$this->mysql->escape($_SESSION['user_id']);
			$result_cart1 = mysql_query($select_cart_sql);
			if($this->mysql->num_row($select_cart_sql) > 0)
			{
				while($cart = mysql_fetch_assoc($result_cart1))
				{
					$insert_old = "INSERT INTO webshop_oldcart 
								(`oldcart_name`, `oldcart_number`, `item_id`, `amount`, `user_id`, `datetime`)
								VALUES
								('NULL', ".$oldcart_number.", ".$cart['item_id'].", ".$cart['amount'].", ".$_SESSION['user_id'].", ".date("Y-m-d").time().")";
					$this->mysql->query($insert_old);
				}
			}
		}else{
			$select_old = "SELECT oldcart_number FROM webshop_oldcart WHERE user_id=".$this->mysql->escape($_SESSION['user_id'])." ORDER BY oldcart_number DESC LIMIT 1";
			$oldcart_query1 = mysql_query($select_old);
			$old_1 = mysql_fetch_assoc($oldcart_query1);
			$old_2 = $old_1['oldcart_number']+1;
		}
	}
	
	public function empty_cart()
	{
		if(isset($_SESSION['user_id']))
		{
			$select_cart_sql = "SELECT * FROM webshop_cart WHERE user_id=".$this->mysql->escape($_SESSION['user_id']);
			if($this->mysql->num_row($select_cart_sql) > 0)
			{
				$delete_sql = "DELETE FROM webshop_cart WHERE user_id=".$this->mysql->escape($_SESSION['user_id']);
				$this->mysql->query($delete_sql);
			}
		}
	}
}