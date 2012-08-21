<?php
class webshop_checkout extends Controller
{

	public function __construct()
	{
		parent::construct();
		$this->check_orderid();
	}
	
	public function step1()
	{
		$seg_helper = new helper_uri();
		//echo $seg_helper->uri_segment(4);
		
		$order_model = new model_webshop_orders();
		
		/*echo "<pre>";
		print_r($order_model->load_order($seg_helper->uri_segment(4), true));
		echo "</pre>";*/
		
		$this->load_template = new Load_Template();			
		$this->template = new Template_parser();
		
		$data = array();
		$data['order'] = $order_model->load_order($seg_helper->uri_segment(4), true);
		$data['order_id'] = $seg_helper->uri_segment(4);
		$data['total_price'] = $order_model->get_totalprice($seg_helper->uri_segment(4));
		
		echo $this->load_template->header();
		echo $this->template->parse('styles/default/templates/webshop/checkout/step1',$data);
		echo $this->load_template->footer();
		
	}
	
	public function step2()
	{
		$this->load_template = new Load_Template();			
		$this->template = new Template_parser();
		
		$profile_model = new model_profile_edit();
		$seg_helper = new helper_uri();
		
		$data = array();
		if($profile_model->check_profile($_SESSION['user_id']) == 1)
		{
			$data['box_text'] = 'Gegevens check sucessvol volbracht! Letop! de profiel gegevens zijn de gegevens voor verzenden van pakketjes.<br /><br />U kunt gerust veder gaan. klik <a href="#">hier</a> als u de profiel gegevens wil wijzigen.';
			$data['img_url'] = 'http://cdn1.iconfinder.com/data/icons/CrystalClear/32x32/actions/agt_action_success.png';
			$data['box_color'] = 'green';
			$data['next_step'] = '<div style="float: right;"><a href="{setting.base_url}webshop/checkout/step3/'.$seg_helper->uri_segment(4).'/">Volende stap!</a></div>';
		}elseif($profile_model->check_profile($_SESSION['user_id']) == 0){
			$data['box_text'] = 'Error: Uw heeft geen gegevens ingevult op de profiel pagina of u bent wat vergeten intevullen.<br /><br />klik <a href="#">hier</a> uw gevevens te bewerken.';
			$data['img_url'] = 'http://cdn1.iconfinder.com/data/icons/crystalproject/32x32/actions/agt_action_fail.png';
			$data['box_color'] = 'red';
			$data['next_step'] = '';
		}
			
		echo $this->load_template->header();
		echo $this->template->parse('styles/default/templates/webshop/checkout/step2',$data);
		//echo $profile_model->check_profile($_SESSION['user_id']);
		echo $this->load_template->footer();
		
	}
	
	public function step3()
	{
		//Transportmiddel kiezen
		$this->load_template = new Load_Template();			
		$this->template = new Template_parser();
		
		$profile_model = new model_profile_edit();
		if($profile_model->check_profile($_SESSION['user_id']) == 1)
		{
			$sql = "SELECT * FROM webshop_transport_options";
			$query = mysql_query($sql);
			$transport = array();
						
			while($row = mysql_fetch_assoc($query))
			{
				array_push($row, $transport);
			}
			
			$data = array();
			$data['transport'] = $transport;
			
			echo $this->load_template->header();
			echo $this->template->parse('styles/default/templates/webshop/checkout/step3',$data);
			echo $this->load_template->footer();
		}
	}
	
	public function step4()
	{
		
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			//Afmaken van stap3
			
			
			
			
			
			//
			
			//Begin Stap4 Betalingsmiddel kiezen
			
			
			
			
			
			
			//
		}	
	}
	
	private function check_orderid()
	{
		$setting = new settings();
		$seg_helper = new helper_uri();
		$sql = "SELECT * FROM webshop_orders WHERE order_id=".$seg_helper->uri_segment(4);
		$query = mysql_query($sql);
		
		if(mysql_num_rows($query) == 1)
		{
			$row = mysql_fetch_assoc($query);
			if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id'])
			{
				return true;
			}else{
				header('location: '.$setting->base_url());
			}
		}
	}
	
}