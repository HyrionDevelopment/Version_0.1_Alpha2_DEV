<?php
//ini_set('error_reporting', 'E_all');
//ini_set('display_errors', 1);

session_name("Hyrion_Session");
session_start();


//framework
require_once 'system/framework/class.app_folders.php';
require_once 'system/framework/class.URI_index.php';
require_once 'system/framework/class.load_controller_class.php';
require_once 'system/framework/class.controller.php';
require_once 'system/framework/class.model.php';
require_once 'system/class.load.php';
require_once 'system/class.settings.php';

require_once 'system/framework/hrf_login.php';

//style
require_once 'system/style/class.template_parser.php';
require_once 'system/style/class.load_template.php';

//cms
require_once 'system/cms/controller/cms_login.php';
require_once 'system/cms/controller/cms_ucp.php';
require_once 'system/cms/model/m_cms_login.php';
require_once 'system/cms/model/m_cms_load_page.php';
require_once 'system/cms/controller/cms_load_page.php';

//helpers
//require_once 'system/framework/helpers/class.mysql_helper.php';
//require_once 'system/framework/helpers/class.login_helper.php';
require_once 'system/framework/helpers/helper_uri.php';

//system
require_once 'system/cw_permissions.php';
require_once 'system/class.settings.php';

//MySQLi niet meer nodig nu hebben we PDO
//require_once 'system/framework/hrf_mysqli.php';

$app_folders = new app_folders;
//$app_folders->begin();

$URI_index = new URI_index;
//$URI_index->begin();

//PDO
require_once 'system/db_init.php';

class index
{
	
	function begin()
	{

		try
		{
			check_db_auto_connect();
			if(DEFINED('DB_AUTO_CONNECT') && DB_AUTO_CONNECT == true)
			{
				db_connect();
			}
			
			/*if(!DEFINED('DB_AUTO_CONNECT'))
			{
				$db = db_connect();
			}*/

			$setting = new settings();
			$GLOBALS['root'] = $setting->path_url();
			
			//1 b
			$app_folders = new app_folders();
			$URI_index = new URI_index();
			$URI_a = $URI_index->begin();
			// 1e
			
			//2 b
			$noobje2 = $this->dump($URI_index->begin());
			$noobje = $this->dump($app_folders->begin());
			//2 e
			
			//3 b
			//print_r($noobje);
			//print_r($noobje2);
			
			$hrf_login = new hrf_login();
			$hrf_login->secure_login();
			
			$this->include_app();
			
			if($URI_a == false)
			{
				$seg = $URI_index->get_segments();
				if($seg[1] == "login")
				{
					header('location: '.$setting->base_url().'ucp/login/');
				}elseif($seg[1] == "ucp")
				{
					$URI_a['app'] = "cms";
					$URI_a['controller'] = "ucp";
					if(isset($seg[2]))
					{
						$URI_a['actie'] = $seg[2];
					}else{
						$URI_a['actie'] = "home";
					}
				}elseif($seg[1] == "homepage"){
					$URI_a['app'] = "cms";
					$URI_a['controller'] = "load_page";
					$URI_a['actie'] = "home";
				}elseif($seg[1] == "page"){
					$URI_a['app'] = "cms";
					$URI_a['controller'] = "load_page";
					if(isset($seg[2]))
					{
						$URI_a['actie'] = "load";
					}else{
						$URI_a['actie'] = "error_404";
					}
				}
			}
			$permission_class = new cw_permissions();
			$rank_id = $permission_class->get_rank_id();
			//$login_helper = new Login_helper();
			
			//$login_helper->must_login();
			
			if($permission_class->HR_Check_function_permissions($URI_a['app'], $URI_a['controller'],$URI_a['actie']) == true)
			{
			
			
				//if($permission_class->check_app_permissions($URI_a['app'], $rank_id) == false)
				//{
					$lc = new Load_controller_class($URI_a['app'], $URI_a['controller'],$URI_a['actie']);
					return $lc->load_function();
				/*}else{
					return "error! No Access!";
				}*/
				
				
			}else{
				return "error! No Access!2";
			}
			
			
			//3 e
		}
		catch (Exception $ex)
		{
			//Laad error class en geef foutmelding mee aan class.
			//$error = new Error($ex);
			//Voer fout afhandel functie uit.
			//$error->handel_exception_af();
			///////////////////////
			echo '<pre>';
			print_r($ex);
			echo '</pre>'; 
			//////////////////////
			
			$pos = strpos($ex->getMessage(), '#404');
			if ($pos != false) {
				$error_num = '404';
				$error_name = 'Page not found.';
				$this->load_template = new Load_Template();
				echo $this->load_template->header();
				
				$template = new Template_parser();
				$data = array('error_num'  => $error_num,
							  'error_name' => $error_name);
				echo $template->parse('styles/default/templates/error',$data);
				
				echo $this->load_template->footer();
			}else{
				echo "unknown error!";
			}
		}
		catch (Error $ex)
		{
			echo 'foutje!';
		}
	}
	
	function include_app()
	{
		$URI_index = new URI_index();
		$URI_a = $URI_index->begin();
		
		//include controllers
		$glob1 = glob("apps/".$URI_a['app']."/controllers/*.php");
		if(count($glob1) > 0)
		{
			foreach($glob1 as $file_ti)
			{
				require_once $file_ti;
			}
		}
				
		//include models
		$glob1 = glob("apps/".$URI_a['app']."/model/*.php");
		if(count($glob1) > 0)
		{
			foreach($glob1 as $file_ti)
			{
				require_once $file_ti;
			}
		}
	
	}
	
	function dump($in) 
	{
		ob_start();
		$out= "<pre>";
		print_r($in);
		$out.= ob_get_contents();
		ob_end_clean();
		$out.= "</pre>";
		return $out;
	}
}
$start_index = new index;
echo $start_index->begin();
?>