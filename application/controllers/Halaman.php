<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('M_Login');
		$this->load->model('M_Gejala');
		$this->load->model('M_Penyakit');
	}

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('halaman/v_Home');
		$this->load->view('template/footer');
	}

	public function Tentang_Penyakit()
	{
		$this->load->view('template/header');
		$data['penyakit']=$this->M_Penyakit->penyakit_list_array();
		$this->load->view('halaman/v_Tentang_Penyakit',$data);
		$this->load->view('template/footer');
	}

	public function Daftar_Penyakit()
	{
		$this->load->view('template/header');
		$this->load->view('halaman/v_Daftar_Penyakit');
		$this->load->view('template/footer');
	}

	public function Tentang_Kami()
	{
		$this->load->view('template/header');
		$this->load->view('halaman/v_Tentang_Kami');
		$this->load->view('template/footer');
	}

	public function Cek_Psikologis()
	{
		if ($this->session->userdata('ses_nama')==FALSE){
			redirect('Login/index');
		}
		else{
			redirect('Halaman/Diagnosa');
		}
	}

	public function Diagnosa()
	{	
		if ($this->session->userdata('ses_nama')==FALSE){
			redirect('Login/index');
		}
		else{
			$this->load->view('template/header');
			$data['gejala'] = $this->M_Gejala->checkbox();
			$this->load->view('halaman/v_cekpsikologis',$data);
			$this->load->view('template/footer');
		}
		
	}

	public function podcast()
	{
		$this->load->view('template/header');
		$this->load->view('halaman/v_podcast');
		$this->load->view('template/footer');
	}


}
