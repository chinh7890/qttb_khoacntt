<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nhatkybaotri_tungtbmodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='nhatkytungtb_baotri';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('nhatkytungtb_baotri');
		$data=$data->result_array();
		return $data;
	}

	public function laydulieu($namsd, $idphong){
		$query = "SELECT nk.id, nk.matb, nk.maphong, nk.ma_namsd, nk.ngaybaotri, nk.motahuhong,
		nk.noidungbaotri, nk.nguoibaotri, nk.nguoikiemtra, nk.ghichu, nk.matk,
		tb.tentb, tb.maso, FROM_UNIXTIME(ngaytao, '%d-%m-%Y') AS ngay
			FROM nhatkytungtb_baotri nk, maymocthietbi tb
			WHERE nk.matb = tb.id AND
			YEAR(nk.ngaybaotri) = ".$namsd." AND nk.maphong = ".$idphong." 
			ORDER BY ngaytao desc";
		return $this->db->query($query)->result_array();
	}

	public function xuatsonhatky($idphong, $namsd){
	    $this->db->select('
	    	*
		');
		$this->db->from('nhatkytungtb_baotri nk,
			maymocthietbi tb
			');
		$this->db->where('nk.matb = tb.id');
		$this->db->where('nk.maphong = '.$idphong);
		$this->db->where('Year(nk.ngaybaotri) = '.$namsd);
		$this->db->order_by('ngaybaotri asc');

		$arrKetQua = $this->db->get()->result_array();

		return $arrKetQua;
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result();
	}


}