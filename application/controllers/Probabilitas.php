<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Probabilitas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('M_Probabilitas');
	}
		
	public function index(){
		if ($this->session->userdata('ses_namaadmin')==FALSE){

			redirect('Admin/login');
		}
		else{
			$this->load->view('template_admin/header');
			$data['probabilitas'] = $this->M_Probabilitas->tampil_data()->result();
			$this->load->view('admin/v_probabilitas',$data);	
			$this->load->view('template_admin/footer');		
		}	
	}

	function data_probabilitas(){
		$data=$this->M_Probabilitas->probabilitas_list();
		echo json_encode($data);
	}

	function tampil_data_gejala(){
		$data=$this->M_Probabilitas->select_list_gejala();
		echo json_encode($data);
	}
	
	function tampil_data_penyakit(){
		$data=$this->M_Probabilitas->select_list_penyakit();
		echo json_encode($data);
	}

	public function get_edit_probabilitas($id)
	{
		$data = $this->M_Probabilitas->get_by_id($id);
		echo json_encode($data);
	}

	public function tambah(){
		$this->validasi();
		$kodep=htmlspecialchars($this->input->post('KodePenyakit',TRUE),ENT_QUOTES);
		$kodeg=htmlspecialchars($this->input->post('KodeGejala',TRUE),ENT_QUOTES);
        $probabilitas=htmlspecialchars($this->input->post('Probabilitas',TRUE),ENT_QUOTES);

		
        $data_probabilitas = array(
            'Id_Penyakit' => $kodep,
            'Id_Gejala' => $kodeg,
			'nilai' => $probabilitas,
		);

		$insert = $this->M_Probabilitas->tambah_data($data_probabilitas);
		echo json_encode(array("status" => TRUE));
	}

	public function ubah(){
		$this->validasi();
		$kodep=htmlspecialchars($this->input->post('KodePenyakit',TRUE),ENT_QUOTES);
		$kodeg=htmlspecialchars($this->input->post('KodeGejala',TRUE),ENT_QUOTES);
        $probabilitas=htmlspecialchars($this->input->post('Probabilitas',TRUE),ENT_QUOTES);

        $data_probabilitas = array(
            'Id_Penyakit' => $kodep,
            'Id_Gejala' => $kodeg,
			'nilai' => $probabilitas,
		);

		$this->M_Probabilitas->update(array('Id_Probabilitas' => $this->input->post('id')), $data_probabilitas);
		echo json_encode(array("status" => TRUE));
	}

	public function hapus()
	{
		$idprobabilitas=$this->input->post('id');
		$this->M_Probabilitas->hapus($idprobabilitas);
		echo json_encode(array("status" => TRUE));
	}

	private function validasi()
	{
		$data = array();
		$data['status'] = TRUE;
		$data['csskgejala']='form-control is-valid';
		$data['csskpenyakit']='form-control is-valid';
		$data['cssprobabilitas']='form-control is-valid';
		
		if($this->input->post('KodeGejala') == 'Pilih Gejala' ) 
		{
			$data['status'] = FALSE;
			$data['Wgejala']='Kode Gejala Harus Di Isi';
			$data['csskgejala']='form-control is-invalid';
		}

		if( $this->input->post('KodeGejala') == '' ) 
		{
			$data['status'] = FALSE;
			$data['Wgejala']='Kode Gejala Harus Di Isi';
			$data['csskgejala']='form-control is-invalid';
		}

		if($this->input->post('KodePenyakit') == 'Pilih Penyakit')
		{
			$data['status'] = FALSE;
			$data['Wpenyakit']='Kode Penyakit Harus Di Isi';
			$data['csskpenyakit']='form-control is-invalid';
		}

		if($this->input->post('KodePenyakit') == '')
		{
			$data['status'] = FALSE;
			$data['Wpenyakit']='Kode Penyakit Harus Di Isi';
			$data['csskpenyakit']='form-control is-invalid';
		}

		if($this->input->post('Probabilitas') == '')
		{
			$data['status'] = FALSE;
			$data['Wprobabilitas']='Pengobatan Penyakit Harus Di Isi';
			$data['cssprobabilitas']='form-control is-invalid';
		}

        
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
