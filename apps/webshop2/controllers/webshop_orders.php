<?php
class webshop_orders extends Controller
{
	
	protected $oders_model;
	
	public function __construct()
	{
		parent::construct();
	}
	
	public function overview()
	{
		$this->load_template = new Load_Template();			
		$this->template = new Template_parser();
	
		echo $this->load_template->header();
		
			$this->oders_model = new model_webshop_orders();
			
			/*echo "<pre>";
			print_r ( $this->oders_model->load("overview") );
			echo "</pre>"; */
			
			$data=array();
			$data['orders'] = $this->oders_model->load("overview");
			
			echo $this->template->parse('styles/default/templates/webshop/overview',$data);
		
		echo $this->load_template->footer();
	}
	
	public function add()
	{
		$data = eval('array(0 => "hallo")');
		//$data = array(0 => "hallo");
		echo $data[0];
	}
	
	public function cart_2_order()
	{
		$mysql = new mysql();
		if(isset($_POST['data']))
		{	
			$data = json_decode($_POST['data'], true);
			if(isset($_SESSION['user_id']))
			{
				
				$select_sql = "SELECT * FROM webshop_cart WHERE user_id=1";
				$select_result = mysql_query($select_sql);
				if(mysql_num_rows($select_result) > 0)
				{
					$sql1 = "INSERT INTO webshop_orders (user_id, paid)VALUES(".$mysql->escape($_SESSION['user_id']).",".$mysql->escape(0).")";
					mysql_query($sql1);
					
					$id = mysql_insert_id();
					echo $id;
					
					while($row1 = $mysql->fetch_assoc($select_result))
					{
						$sql2 = "INSERT INTO webshop_order_items (order_id, item_id, amount)VALUES(".$id." , ".$mysql->escape($row1['item_id']).", ".$mysql->escape($row1['amount']).")";
						mysql_query($sql2);
					}
				}else{
					echo 'q1';
				}
			}else{
				echo 'q2';
			}
		}else{
			echo 'error';
		}
	}
	
}