<?php
class webshop_winkelmandje extends Controller
{
	
	protected $is_session_cart;

	public function __construct()
	{
		parent::construct();
		if(isset($_SESSION['webshop_cart']))
		{
			$this->is_session_cart = 1;
		}else{
			$this->is_session_cart = 0;
		}
	}
	
	public function bekijken()
	{
		$cart_model = $this->load->model('model_webshop_cart');
		$this->load_template = new Load_Template();			
		$this->template = new Template_parser();
		$settings = new settings();
				
		if(isset($_SESSION['user_id']))
		{
			if($this->is_session_cart == 0)
			{
				if($cart_model->check_cart($_SESSION['user_id']) == true)
				{
					//print_r($cart_model->get_cart($_SESSION['user_id']));
					$data = array();
					if($cart_model->get_cart($_SESSION['user_id']) == 'invalid')
					{
						echo $this->load_template->header();
						echo "Uw winkelmandje bevat ongeldige producten. Leeg het AUB!s";
						echo $this->load_template->footer();
					}else{
						$data['webshop'] = $cart_model->get_cart($_SESSION['user_id']);	
						$data['user_id'] = $_SESSION['user_id'];
						$data['base_url'] = $settings->base_url();
						$data['total_price'] = $cart_model->get_totalprice();	
						echo $this->load_template->header();
						echo $this->template->parse('styles/default/templates/webshop/show_cart',$data);
						echo $this->load_template->footer();
					}
				}else{
					echo $this->load_template->header();
					echo "Uw winkelmandje is leeg!";
					echo $this->load_template->footer();
				}
			}elseif($this->is_session_cart == 1)
			{
				$guest_cart = new model_webshop_cartguest();
				$guest_cart->convert_2_usercart();
			}
		}
		else
		{
			if($this->is_session_cart == 0)
			{
				echo $this->load_template->header();
				echo "Uw winkelmandje is leeg!";
				echo $this->load_template->footer();
			}elseif($this->is_session_cart == 1)
			{
				/*echo "<pre>";
				print_r($_SESSION['webshop_cart']);
				echo "</pre>"; */
				$cart_guest = new model_webshop_cartguest();
				//echo  $cart_guest->get_product_info($_SESSION['webshop_cart']);
				$data['webshop'] = $cart_guest->get_product_info();
				$data['total_price'] = sprintf("%01.2f",$cart_guest->get_total_price());
				$data['user_id'] = 0;
				echo $this->load_template->header();
					echo $this->template->parse('styles/default/templates/webshop/show_cart',$data);
				echo $this->load_template->footer();
			}
		}
		//echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	}
	
	public function add_to_cart()
	{
		if(!$_POST["data"]){
			echo "Invalid data";
			exit;
		}else{
			//echo "success";
			$data = json_decode(stripslashes($_POST['data']), true);
			//print_r($data);
			$model1 = $this->load->model('model_webshop_cart');
			$item_id = intval($data['item_id']);
			if(isset($_SESSION['user_id']))
			{
				$user_id = $_SESSION['user_id'];
				if(is_numeric($item_id))
				{
					if($model1->add_to_cart($user_id,$item_id,$data['amount']) == "Error: 444")
					{
						echo "Dit product zit al in uw Winkelwagen!";
					}else{
						echo "success";
					}
				}else{
					echo "error";
				}
			}
			else
			{
				$data = json_decode(stripslashes($_POST['data']), true);
				//print_r($data);
				$_SESSION['webshop_cart'][] = array($data['item_id']=>$data['amount']);
				echo "success";
			}
		}
	}
	
	public function delete()
	{
		if(!$_POST["data"]){
			echo "Invalid data";
			exit;
		}else{
			if($this->is_session_cart == 1)
			{
				$data = json_decode(stripslashes($_POST['data']), true);
				$questcart_model = new model_webshop_cartguest($data['item_id']);
				$questcart_model->remove();
				//echo $_SESSION['webshop_cart'];
				echo "success";
			}else{			
			$data = json_decode(stripslashes($_POST['data']), true);
			//print_r($data);
			$user_id = $_SESSION['user_id'];
			$model1 = $this->load->model('model_webshop_cart');
			if(is_numeric($data['item_id']))
			{
				if($model1->delete_cart($data['user_id'],$data['item_id']) == "Error: 439")
				{
					echo "Dit product konden wij niet vinden in uw winkelmandje!";
				}else{
					echo "success";
				}
			}
			}
		}
	}
	
	function add_price_total()
	{
		$mysql = new mysql();
		$cart_model = $this->load->model('model_webshop_cart');
		$data = json_decode(stripslashes($_POST['data']), true);
		if(isset($_SESSION['user_id']))
		{
			$user_id = $_SESSION['user_id'];
		}
		
		if(!$_POST["data"]){
			echo "Invalid data";
			exit;
		}else{
			
			if($this->is_session_cart == 1)
			{
				
				
				//$questcart_model->send();
				if(is_numeric($data['amount']) && is_numeric($data['item_id']))
				{
					$questcart_model = new model_webshop_cartguest($data['item_id']);
					$questcart_model->setAmount($data['amount']);
					$questcart_model->get_total_price();
					echo sprintf("%01.2f", $questcart_model->total_price);
				}else{
					echo "0";
				}
			}else{
				//print_r($data);
				if(is_numeric($data['amount']) && is_numeric($data['item_id']))
				{
					$update = "UPDATE webshop_cart SET amount=".$mysql->escape($data['amount'])." WHERE user_id=".$mysql->escape($_SESSION['user_id'])." AND item_id=".$mysql->escape($data['item_id']);
					$mysql->query($update, $data=null);
					echo $cart_model->get_totalprice();
				}else{
					echo "0";
				}
			}
			
		}
	}
}