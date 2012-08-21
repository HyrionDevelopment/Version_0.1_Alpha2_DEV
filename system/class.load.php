<?php
class Load
{
	function model($model, $data = null)
	{	
		if($data)
		{
	 		return new $model($data);
		}
		else
		{
			return new $model();
		}
	}
	
	function helper($helper, $data = null)
	{
		if($data)
		{
	 		return new $helper($data);
		}
		else
		{
			return new $helper();
		}
	}
	
	function libary($libary, $data = null)
	{
		if($data)
		{
	 		return new $libary($data);
		}
		else
		{
			return new $libary();
		}
	}
	
	public function extern($app,$type,$class_name)
	{
		require_once('apps/'.$app.'/'.$type.'/'.$class_name.'.php');
	}
	
	public function extern_advanced($path)
	{
		require_once('apps/'.$path);
	}
	
	public function extern_adv($path)
	{
		return $this->extern_advanced($path);
	}
}
?>