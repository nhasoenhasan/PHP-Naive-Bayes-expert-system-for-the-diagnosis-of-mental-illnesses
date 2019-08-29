<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gejala extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('M_Gejala');
	}
		
	public function index(){
		if ($this->session->userdata('ses_namaadmin')==FALSE){

			redirect('Admin/login');
		}
		else{
			$this->load->view('template_admin/header');
			$data['gejala'] = $this->M_Gejala->tampil_data()->result();
			$this->load->view('admin/v_gejala',$data);	
			$this->load->view('template_admin/footer');
		}
	}

	function data_gejala(){
		$data=$this->M_Gejala->gejala_list();
		echo json_encode($data);
	}

	public function get_edit_gejala($id)
	{
		$data = $this->M_Gejala->get_by_id($id);
		echo json_encode($data);
	}

	public function tambah(){
		$this->validasi();
		$namag=htmlspecialchars($this->input->post('NamaGejala',TRUE),ENT_QUOTES);
		$kodeg=htmlspecialchars($this->input->post('KodeGejala',TRUE),ENT_QUOTES);

		$cek_kode=$this->M_Gejala->cek_kode($kodeg);

        $data_gejala = array(
			'Id_Gejala' => $kodeg,
			'nama_gejala' => $namag,
		);

		if($cek_kode==false){
			$insert = $this->M_Gejala->tambah_data($data_gejala);
			echo json_encode(array("status" => TRUE));
		}else{
			$data['status'] = FALSE;
			$data['Wkode']='Kode Gejala Sudah Ada';
			$data['csskgejala']='form-control is-invalid';
			$data['cssnama']='form-control is-valid';
			echo json_encode($data);
		}		
	}

	public function ubah(){
		$namag=htmlspecialchars($this->input->post('NamaGejala',TRUE),ENT_QUOTES);

        $data_gejala = array(
            'nama_gejala' => $namag,
		);

		$this->M_Gejala->update(array('Id_Gejala' => $this->input->post('KodeGejala')), $data_gejala);
		echo json_encode(array("status" => TRUE));
	}

	public function hapus()
	{
		$idgejala=$this->input->post('id');
		$this->M_Gejala->hapus($idgejala);
		echo json_encode(array("status" => TRUE));
	}

	private function validasi()
	{
		$data = array();
		$data['status'] = TRUE;
		$data['csskgejala']='form-control is-valid';
		$data['cssnama']='form-control is-valid';
		
		if($this->input->post('KodeGejala') == '')
		{
			$data['status'] = FALSE;
			$data['Wkode']='Kode Gejala Harus Di Isi';
			$data['csskgejala']='form-control is-invalid';
		}

		if($this->input->post('NamaGejala') == '')
		{
			$data['status'] = FALSE;
			$data['Wnama']='Nama Gejala Harus Di Isi';
			$data['cssnama']='form-control is-invalid';
		}
        
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
