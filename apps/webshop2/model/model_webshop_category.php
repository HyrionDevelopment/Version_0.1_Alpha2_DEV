<?php
class model_webshop_category extends Model
{
	public function __construct()
    {
        parent::construct();
    }
	
	public function get_all($start='', $end='')
	{
		$array1 = array();
		$sql = "SELECT * FROM webshop_categories LIMIT ".$this->mysql->escape($start).", ".$this->mysql->escape($end);
		if($this->mysql->num_row($sql) > 0)
		{
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result))
			{
				array_push($array1, $row);
			}
		}
		return $array1;
	}
}