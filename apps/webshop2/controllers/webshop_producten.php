<?php
class webshop_producten extends Controller
{

	public function __construct()
	{
		parent::construct();
	}
	
	public function bekijk()
	{
		$uri_helper = new helper_uri();
		$settings = new settings();
		
		if($uri_helper->uri_segment(4) != false)
		{
			//echo $uri_helper->uri_segment(4);
			$model1 = $this->load->model('model_webshop_producten');
			if(is_numeric($uri_helper->uri_segment(4)))
			{
				echo "num!";
			}else{
				$pr_array = $model1->get_product_name($uri_helper->uri_segment(4));
				if(!empty($pr_array))
				{
					//print_r($pr_array);
					$data = array();
					$data['webshop'] = $model1->get_product_name($uri_helper->uri_segment(4));
					$data['base_url'] = $settings->base_url();
					
					$this->load_template = new Load_Template();			
					$this->template = new Template_parser();
					
					echo $this->load_template->header();
					echo $this->template->parse('styles/default/templates/webshop/show_product',$data);
					echo $this->load_template->footer();
				}else{
					echo "trui";
					//print_r($pr_array);
				}
			}
		}
	}
	
	public function zoeken()
	{
		$this->load_template = new Load_Template();
		$this->template = new Template_parser();
		$settings = new settings();
		
		$data=array();
		$data['base_url'] = $settings->base_url();
		
		echo $this->load_template->header();
		echo $this->template->parse('styles/default/templates/webshop/product_search',$data);
		echo $this->load_template->footer();
	}
	
	public function search_request()
	{
		$this->load_template = new Load_Template();			
		$this->template = new Template_parser();
		$settings = new settings();
		$uri_helper = new helper_uri();
		
		$model1 = $this->load->model('model_webshop_producten');
		
		if($model1->search_request($uri_helper->uri_segment(4)) == false)
		{
			echo "Niks gevonden";
		}else{
			$data = array();
			$data['webshop'] = $model1->search_request($uri_helper->uri_segment(4));
			$data['base_url'] = $settings->base_url();
			echo $this->template->parse('styles/default/templates/webshop/product_search_finded',$data);
		}
	}
	
	public function test1()
	{
		$this->template = new Template_parser();
		echo $this->template->LoadViewer('test');
	}
}