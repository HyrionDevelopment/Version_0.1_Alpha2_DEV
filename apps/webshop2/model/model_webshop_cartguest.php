<?php
class model_webshop_cartguest extends Model
{
	
	protected $return = array();
	protected $guest_cart;
	protected $cartmodel;
	public $total_price = 0;
	
	protected $item_id, $amount;
	
	protected $old_amount;
	
	public function __construct($item_id=null)
    {
        parent::construct();
		$this->guest_cart = $_SESSION['webshop_cart'];
		if(isset($item_id))
		{
			$this->item_id = $item_id;
		}
    }
	
	public function setAmount($amount)
	{
		//$item_id = intval($item_id);
		$amount = intval($amount);
		foreach($_SESSION['webshop_cart'] as $key => $array1)
		{
			foreach($array1 as $i_id => $aantal)
			{
				if($i_id == $this->item_id)
				{
					$this->guest_cart[$key][$i_id] = $amount;
					$_SESSION['webshop_cart'][$key][$i_id] = $amount;
				}
			}
		}
	}
	
	public function remove()
	{
		foreach($_SESSION['webshop_cart'] as $key => $array1)
		{
			foreach($array1 as $i_id => $aantal)
			{
				if($i_id == $this->item_id)
				{
					unset($_SESSION['webshop_cart'][$key]);
				}
			}
		}
	}
	
	public function get_product_info()
	{
		
		foreach($this->guest_cart as $key1=>$val1)
		{
			foreach($val1 as $key2=>$val2)
			{
				$this->item_id = $key2;
				$this->amount = $val2;
				$this->get_product_by_id();
			}
		}
		/*echo "<pre>";
		print_r( $this->return );
		echo "</pre>";*/
		
		return $this->return;
	}
	
	public function get_total_price()
	{
		foreach($_SESSION['webshop_cart'] as $num=>$cart)
		{
			foreach($cart as $item_id => $amount)
			{
				$sql = "SELECT * FROM webshop_items WHERE item_id=".$this->mysql->escape($item_id);
				$result = mysql_query($sql);
				while($row = mysql_fetch_assoc($result))
				{
					$lineprice = $row['item_price'] * $amount;
				}
				$this->total_price = $this->total_price + $lineprice;
			}
		}
		return $this->total_price;
	}
	
	private function get_product_by_id()
	{
		$sql1 = "SELECT * FROM webshop_items WHERE item_id=".$this->mysql->escape($this->item_id);
		if($this->mysql->num_row($sql1) == 1)
		{
			$sql = "SELECT * FROM webshop_items WHERE item_id=".$this->mysql->escape($this->item_id);
			$result = mysql_query($sql);
			while($row = $this->mysql->fetch_assoc($result))
			{
				$row['item_price2'] = str_replace(".", ",", strval($row['item_price']));
				$row['item_amount'] = $this->amount;
				$subtotal = $row['item_price']*$this->amount;
				$subtotal2 = sprintf("%01.2f", $subtotal);
				$row['item_subtotal']= str_replace(".", ",",$subtotal2);
				$this->return[]=$row;
			}
		}
	}
		
	public function send()
	{
		
	}
	
	public function convert_2_usercart()
	{
		$this->cartmodel = new model_webshop_cart();
		if(isset($_SESSION['user_id']) && isset($_SESSION['webshop_cart']))
		{
			$select_old = "SELECT oldcart_number FROM webshop_oldcart WHERE user_id=".$this->mysql->escape($_SESSION['user_id'])." ORDER BY oldcart_number DESC LIMIT 1";
			$oldcart_query1 = mysql_query($select_old);
			$old_1 = mysql_fetch_assoc($oldcart_query1);
			$old_2 = $old_1['oldcart_number']+1;
			foreach($_SESSION['webshop_cart'] as $webshop_array1)
			{
				foreach($webshop_array1 as $key => $val)
				{
					//echo "key: ".$key."<br />";
					//echo "val: ".$val."<br />";
										
					$this->cartmodel->backup_cart($old_2);
					$this->cartmodel->empty_cart();
					
					$select = "SELECT * FROM webshop_cart WHERE user_id=".$this->mysql->escape($_SESSION['user_id'])." AND item_id=".$this->mysql->escape($key);
					if($this->mysql->num_row($select) < 1)
					{
						$sql = "INSERT INTO webshop_cart (`user_id`, `item_id`, `amount`)VALUES(".$this->mysql->escape($_SESSION['user_id']).", ".$this->mysql->escape($key).", ".$this->mysql->escape($val).")";
						$this->mysql->query($sql);
					}
					unset($_SESSION['webshop_cart']);
					$settings = new settings();
					//header('location: '.$settings->base_url().'/webshop/winkelmandje/bekijken');
					//echo date().time();
					echo "<br />";
					echo $old_2;
				}
			}
		}
	}
}