<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class nhatkymodel extends My_model
{

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table = 'nhatkyphongmay';
		$this->table = 'nhatkyqlphong';
	}

	public function getAlldata()
	{
		$this->db->select('*');
		$data = $this->db->get('nhatkyphongmay');
		$data = $data->result_array();
		return $data;
	}

	public function layhockymoinhat()
	{
		$query = 'SELECT id, hocky FROM hocky WHERE current = 1';
		return $this->db->query($query)->row();
	}

	public function laydulieu($idphong, $idhocky)
	{
		if ($idphong != "null") {
			$this->db->select('
		    	*,
				nk.id As idNhatKy,
				tk.id As idTaiKhoan
			');
			$this->db->from('nhatkyphongmay nk,
				taikhoan tk, 
				hocky hk
				');
			$this->db->where('nk.matk = tk.id');
			$this->db->where('nk.mahocky = hk.id');
			$this->db->where('nk.maphong = ' . $idphong);
			$this->db->where('nk.mahocky = ' . $idhocky);
			$this->db->order_by('ngay DESC , TIME(giovao) desc');

			$arrKetQua = $this->db->get()->result_array();

			return $arrKetQua;
		} else {
			return array();
		}
	}

	public function sodophongmay($idphong)
	{
		if ($idphong != "null") {
			$this->db->select('
		    	id,tentb,mota, somay, tinhtrang,ghichutinhtrang
				
			');
			$this->db->from('maymocthietbi');
			$this->db->where('somay IS NOT NULL');
			$this->db->where('maphongkho = ' . $idphong);
			$this->db->order_by('somay asc');

			$arrKetQua = $this->db->get()->result_array();

			return $arrKetQua;
		} else {
			return array();
		}
	}

	public function tengvql($idphong, $idhocki)
	{
		if ($idphong != "null") {
			// $query = 'SELECT tk.hoten as tengv FROM taikhoan tk, phong_kho pk WHERE pk.magvql = tk.id AND pk.id = '.$idphong;
			$query = 'SELECT tk.hoten as tengv
		 	FROM taikhoan tk, nhatkyqlphong nk, hocky hk, phong_kho pk 
		 	WHERE tk.id=nk.magvql and nk.maphong= pk.id and hk.id=nk.mahocky
		 	AND hk.id=' . $idhocki . ' and pk.id= ' . $idphong;
			return $this->db->query($query)->row();
		} else {
			return "";
		}
	}

	public function xuatsonhatky($idphong, $idhocky)
	{
		$this->db->select('
	    	*,
	    	TIME_FORMAT(giovao, "%H:%i") AS timeSort,
			nk.id As idNhatKy,
			tk.id As idTaiKhoan
			
		');
		$this->db->from('nhatkyphongmay nk,
			taikhoan tk
			');
		$this->db->where('nk.matk = tk.id');
		// $this->db->where('nk.mahocky = hk.id');
		$this->db->where('nk.maphong = ' . $idphong);
		$this->db->where('nk.mahocky = ' . $idhocky);
		$this->db->order_by('ngay asc, timeSort asc');

		$arrKetQua = $this->db->get()->result_array();
		return $arrKetQua;
	}

	public function queryDB($query)
	{
		return $this->db->query($query)->result_array();
	}
	//code mới
	public function themlichsuqlphong($data)
	{
		$this->db->db_debug = false;

		if (!@$this->db->insert('nhatkyqlphong', $data)) {
			$error = $this->db->error();
			return false;
		} else {
			return $this->db->insert_id();
		}
	}
}
