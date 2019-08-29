<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('M_Login');
        $this->load->model('M_Admin');
        $this->load->model('M_Hasil_Diagnosa');
	}

	public function auth(){
		$email=htmlspecialchars($this->input->post('Email',TRUE),ENT_QUOTES);
		$password=htmlspecialchars($this->input->post('Password',TRUE),ENT_QUOTES);
		
		$ceklogin = $this->M_Login->cek_login($email,$password);
		
		if($ceklogin->row_array() > 0){
			$data=$ceklogin->row_array();
			$this->session->set_userdata('admin');
			$this->session->set_userdata('ses_namaadmin',$data['Nama']);
			$this->session->set_userdata('ses_IdAdmin',$data['Id_admin']);	
			redirect('Admin/dashboard');
		}else{
			$this->session->set_flashdata('message', 
											'Akun Tidak Di Temukan!!'); 
			redirect('Admin/Login');
		}   
	}

	function logout(){
		$this->session->unset_userdata('ses_namaadmin');
		$this->session->unset_userdata('ses_IdAdmin');
		$this->session->unset_userdata('admin');
		$this->session->sess_destroy();
		$this->load->view('admin/v_login');
	}

	public function index(){
		if ($this->session->userdata('ses_namaadmin')==FALSE){

			redirect('Admin/login');
		}
		else{
			redirect('Admin/dashboard');;
		}
	}
		
	public function Login(){
		
		$this->load->view('admin/v_login');
	}

    public function dashboard(){
		if ($this->session->userdata('ses_namaadmin')==FALSE){

			redirect('Admin/login');
		}
		else{
            //Deklarasi Variabel
            $nama_penyakit=$this->M_Hasil_Diagnosa->nama_penyakit();
            $jmlchart=[];
            //Mencari Jumlah Penyakit
            foreach ($nama_penyakit as $key => $value) {

                $datachart=$this->M_Hasil_Diagnosa->chart( $value['Nama_Penyakit']);
                $datachart=count($datachart);
                array_push($jmlchart, $datachart);
            }

            //Inisial Variabel Data Chart
            //$data['chart']=$jmlchart;
            //$data['nama_penyakit']=$nama_penyakit;

             /*
            foreach ($data['nama_penyakit'] as $key => $value) {
                echo $value['Nama_Penyakit'];
            }
            -----------------------------------------------------------
            for ($i=0; $i <=4 ; $i++) { 
                echo $data['chart'][$i];
            }
            die();
            */
			$data = array(
                'detaildiagnosa'=>$this->M_Login->get_Jdetaildiagnosa(),
                'chart'=>$jmlchart,
                'nama_penyakit'=>$nama_penyakit,
				'userr' => $this->M_Login->get_Juser(),
				'penyakit' => $this->M_Login->get_Jpenyakit(),
				'gejala' => $this->M_Login->get_Jgejala(),
				'diagnosa' => $this->M_Login->get_Jdiagnosa(),
			 );
			$this->load->view('template_admin/header');
			$this->load->view('admin/v_dashboard',$data);	
			$this->load->view('template_admin/footer');	
		}
		
	}

	public function profil(){
		if ($this->session->userdata('ses_namaadmin')==FALSE){

			redirect('Admin/login');
		}
		else{
			$data['admin'] = $this->M_Admin->dataadmin();
			$this->load->view('template_admin/header');
			$this->load->view('admin/v_profil',$data);
			$this->load->view('template_admin/footer');	
		}
		
	}

	public function ubahdata(){
		$password=htmlspecialchars($this->input->post('Acpasswordnew',TRUE),ENT_QUOTES);
		$id=htmlspecialchars($this->input->post('Aid',TRUE),ENT_QUOTES);
		$nama=htmlspecialchars($this->input->post('Anama',TRUE),ENT_QUOTES);
		$username=htmlspecialchars($this->input->post('Ausername',TRUE),ENT_QUOTES);
		$email=htmlspecialchars($this->input->post('Aemail',TRUE),ENT_QUOTES);
		
		if ($password=='') {
			
			$data_admin = array(
				'Nama' => $nama,
				'username' => $username,
				'Email'=> $email
			);

		} 
		else {
			$data_admin = array(
				'Nama' => $nama,
				'username' => $username,
				'Email'=> $email,
				'Pass'=>md5($password)
			);
		}
		
		$this->M_Admin->update_data(array('Id_admin' => $id), $data_admin);
		redirect('Admin/profil');
	}
}
