<?php
class Config
{
	//DB
	var $config_db_host='localhost';
	var $config_db_user='';
	var $config_db_pass='';
	var $config_db_name='';
	
	//Automatic DB Connect (Default is false)
	var $config_db_auto_connect = true;

	//DB type default mysql
	var $config_db_type = 'mysql';
	
	//DB Table Prefix (default is: 'hr_')
	var $config_db_prefix = 'hr_';
	
	var $config_show_debuginfo = true;
}
?>