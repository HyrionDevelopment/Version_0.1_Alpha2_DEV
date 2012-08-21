<?php
class test_test2 extends Controller
{
	function __construct()
	{
		parent::construct();
		
	}
	
	function test3()
	{
		//$noob = $this->load->model('model_test_test5');
		//$noob->noobje();
		echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		
		$this->load->extern_adv('webshop/controllers/webshop_orders.php');
		$test2 = new webshop_orders();
		$test2->overview();
	}
	
	function test4()
	{
		$testjen = $this->load->model('model_test_test5');
		echo "<pre>";
		print_r ($testjen->mysql_test());
		echo "</pre>";
	}
}