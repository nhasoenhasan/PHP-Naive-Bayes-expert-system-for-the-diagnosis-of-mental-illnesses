<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('M_User');
		$this->load->model('M_Hasil_Diagnosa');
		$this->load->model('M_Daftar');
		$this->load->model('M_Diagnosa');
	}
		
	public function index(){
		if ($this->session->userdata('ses_nama')==FALSE){
			redirect('Login/index');
		}
		else{
			$this->load->view('template/header');
			$data=$this->session->userdata('ses_IdUser');
			$profil['hasil']=$this->M_Hasil_Diagnosa->penyakit_list_byid($data);
			$profil['profil'] = $this->M_User->get_by_id_profil($data);
			
			$this->load->view('halaman/v_profil',$profil);
			$this->load->view('template/footer');
		}
	}	

	public function gantipassword(){
        $this->validasi_password();
        $password=htmlspecialchars($this->input->post('Password',TRUE),ENT_QUOTES);
		$IdUser=$this->session->userdata('ses_IdUser');
		$password=md5($password);

        $this->M_User->update($IdUser, $password);

        echo json_encode(array("status" => TRUE)); 
	}

	public function ubahdata(){
		$nama=htmlspecialchars($this->input->post('Nama',TRUE),ENT_QUOTES);
		$sex=htmlspecialchars($this->input->post('Sex',TRUE),ENT_QUOTES);
		$tanggal=htmlspecialchars($this->input->post('Tanggal',TRUE),ENT_QUOTES);
		$id=$this->session->userdata('ses_IdUser');

		$biday = new DateTime($tanggal);
        $today = new DateTime();
        $diff = $today->diff($biday);
        $usia=$diff->y ;

		$data_user = array(
            'Nama' => $nama,
			'Jenis_Kelamin' => $sex,
            'Usia'=> $usia,
            'Tgl_Lahir'=>$tanggal
		);
		
		$a=$this->M_User->update_data(array('Id_User' => $id), $data_user);
		redirect('Profil/index');
	}

	private function validasi_password()
	{
		$data = array();
		$data['status'] = TRUE;
		
	
		if($this->input->post('Password') == '')
		{
			$data['status'] = FALSE;
			$data['Wpass']='Password Harus Di Isi !!';
		}
        
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}


	public function riwayat_diagnosa(){
		if ($this->session->userdata('ses_nama')==FALSE){
			redirect('Login/index');
		}
		else{
			
			$id_user=$this->session->userdata('ses_IdUser');
			$cek_diagnosa=$this->M_Diagnosa->cek_diagnosa($id_user);

			if ($cek_diagnosa==false) {
				$this->load->view('template/header');
				$this->load->view('halaman/v_riwayat_kosong');
				$this->load->view('template/footer');
				
			} else{
				$this->load->view('template/header');
				$id_diagnosa=$this->M_Diagnosa->search_detail($id_user);
				$riwayat['hasil']=$this->M_Hasil_Diagnosa->penyakit_list_byid($id_diagnosa[0]['Id_Diagnosa']);
				$this->load->view('halaman/v_riwayat_diagnosa',$riwayat);
				$this->load->view('template/footer');
			}
			
			

		}	
	}

}
