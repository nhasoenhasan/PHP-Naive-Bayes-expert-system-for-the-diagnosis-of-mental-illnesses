<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyakit extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('M_Penyakit');
	}
		
	public function index(){
		if ($this->session->userdata('ses_namaadmin')==FALSE){

			redirect('Admin/login');
		}
		else{
			$this->load->view('template_admin/header');
			$data['penyakit'] = $this->M_Penyakit->tampil_data()->result();
			$this->load->view('admin/v_penyakit',$data);	
			$this->load->view('template_admin/footer');		
		}
       
	}

	function data_penyakit(){
		$data=$this->M_Penyakit->penyakit_list();
		echo json_encode($data);
	}

	public function get_edit_penyakit($id)
	{
		$data = $this->M_Penyakit->get_by_id($id);
		echo json_encode($data);
	}

	public function tambah(){

		$this->validasi();
		$kodep=htmlspecialchars($this->input->post('KodePenyakit',TRUE),ENT_QUOTES);
		$namap=htmlspecialchars($this->input->post('NamaPenyakit',TRUE),ENT_QUOTES);
        $infop=htmlspecialchars($this->input->post('InformasiPenyakit',TRUE),ENT_QUOTES);
        $saranp=htmlspecialchars($this->input->post('SaranPenyakit',TRUE),ENT_QUOTES);
		$probabilitasp=htmlspecialchars($this->input->post('ProbabilitasPenyakit',TRUE),ENT_QUOTES);

		$cek_kode=$this->M_Penyakit->cek_kode($kodep);

        $data_penyakit = array(
			'Id_Penyakit'=>$kodep,
            'Nama_Penyakit' => $namap,
            'Informasi' => $infop,
			'saran' => $saranp,
			'P_penyakit'=> $probabilitasp,
		);

		if($cek_kode==false){
			$insert = $this->M_Penyakit->tambah_data($data_penyakit);
			echo json_encode(array("status" => TRUE));
		}else{
			$data['status'] = FALSE;
			$data['Wkode']='Kode Penyakit Sudah Ada';
			$data['csskode']='form-control is-invalid';
			$data['cssnama']='form-control is-valid';
			$data['cssinformasi']='form-control is-valid';
			$data['csssaran']='form-control is-valid';
			$data['cssprobabilitas']='form-control is-valid';
			echo json_encode($data);
		}
	}

	public function ubah(){
		$this->validasi();
		$namap=htmlspecialchars($this->input->post('NamaPenyakit',TRUE),ENT_QUOTES);
        $infop=htmlspecialchars($this->input->post('InformasiPenyakit',TRUE),ENT_QUOTES);
        $saranp=htmlspecialchars($this->input->post('SaranPenyakit',TRUE),ENT_QUOTES);
		$probabilitasp=htmlspecialchars($this->input->post('ProbabilitasPenyakit',TRUE),ENT_QUOTES);

        $data_penyakit = array(
            'Nama_Penyakit' => $namap,
            'Informasi' => $infop,
			'saran' => $saranp,
			'P_penyakit'=> $probabilitasp,
		);

		$this->M_Penyakit->update(array('Id_Penyakit' => $this->input->post('KodePenyakit')), $data_penyakit);
		echo json_encode(array("status" => TRUE));
	}

	public function hapus()
	{
		$idpenyakit=$this->input->post('id');
		$this->M_Penyakit->hapus($idpenyakit);
		echo json_encode(array("status" => TRUE));
	}

	private function validasi()
	{
		$data = array();
		$data['status'] = TRUE;
		$data['csskode']='form-control is-valid';
		$data['cssnama']='form-control is-valid';
		$data['cssinformasi']='form-control is-valid';
		$data['csssaran']='form-control is-valid';
		$data['cssprobabilitas']='form-control is-valid';
		
	
		if($this->input->post('KodePenyakit') == '')
		{
			$data['status'] = FALSE;
			$data['Wkode']='Kode Penyakit Harus Di Isi';
			$data['csskode']='form-control is-invalid';
		}
		
		if($this->input->post('NamaPenyakit') == '')
		{
			$data['status'] = FALSE;
			$data['Wnama']='Nama Penyakit Harus Di Isi';
			$data['cssnama']='form-control is-invalid';
		}

		if($this->input->post('InformasiPenyakit') == '')
		{
			$data['status'] = FALSE;
			$data['Winformasi']='Informasi Penyakit Harus Di Isi';
			$data['cssinformasi']='form-control is-invalid';
		}

		if($this->input->post('SaranPenyakit') == '')
		{
			$data['status'] = FALSE;
			$data['Wsaran']='Saran Penyakit Harus Di Isi';
			$data['csssaran']='form-control is-invalid';
		}


		if($this->input->post('ProbabilitasPenyakit') == '')
		{
			$data['status'] = FALSE;
			$data['Wprobabilitas']='Nilai Probabilitas Penyakit Harus Di Isi';
			$data['cssprobabilitas']='form-control is-invalid';
		}
        
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
