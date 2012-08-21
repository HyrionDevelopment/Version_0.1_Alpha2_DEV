<?php
class Load_Template
{	
	//var $check_style;
	
	function __construct()
	{
		$this->settings = new settings();
		// -----------------------
		require_once('system/style/class.check_style.php');
		$this->check_style = new check_style();
	}
	
	function header2()
	{
		$this->check_style = new check_style();
		if(file_exists("header.php"))
		{
			require_once("header.php");
		}else{
			throw new Exception('Can not header found on: '.$this->check_style->default_style().'(default style)');
		}
	}
	
	function header()
	{
		$file = "styles/".$this->check_style->load()."/header.php";
		if(file_exists($file))
		{
			$file_content = file_get_contents($file);
			$key = "{WEBSITE-NAME}";
			if(strpos($file_content, $key))
			{
				$val = $this->settings->get_setting_value("website_name");
				$file_content = str_replace($key, $val, $file_content);				
			}
			
			$menu = $this->menu();
			$file_content = str_replace("{menu}", $menu, $file_content);
				
			$setting = new settings();
			$base_url = $setting->base_url();
			$file_content = str_replace("{setting.base_url}", $base_url, $file_content);
			
			
			//Webshop Categories
			$file_Webshop_Categories = "apps/webshop/model/model_webshop_category.php";
			if(file_exists($file_Webshop_Categories))
			{
				require_once($file_Webshop_Categories);
				$model_webshop_category = new model_webshop_category();
				$var1 = '';
				foreach($model_webshop_category->get_all($start=0, $end=20) as $key=>$val)
				{
					$var1 .= '<a href="'.$base_url.'webshop/category/show/'.$val['category_alias'].'">'.$val['category_name'].'</a><br />';
				}
				$file_content = str_replace("{webshop_category}", $var1, $file_content);
			}
			
			//Webshop Cart
			$file_WebshopCart = "apps/webshop/model/model_webshop_cart.php";
			$file_WebshopCart2 = "apps/webshop/model/model_webshop_cartguest.php";
			if(file_exists($file_WebshopCart) && file_exists($file_WebshopCart2))
			{
				$count = 0;
				if(isset($_SESSION['user_id']))
				{
					$sql = "SELECT * FROM webshop_cart WHERE user_id=".mysql_real_escape_string($_SESSION['user_id']);
					$result = mysql_query($sql);
					if(mysql_num_rows($result) > 0)
					{
						while($row = mysql_fetch_assoc($result))
						{
							$count = $count + $row['amount'];
						}
					}else{
						$count = 0;
					}
				}else{
					if(isset($_SESSION['webshop_cart']))
					{
						foreach($_SESSION['webshop_cart'] as $key=>$val)
						{
							foreach($val as $key2=>$val2)
							{
								$count = $count + $val2;
							}
						}						
					}
				}
				if($count == 1)
				{
					$file_content = str_replace("{webshop_cart_countitems}", "item", $file_content);
				}else{
					$file_content = str_replace("{webshop_cart_countitems}", "items", $file_content);
				}
				$file_content = str_replace("{webshop_cart_count}", $count, $file_content);
			}
			
			
			
			
			
			
			
			
			
			
			
			//Load Page V1
			if(preg_match_all("|{load_page:(.+?)}|s", $file_content, $match1))
			{
				require_once('system/cms/model/m_cms_load_page.php');
				$model_cms1 = new m_cms_load_page();
						
					//var_dump($match1[1]);	
					
					
				foreach($match1[1] as $key=>$val)
				{
					//echo $val;
					if(preg_match("# ".preg_quote("[")."(.+?)".preg_quote("]")." WHERE id=([0-9]{1,10})#", $val, $match2))
					{
						//echo "<br />";
						//var_dump($match2);
						
						if($match2[1] == "content")
						{
							$replacement1 = $model_cms1->load_page(intval($match2[2]));
							$file_content = preg_replace("#{load_page: ".preg_quote("[")."content".preg_quote("]")." WHERE id=".$match2[2]."}#", $replacement1['page_content'], $file_content, 1);
						}
						if($match2[1] == "title")
						{
							$replacement1 = $model_cms1->load_page(intval($match2[2]));
							$file_content = preg_replace("#{load_page: ".preg_quote("[")."title".preg_quote("]")." WHERE id=".$match2[2]."}#", $replacement1['page_title'], $file_content, 1);
						}
					}
				}
			}
			//
			
			
			
			return $file_content;
		}else{
			throw new Exception('Can not header found on: '.$this->check_style->load().'(default style)');
		}
	}
	
	private function menu2()
	{
		$mysql = new Mysql();
		$template = new Template_parser();
		
		$file = "styles/".$this->check_style->load()."/menu.php";
		if(file_exists($file))
		{
			$jp = "";
			for ($i = 1; $i <= 10; $i++) 
			{
				$file_content = file_get_contents($file);
				$m_cat = "SELECT * FROM menu_category WHERE menu_category_id=".$mysql->escape($i);
				$m_item = "SELECT * FROM menu_items WHERE menu_category_id=".$mysql->escape($i);
				
				$m_cat2 = "SELECT * FROM menu_category WHERE menu_category_id=".$mysql->escape($i);
				$m_item2 = "SELECT * FROM menu_items WHERE menu_category_id=".$mysql->escape($i)." ORDER BY order_by";
				
				$item_num = "";
				
				if($mysql->num_row($m_cat))
				{
					$data = array();
					if($mysql->num_row($m_item))
					{
						$data['item'] = $mysql->select_query($m_item2);
					}else{
						$data['item'] = array(array("item_name" => null));
					}
					$data['category'] = $mysql->select_query($m_cat2);
					$jp .= $template->parse('styles/default/menu',$data);
				}
			}
			return $jp;
		}else{
			throw new Exception('Can not found menu.php on: '.$this->check_style->load().'(default style)');
		}
	}
	
	private function menu()
	{
		$mysql = new Mysql();
		$settings = new Settings();
		$template = new Template_parser();
		
		$file = "styles/".$this->check_style->load()."/menu.php";
		if(file_exists($file))
		{
			$jp = "";
			for ($i = 1; $i <= 10; $i++) 
			{
				$file_content = file_get_contents($file);
				$m_cat = "SELECT * FROM menu_category WHERE order_by=".$mysql->escape($i);				
				if($mysql->num_row($m_cat) == 1)
				{
					$data = array();
					$row1 = $mysql->assoc($m_cat);
					
					$m_item = "SELECT * FROM menu_items WHERE menu_category_id=".$mysql->escape($row1['menu_category_id']);
					if($mysql->num_row($m_item))
					{
						$item = $mysql->select_query($m_item);
						$data['item'] = $item;
						$data['category'] = $mysql->select_query($m_cat);
						
						$data['base_url'] = $settings->base_url();
						$jp .= $template->parse('styles/default/menu',$data);
					}
				}
			}
			return $jp;
		}else{
			throw new Exception('Can not found menu.php on: '.$this->check_style->load().'(default style)');
		}
	}
	
	function footer()
	{
		$file = "styles/".$this->check_style->load()."/footer.php";
		if(file_exists($file))
		{
			$file_content = file_get_contents($file);
			$key = "{copyright}";
			if(strpos($file_content, $key))
			{
				$val = "&copy;".$this->settings->get_setting_value("website_name")." - 2010-2011";
				$file_content = str_replace($key, $val, $file_content);
				
				if(preg_match_all("|{load_page:(.+?)}|s", $file_content, $match1))
				{
					require_once('system/cms/model/m_cms_load_page.php');
					$model_cms1 = new m_cms_load_page();
						
					//var_dump($match1[1]);	
					
					
					foreach($match1[1] as $key=>$val)
					{
						//echo $val;
						if(preg_match("# ".preg_quote("[")."(.+?)".preg_quote("]")." WHERE id=([0-9]{1,10})#", $val, $match2))
						{
							//echo "<br />";
							//var_dump($match2);
							
							if($match2[1] == "content")
							{
								$replacement1 = $model_cms1->load_page(intval($match2[2]));
								$file_content = preg_replace("#{load_page: ".preg_quote("[")."content".preg_quote("]")." WHERE id=".$match2[2]."}#", $replacement1['page_content'], $file_content, 1);
							}
							if($match2[1] == "title")
							{
								$replacement1 = $model_cms1->load_page(intval($match2[2]));
								$file_content = preg_replace("#{load_page: ".preg_quote("[")."title".preg_quote("]")." WHERE id=".$match2[2]."}#", $replacement1['page_title'], $file_content, 1);
							}
						}
					}
				}
			}
			
			
			return $file_content;
		}else{
			throw new Exception('Can not footer found on: '.$this->check_style->default_style().'(default style)');
		}
	}
	
	function footer2()
	{
		$this->check_style = new check_style();
		if(file_exists("footer.php"))
		{
			require_once("footer.php");
		}else{
			throw new Exception('Can not footer found on: '.$this->check_style->default_style().'(default style)');
		}
	}
}