<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->helper('url_helper');
		$this->load->model('M_Login');
	}

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('halaman/v_cekpsikologis_login');
		$this->load->view('template/footer');
	}

	public function auth(){
		$this->validasi();
		$email=htmlspecialchars($this->input->post('Email',TRUE),ENT_QUOTES);
        $password=htmlspecialchars($this->input->post('Password',TRUE),ENT_QUOTES);
		
		$ceklogin = $this->M_Login->cek_data($email,$password);
		
		if($ceklogin->row_array() > 0){
			$data=$ceklogin->row_array();
			$this->session->set_userdata('masuk');
			$this->session->set_userdata('ses_nama',$data['Nama']);
			$this->session->set_userdata('ses_IdUser',$data['Id_User']);
			echo json_encode(array("status" => TRUE));
		}else{
			$data['cssemail']='form-control ';
			$data['csspass']='form-control ';
			$data['status'] = FALSE;
			$data['Wauth']='Akun Tidak Di Temukan';
			echo json_encode($data);
		}   
	}

	function logout(){
		$this->session->unset_userdata('ses_nama');
		$this->session->unset_userdata('ses_IdUser');
		$this->session->unset_userdata('masuk');
		
		$this->session->sess_destroy();
		
		redirect('Login/index');
	}

	public function validasi()
	{
		$data = array();
		$data['status'] = TRUE;
		$data['cssemail']='form-control ';
		$data['csspass']='form-control ';
		
		if($this->input->post('Email') == '')
		{
			$data['status'] = FALSE;
			$data['Wemail']='Email Harus Di Isi';
			$data['cssemail']='form-control is-invalid';
		}
	
		if($this->input->post('Password') == '')
		{
			$data['status'] = FALSE;
			$data['Wpass']='Password Harus Di Isi';
			$data['csspass']='form-control is-invalid';
        }
		
        
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
