<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nhatkytungtbmodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='nhatkytungtb';
	}

	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('nhatkyphongmay');
		$data=$data->result_array();
		return $data;
	}

	public function layhockymoinhat(){
		$query = 'SELECT id, hocky FROM hocky ORDER BY id DESC';
		return $this->db->query($query)->row();
	}

	public function laydulieu($idphong, $ma_namsd){
		if ($idphong != "null") {
			$this->db->select('
		    	*,
				nk.id As idNhatKy,
				tk.id As idTaiKhoan
			');
			$this->db->from('nhatkytungtb nk,
				taikhoan tk, 
				nhatkytungtb_namsd namsd,
				maymocthietbi tb
				');
			$this->db->where('nk.matk = tk.id');
			$this->db->where('nk.ma_namsd = namsd.id');
			$this->db->where('nk.idtb = tb.id');
			$this->db->where('nk.maphong = '.$idphong);
			$this->db->where('nk.ma_namsd = '.$ma_namsd);
			$this->db->order_by('ngay DESC , TIME(giovao) desc');

			$arrKetQua = $this->db->get()->result_array();

			return $arrKetQua;
		}else{
			return array();
		}
	}

	public function xuatsonhatky($idphong, $ma_namsd){
	    $this->db->select('
	    	*,
	    	DATE_FORMAT(ngay,"%d %M %Y") AS datesort,
			sk.id As idNhatKy,
			tk.id As idTaiKhoan,
			tb.id As idTb
		');
		$this->db->from('nhatkytungtb sk,
			taikhoan tk, 
			maymocthietbi tb
			');
		$this->db->where('sk.matk = tk.id');
		$this->db->where('sk.idtb = tb.id');
		$this->db->where('sk.maphong = '.$idphong);
		$this->db->where('sk.ma_namsd = '.$ma_namsd);
		$this->db->order_by('datesort desc');

		$arrKetQua = $this->db->get()->result_array();

		return $arrKetQua;
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result_array();
	}


}