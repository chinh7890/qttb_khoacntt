<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nhatkytungtbcontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('donvi/donvimodel');
		$this->load->model('nguoidung/hockymodel');
		$this->load->model('donvi/phong_khomodel');
		$this->load->model('maymocthietbi/danhsachmaymocthietbimodel');

		$this->load->model('nguoidung/hockymodel');
		$this->load->model('nguoidung/taikhoanmodel');
		$this->load->model('nguoidung/nhatkytungtbmodel');
		$this->load->model('nguoidung/nhatkymodel');
		$this->load->model('nguoidung/nhatkytungtb_namsdmodel');
		$this->load->model('nguoidung/nhatkybaotri_tungtbmodel');
	}

	public function index()
	{
		$this->reloadPage();
	}

	function reloadPage($mess = ""){
		$donvi = $this->donvimodel->getAlldata();
		$data = array();
		$data['donvi'] = $donvi;
		$input['where'] = array("madonvi" => $this->session->userdata("madonvi"));
		$data['phong'] = $this->phong_khomodel->get_list($input);
		$data['giaovien'] = $this->taikhoanmodel->get_list($input);
		$data['arr_namsd'] = $this->nhatkytungtb_namsdmodel->layNamSD();
		$data['hocky'] = $this->hockymodel->laydanhsach($this->session->userdata("madonvi"));
		$data['mess'] = $mess; 
		$this->load->view('ghiso/nhatkytungtb', $data);
	}

	public function laythietbi(){
		$idphong = $this->input->post('idphong');
		$idhocky= $this->input->post('idhocky');

        $arrKetQua = $this->nhatkytungtbmodel->laydulieu($idphong,$idhocky);
        
        $data = array(
            'mangketqua' => $arrKetQua
        );
        echo json_encode($data);
	}

	public function themnhatky(){
		$ma_namsd = $this->input->post('namsd_add');
		$ngay = $this->input->post('ngaycu');
		$iduser = $this->input->post("gvcu");

		$idtb = $this->input->post('thietbi');

		$idphong = $this->input->post('idphongcu');
		$giovao = $this->input->post('giovaocu');
		$giora = $this->input->post('gioracu');
		$mucdich = $this->input->post('mucdichcu');
		$tinhtrangtruoc = $this->input->post('tinhtrangtruoccu');
		$tinhtrangsau = $this->input->post('tinhtrangsaucu');

		$data = array(
			'idtb' => intval($idtb),
			'maphong' => intval($idphong),
			'matk' => intval($iduser),
			'ma_namsd' => $ma_namsd,
			'ngay' => $ngay,
			'giovao' => $giovao,
			'giora' => $giora,
			'mucdichsd' => $mucdich,
			'tinhtrangtruoc' => $tinhtrangtruoc,
			'tinhtrangsau' => $tinhtrangsau,
			'ngaytao' => time()
		);

		$this->nhatkytungtbmodel->create($data);
		redirect(nguoidung_url('nhatkytungtbcontroller/index'),'refresh');
	}

	public function capnhatnhatky(){
		$id = $this->input->post('idUpdate');
		$giovao = $this->input->post('giovao');
		$giora = $this->input->post('giora');
		$mucdich = $this->input->post('mucdich');
		$tinhtrangtruoc = $this->input->post('tinhtrangtruoc');
		$tinhtrangsau = $this->input->post('tinhtrangsau');

		$data = array(
			'giovao' => $giovao,
			'giora' => $giora,
			'mucdichsd' => $mucdich,
			'tinhtrangtruoc' => $tinhtrangtruoc,
			'tinhtrangsau' => $tinhtrangsau
		);

		$this->nhatkytungtbmodel->update($id, $data);
		redirect(nguoidung_url('nhatkytungtbcontroller/index'),'refresh');
	}

	public function xoanhatky()
	{
		$id = $this->uri->segment(4);	
		$this->nhatkytungtbmodel->delete($id);
		redirect(nguoidung_url('nhatkytungtbcontroller/index'),'refresh');
	}

	public function laydulieu()
	{
		$idphong = $this->input->post('idphong');
		$ma_namsd= $this->input->post('ma_namsd');

        $arrKetQua = $this->nhatkytungtbmodel->laydulieu($idphong, $ma_namsd);
        
        $data = array(
            'mangketqua' => $arrKetQua,
        );
        echo json_encode($data);
	}

	public function xuatsonhatky()
	{
		$idPhong = $this->input->post('phongmayin');
		$ma_namsd = $this->input->post('namsdin');

		// LẤY NHẬT KÝ SỬ DỤNG
		$arrNhatKy = $this->nhatkytungtbmodel->xuatsonhatky($idPhong, $ma_namsd);

		// LẤY DANH MỤC THIẾT BỊ PHÒNG
		$input['where'] = array('maphongkho' => $idPhong);
		$arr = $this->danhsachmaymocthietbimodel->get_list($input);

		$path = public_url("bieumau/nhatkysdtb_in.docx");
		// $path = $_SERVER['DOCUMENT_ROOT']."\public\bieumau\\nhatkysdtb_in.docx";
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);

		// đặt tên phòng
		$rsphong = $this->phong_khomodel->laygvql($idPhong); 

		// Năm sử dụng
		$rs_namsd = $this->nhatkytungtb_namsdmodel->get_info($ma_namsd);

		$templateProcessor->setValues(array(
			'maphong'=> $rsphong->maphong,
			'gvql' => $rsphong->hoten,
			'namhoc' => $rs_namsd->namsd,
			'hocky' => ""
		));

		//table
		$table = new \PhpOffice\PhpWord\Element\Table([
		    'borderSize' => 6, 
		    'borderColor' => 'black', 
		    'spaceBefore'=>0,
			'spaceAfter'=>0,
			'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
			'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER
		]);
		
		// style header
		$myFontStyle = array('name' => 'Minion Pro', 'size' => 11, 'bold' => true);
		$myParagraphStyle = array('align'=>'center', 'spaceBefore'=>50, 'spaceafter' => 50);
		$styleVCell = array('valign'=>'center'); 

		// Header
		$table->addRow();
		$table->addCell(500,$styleVCell)->addText('STT', $myFontStyle, $myParagraphStyle );
		$table->addCell(1500,$styleVCell)->addText('Mã', $myFontStyle, $myParagraphStyle );
		$table->addCell(10000,$styleVCell)->addText('Tên', $myFontStyle, $myParagraphStyle );
		$table->addCell(1000,$styleVCell)->addText('Năm sử dụng', $myFontStyle, $myParagraphStyle );
		$table->addCell(1000,$styleVCell)->addText('Trang', $myFontStyle, $myParagraphStyle );

		// row data
		$dataFontStyle = array('name' => 'Minion Pro', 'size' => 11,'spaceBefore'=>0,
		'spaceAfter'=>0,
		'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
		'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);
		
		// danh mục thiết bị
		$index = 0;
		$page = 5;
		foreach ($arr as $data) {
			$table->addRow();
			$index ++;

			$table->addCell(500,$styleVCell)->addText($index, $dataFontStyle, $myParagraphStyle );
			$table->addCell(1500,$styleVCell)->addText($data->maso, $dataFontStyle, $myParagraphStyle );
			$table->addCell(10000,$styleVCell)->addText($data->tentb, $dataFontStyle, $myParagraphStyle );
			$table->addCell(1000,$styleVCell)->addText($data->namsd, $dataFontStyle, $myParagraphStyle );
			$table->addCell(1000,$styleVCell)->addText($page, $dataFontStyle, $myParagraphStyle );
			$page++;
		}
		$templateProcessor->setComplexBlock('table', $table);

		$templateProcessor->setValue('pageBreakHere', '<w:br />');

		// nhật ký sử dụng
		$replacements = array();
		foreach ($arr as $data){
			$mangdulieu = array(
				'matb' => $data->maso, 
				'tentb' => $data->tentb,
				'model' => $data->model,
				'namsd' => $data->namsd,
				'chatluong' => $data->chatluong."%",
				'ghichu' => $data->ghichu
			);

			if($this->kiemtraNhatKy($data->id, $arrNhatKy)) 
			{ 
				$i = 1;
				foreach ($arrNhatKy as $nk){
					if($nk['idtb'] == $data->id){
						$mangdulieu['ngay'.$i] = date("d/m/Y", strtotime($nk['ngay']));
						$mangdulieu['giovao'.$i] = $nk['giovao'];
						$mangdulieu['giora'.$i] = $nk['giora'];
						$mangdulieu['mucdich'.$i] = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $nk['mucdichsd']);
						$mangdulieu['tinhtrangtruoc'.$i] = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $nk['tinhtrangtruoc']);
						$mangdulieu['tinhtrangsau'.$i] = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $nk['tinhtrangsau']);
						$mangdulieu['hoten'.$i] = $nk['hoten'];
						$i++;
					}
				}
				if($i < 5){
					for($in = $i ; $in <=6 ; $in++){
						$mangdulieu['ngay'.$in] = "";
						$mangdulieu['giovao'.$in] = "";
						$mangdulieu['giora'.$in] = "";
						$mangdulieu['mucdich'.$in] = "";
						$mangdulieu['tinhtrangtruoc'.$in] = "";
						$mangdulieu['tinhtrangsau'.$in] = "";
						$mangdulieu['hoten'.$in] = "";
					}
				}
			}else{
				for( $in = 1; $in<= 6 ; $in++){
					$mangdulieu['ngay'.$in] = "";
					$mangdulieu['giovao'.$in] = "";
					$mangdulieu['giora'.$in] = "";
					$mangdulieu['mucdich'.$in] = "";
					$mangdulieu['tinhtrangtruoc'.$in] = "";
					$mangdulieu['tinhtrangsau'.$in] = "";
					$mangdulieu['hoten'.$in] = "";
				}
			}

			$mangdulieu['pageBreakHere_table'] = '<w:p><w:r><w:br w:type="page"/></w:r></w:p>';
			array_push($replacements, $mangdulieu);
		}
		$templateProcessor->cloneBlock('block_name', $index, true, false, $replacements);


		
		header("Content-Disposition: attachment; filename=NhatKySuDungTB.docx");
		$templateProcessor->saveAs("php://output");
	}

	function kiemtraNhatKy($idtb, $arrNhatKy){
		foreach ($arrNhatKy as $value) {
			if($value['idtb'] == $idtb)
				return true;
		}
		return false;
	}

	public function timphongmay(){
		$request = $this->input->post('q');

		$query = "SELECT id,maphong, tenphong
		FROM phong_kho 
		WHERE maphong LIKE '".$request."%' order by maphong asc LIMIT 10";
        $result = $this->phong_khomodel->setQuery($query);

		echo json_encode($result);;
	}


	// THÊM NĂM SỬ DỤNG
	public function themnamsd(){
		$namsd = $this->input->post('namsd');
		$data = array(
			'namsd' => $namsd,
			'ngaytao' => time()
		);

		$mess = "";
		if($this->nhatkytungtb_namsdmodel->check_exists(array('namsd'=> $namsd))){
			$mess = "Năm sử dụng này đã có";
		}else{
			if($this->nhatkytungtb_namsdmodel->create($data)){
				$mess = "Thêm thành công";
			}else{
				$mess = "Thêm thất bại";
			}
		}

		$this->reloadPage($mess);
	}

	public function xoanamsd()
	{
		$id = $this->uri->segment(4);	
		if($this->nhatkytungtbmodel->check_exists(array('ma_namsd'=> $id))){
			$mess = "Không thể xóa. Do vẫn còn nhật ký của năm này";
		}else{
			if($this->nhatkytungtb_namsdmodel->delete($id)){
				$mess = "Xóa thành công";
			}else{
				$mess = "Xóa thất bại";
			}
		}
		
		$this->reloadPage($mess);
	}



	//=============== NHẬT KÝ BẢO TRÌ SỬA CHỮA ======================
	public function thembaotri(){
		$idphong = $this->input->post('idphong');
		$iduser = $this->session->userdata("id");
		$ma_namsd = $this->input->post("namsd_baotri");
		$ngaybaotri = $this->input->post('ngaybaotri');

		$motabaotri = $this->input->post('motabaotri');
		$noidungbaotri = $this->input->post('noidungbaotri');
		$nguoibaotri = $this->input->post('nguoibaotri');
		$nguoikiemtra = $this->input->post('nguoikiemtra');
		$ghichubaotri = $this->input->post('ghichubaotri');

		$arr_tb = $this->input->post('thietbi');

		$ngaybaotri = DateTime::createFromFormat('d/m/Y', $ngaybaotri);
		$ngaybaotri = $ngaybaotri->format('Y-m-d');

		foreach ($arr_tb as $id){
			$data = array(
				'matb' => intval($id),
				'maphong' => intval($idphong),
				'ma_namsd' => $ma_namsd,
				'matk' => intval($iduser),
				'ngaybaotri' => $ngaybaotri,
				'motahuhong' => $motabaotri,
				'noidungbaotri' => $noidungbaotri,
				'nguoibaotri' => $nguoibaotri,
				'nguoikiemtra' => $nguoikiemtra,
				'ghichu' => $ghichubaotri,
				'ngaytao' => time()
			);
			$this->nhatkybaotri_tungtbmodel->create($data);
		}

		$this->reloadPage();
	}

	public function capnhatbaotri(){
		$id = $this->input->post('idUpdate');
		$iduser = $this->session->userdata("id");
		$ngaybaotri = $this->input->post('ngaybaotri');
		$motabaotri = $this->input->post('motabaotri');
		$noidungbaotri = $this->input->post('noidungbaotri');
		$nguoibaotri = $this->input->post('nguoibaotri');
		$nguoikiemtra = $this->input->post('nguoikiemtra');
		$ghichubaotri = $this->input->post('ghichubaotri');

		$ngaybaotri = DateTime::createFromFormat('d/m/Y', $ngaybaotri);
		$ngaybaotri = $ngaybaotri->format('Y-m-d');

		$data = array(
			'user_update' => intval($iduser),
			'ngaybaotri' => $ngaybaotri,
			'motahuhong' => $motabaotri,
			'noidungbaotri' => $noidungbaotri,
			'nguoibaotri' => $nguoibaotri,
			'nguoikiemtra' => $nguoikiemtra,
			'ghichu' => $ghichubaotri
		);

		$this->nhatkybaotri_tungtbmodel->update($id, $data);
		$this->reloadPage();
	}

	public function xoabaotri()
	{
		$id = $this->uri->segment(4);	
		$this->nhatkybaotri_tungtbmodel->delete($id);
		$this->reloadPage();
	}

	public function laydulieubaotri()
	{
		$ma_namsd= $this->input->post('ma_namsd');
		$idphong= $this->input->post('idphong');

        $arrKetQua = $this->nhatkybaotri_tungtbmodel->laydulieu($ma_namsd, $idphong);
        
        $data = array(
            'mangketqua' => $arrKetQua,
        );
        echo json_encode($data);
	}

	public function xuatnkbaotri()
	{
		$idPhong = $this->input->post('phongmayin');
		$namsdin = $this->input->post('namsdin');

		// LẤY NHẬT KÝ BẢO TRÌ
		$arrNhatKy = $this->nhatkybaotri_tungtbmodel->xuatsonhatky($idPhong, $namsdin);

		// LẤY DANH MỤC THIẾT BỊ PHÒNG
		$input['where'] = array('maphongkho' => $idPhong);
		$arr = $this->danhsachmaymocthietbimodel->get_list($input);

		// $path = public_url("bieumau/NhatKyBaoTri.docx");
		$path = $_SERVER['DOCUMENT_ROOT']."\public\bieumau\\NhatKyBaoTri.docx";

		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);

		// đặt tên phòng
		$rsphong = $this->phong_khomodel->get_info_rule(array('id' => $idPhong)); 
		$templateProcessor->setValues(array('tenphong'=> $rsphong->maphong));

		//table
		$table = new \PhpOffice\PhpWord\Element\Table([
		    'borderSize' => 6, 
		    'borderColor' => 'black', 
		    'spaceBefore'=>0,
			'spaceAfter'=>0,
			'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
			'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER
		]);
		
		// style header
		$myFontStyle = array('name' => 'Minion Pro', 'size' => 11, 'bold' => true);
		$myParagraphStyle = array('align'=>'center', 'spaceBefore'=>50, 'spaceafter' => 50);
		$styleVCell = array('valign'=>'center'); 

		// Header DANH MỤC
		$table->addRow();
		$table->addCell(500,$styleVCell)->addText('STT', $myFontStyle, $myParagraphStyle );
		$table->addCell(1000,$styleVCell)->addText('Mã', $myFontStyle, $myParagraphStyle );
		$table->addCell(11000,$styleVCell)->addText('Tên', $myFontStyle, $myParagraphStyle );
		$table->addCell(1000,$styleVCell)->addText('Năm sử dụng', $myFontStyle, $myParagraphStyle );
		$table->addCell(2000,$styleVCell)->addText('Trang', $myFontStyle, $myParagraphStyle );

		// row data DANH MỤC
		$dataFontStyle = array('name' => 'Minion Pro', 'size' => 13,'spaceBefore'=>0,
		'spaceAfter'=>0,
		'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
		'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);
		
		$index = 1;
		foreach ($arr as $data) {
			$table->addRow();
			$table->addCell(500,$styleVCell)->addText($index, $dataFontStyle, $myParagraphStyle );
			$table->addCell(1000,$styleVCell)->addText($data->maso, $dataFontStyle, $myParagraphStyle );
			$table->addCell(10000,$styleVCell)->addText($data->tentb, $dataFontStyle, $myParagraphStyle );
			$table->addCell(2000,$styleVCell)->addText($data->namsd, $dataFontStyle, $myParagraphStyle );
			$table->addCell(2000,$styleVCell)->addText($data->ghichu, $dataFontStyle, $myParagraphStyle );
			$index ++;
		}

		$templateProcessor->setComplexBlock('table', $table);

		// nhật ký bảo trì
		$replacements = array();
		foreach ($arr as $data){
			$mangdulieu = array(
				'matb' => $data->maso, 
				'tentb' => $data->tentb,
				'model' => $data->model,
				'namsd' => $data->namsd,
				'chatluong' => $data->chatluong."%",
				'ghichu' => $data->ghichu
			);

			if($this->kiemtraNhatKy_Baotri($data->id, $arrNhatKy)) 
			{ 
				$i = 1;
				foreach ($arrNhatKy as $nk){
					if($nk['matb'] == $data->id){
						$mangdulieu['ngaybaotri'.$i] = date("d-m-Y", strtotime($nk['ngaybaotri']));
						$mangdulieu['mota'.$i] = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $nk['motahuhong']);
						$mangdulieu['noidung'.$i] = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $nk['noidungbaotri']);
						$mangdulieu['ghichu'.$i] = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $nk['ghichu']);
						$mangdulieu['nguoibaotri'.$i] = $nk['nguoibaotri'];
						$mangdulieu['nguoikiemtra'.$i] = $nk['nguoikiemtra'];
						$i++;
					}
				}
				if($i <= 5){
					for($in = $i ; $in <=5 ; $in++){
						$mangdulieu['ngaybaotri'.$in] = "";
						$mangdulieu['mota'.$in] = "";
						$mangdulieu['noidung'.$in] = "";
						$mangdulieu['nguoibaotri'.$in] = "";
						$mangdulieu['nguoikiemtra'.$in] = "";
						$mangdulieu['ghichu'.$in] = "";
					}
				}
			}else{
				for( $in = 1; $in<= 5 ; $in++){
					$mangdulieu['ngaybaotri'.$in] = "";
					$mangdulieu['mota'.$in] = "";
					$mangdulieu['noidung'.$in] = "";
					$mangdulieu['nguoibaotri'.$in] = "";
					$mangdulieu['nguoikiemtra'.$in] = "";
					$mangdulieu['ghichu'.$in] = "";
				}
			}

			$mangdulieu['pageBreakHere'] = '<w:p><w:r><w:br w:type="page"/></w:r></w:p>';
			array_push($replacements, $mangdulieu);
		}
		$templateProcessor->cloneBlock('block_name', $index, true, false, $replacements);

		header("Content-Disposition: attachment; filename=NhatKyBaoTri.docx");
		$templateProcessor->saveAs("php://output");
	}

	function kiemtraNhatKy_Baotri($idtb, $arrNhatKy){
		foreach ($arrNhatKy as $value) {
			if($value['matb'] == $idtb)
				return true;
		}
		return false;
	}


}
require 'vendor/autoload.php';