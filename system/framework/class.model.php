<?php
abstract class Model extends index
{
	protected $database;
	protected $load;
	protected $mysql;
	public $mysqli;
	public $Hyrion_mysqli;

	public function __construct() { 
        parent::__construct(); 
    } 
	
	function construct()
	{
		//require_once 'class.mysql.php';

		//$this->mysql = new Mysql();
		$this->load = new Load();
		//$this->mysql_helper = $this->load->helper('mysql_helper');
	}
}
?>