<?php
class model_webshop_orders extends Model
{
	
	protected $oder_id, $item_id;
	protected $loaded_class;
	
	public function __construct($order_id=null, $item_id=null)
	{
		parent::construct();
		if(isset($item_id))
		{
			$this->item_id = $item_id;
		}elseif(isset($order_id))
		{
			$this->order_id = $order_id;
		}
	}
	
	public function load($x, $data=null)
	{
		switch($x)
		{
			case "overview":
				if(isset($data))
				{
					return $this->load_overview($data);
				}else{
					return $this->load_overview();
				}
			break;
		}
	}
	
	public function load_overview($data=null)
	{
		$sql = "SELECT * FROM webshop_orders WHERE user_id=".$this->mysql->escape($_SESSION['user_id']);
		$result = $this->mysql->query($sql);
		$result_array = array();
		//return $this->mysql->select_query($sql);
			
		while($row = $this->mysql->fetch_assoc($result))
		{
			$sql2 = "SELECT * FROM webshop_order_items WHERE order_id=".$this->mysql->escape($row['order_id']);
			$result2 = $this->mysql->query($sql2);
			$order_data_array = array();
			while($row2 = $this->mysql->fetch_assoc($result2))
			{
				$item_id = $row2['item_id'];
				$order_data_array[] = array('item_id' => $item_id,
											'amount' => $row2['amount']);
			}
			//print_r ( $order_data_array );
			$row['order_data'] = $order_data_array;
			array_push($result_array, $row);
		}
		return $result_array;
	}
	
	public function load_order($order_id, $parser=false)
	{
		$select = "SELECT * FROM webshop_order_items WHERE order_id='".$this->mysql->escape($order_id)."'";
		$select_query = mysql_query($select);
		$return = array();
		if($parser == true)
		{
			while($row = mysql_fetch_assoc($select_query))
			{
				$select2 = "SELECT * FROM webshop_items WHERE item_id=".$this->mysql->escape($row['item_id']);
				$select2_query = mysql_query($select2);
				$row2 = mysql_fetch_assoc($select2_query);
				
				$return[] = array(
								'item_id' => $row['item_id'],
								'amount' => $row['amount'],
								'item_name' => $row2['item_title'],
								'item_alias' => $row2['item_title_alias'],
								'item_ppe' => $row2['item_price'],
								'item_price' => $row2['item_price']*$row['amount'],
								
							);
			}
		}else{
			
		}
		return $return;
	}
	
	public function get_totalprice($order_id)
	{
		$sql = "SELECT SUM(c.amount*i.item_price) as total FROM webshop_order_items AS c LEFT JOIN webshop_items AS i ON i.item_id = c.item_id WHERE c.order_id=".$this->mysql->escape($order_id)." GROUP BY c.order_id";
		//echo $order_id;
		$result = mysql_query($sql)or die(mysql_error());
		$row = mysql_fetch_assoc($result);
		
		return $row['total'];
	}
	
}