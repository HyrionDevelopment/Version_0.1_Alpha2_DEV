<?php
class admin_webshop_items extends CW_Admin_Controller
{
	public function __construct()
    {
        parent::construct();
    }
	
	public function index()
	{
		$load_style = new CW_admin_loadstyle();
		$template = new Template_parser();
		$data = array();
		
		echo $load_style->header();
		
		//echo '<pre>';
		
		echo $template->parse('style/templates/webshop/load_showitems',$data);
		//echo '</pre>';
		
		echo $load_style->footer();
	}
	
	public function geheim()
	{
		$seg1 = new CW_admin_segments();
		$seg = $seg1->get_segments();
		$load_style = new CW_admin_loadstyle();
		$template = new Template_parser();
		require_once '../apps/webshop/model/model_webshop_producten.php';
		
		if(isset($seg[4]))
		{
			$data = array();
			$model_producten = new model_webshop_producten();
			$data['items'] = $model_producten->get_all_products(0, $seg[4]);
			echo $template->parse('style/templates/webshop/show_items',$data);
		}
	}
	
	public function add()
	{	
		$load_style = new CW_admin_loadstyle();
		$template = new Template_parser();
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			print_r($_POST);
			$model_additem = new model_admin_webshop_items();
			if($model_additem->add($data=$_POST) != false)
			{
				echo $load_style->header();
				echo "Succesvol aangemaakt!";
				echo $load_style->footer();
			}else{
				echo $load_style->header();
				echo "ERROR!";
				echo $load_style->footer();
			}
		}else{
			echo $load_style->header();
			echo $template->parse('style/templates/webshop/add_item',$data=null);
			echo $load_style->footer();
		}
	}
	
	public function edit()
	{
		$seg1 = new CW_admin_segments();
		$seg = $seg1->get_segments();
		$load_style = new CW_admin_loadstyle();
		$template = new Template_parser();
		$model_item = new model_admin_webshop_items();
		if(isset($seg[4]))
		{
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				//print_r($_POST);
				
				echo $load_style->header();
				if($model_item->edit($item_id=$seg[4], $data=$_POST))
				{
					echo "success";
				}else{
					echo "error";
				}
				echo $load_style->footer();
			}else{
				echo $load_style->header();
			
				if($model_item->load_product($seg[4]) != false)
				{
					$data = $model_item->load_product($seg[4]);
					echo $template->parse('style/templates/webshop/edit_item',$data);
				}else{
					echo "Product niet gevonden!";
				}
				
				echo $load_style->footer();
			}
		}
	}
}
