<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
        $this->load->model('M_Daftar');
        $this->load->model('M_Login');
	}


	public function daftar(){
        
        $this->validasi();
        
		$nama=htmlspecialchars($this->input->post('Nama',TRUE),ENT_QUOTES);
        $tanggal=htmlspecialchars($this->input->post('Tanggal',TRUE),ENT_QUOTES);
        $kelamin=htmlspecialchars($this->input->post('JKelamin',TRUE),ENT_QUOTES);
        $password=htmlspecialchars($this->input->post('Password',TRUE),ENT_QUOTES);
        $email=htmlspecialchars($this->input->post('Email',TRUE),ENT_QUOTES);

        $biday = new DateTime($tanggal);
        $today = new DateTime();
        $diff = $today->diff($biday);
        $usia=$diff->y ;
        

        $cek_email=$this->M_Daftar->cek_email($email);
        
        

        $data_register = array(
            'Nama' => $nama,
            'Pass' => md5($password),
			'Jenis_Kelamin' => $kelamin  ,
            'Usia'=> $usia,
            'Tgl_Lahir'=>$tanggal,
			'Email' => $email
		);

        if ($cek_email==false) {
            $daftar = $this->M_Daftar->tambah_akun($data_register);
            $ceklogin = $this->M_Login->cek_data($email,$password);
            $data=$ceklogin->row_array();
            $this->session->set_userdata('masuk');
			$this->session->set_userdata('ses_nama',$data['Nama']);
			$this->session->set_userdata('ses_IdUser',$data['Id_User']);
            echo json_encode(array("status" => TRUE)); 
        } else {
			$data['status'] = FALSE;
			$data['Wemailcek']='Email udah DiGunakan  Gunakan';
            $data['cssemail']='form-control is-invalid';
            $data['cssnama']='form-control ';
            $data['csspass']='form-control ';
            echo json_encode($data);
        }
        
        
    }
    
    public function validasi()
	{
		//die("Hai");
		$data = array();
		$data['status'] = TRUE;
		$data['cssnama']='form-control ';
		$data['cssemail']='form-control ';
		$data['csspass']='form-control ';
		
	
		if($this->input->post('Nama') == '')
		{
			$data['status'] = FALSE;
			$data['Wnama']='Nama Harus Di Isi';
			$data['cssnama']='form-control is-invalid';
		}
		
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
