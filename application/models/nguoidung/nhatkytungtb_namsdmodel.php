<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nhatkytungtb_namsdmodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='nhatkytungtb_namsd';
	}

	
	public function layNamSD()
	{
		$query = "SELECT * FROM `nhatkytungtb_namsd` ORDER BY namsd";
		return $this->db->query($query)->result();
	}


}