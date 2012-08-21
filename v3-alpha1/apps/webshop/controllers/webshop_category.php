<?php
class webshop_category extends Controller
{
	public function __construct()
	{
		parent::construct();
	}
	
	public function show()
	{
		$this->load_template = new Load_Template();			
		$this->template = new Template_parser();
		$uri_helper = new helper_uri();
		$settings = new settings();
		
		$category = new model_webshop_producten();
		//print_r($category->GetFromCategoryAlias($CategoryAlias='test'));
		
		echo $this->load_template->header();
		if($category->GetFromCategoryAlias($CategoryAlias=$uri_helper->uri_segment(4)) == false)
		{
			echo "Niks gevonden";
		}else{
			$data = array();
			$data['webshop'] = $category->GetFromCategoryAlias($CategoryAlias=$uri_helper->uri_segment(4));
			$data['base_url'] = $settings->base_url();
			echo $this->template->parse('styles/default/templates/webshop/product_search_finded',$data);
		}
		echo $this->load_template->footer();	
			
			
			
		/*
		echo $this->load_template->header();
			echo "Pagina in onderhoud </br>";
			echo '<a href="javascript:history.go(-1)">Ga terug</a>';
		echo $this->load_template->footer();
		*/
	}
}