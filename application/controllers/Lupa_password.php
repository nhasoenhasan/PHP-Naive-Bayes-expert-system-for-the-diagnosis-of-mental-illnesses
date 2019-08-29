<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lupa_password extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('M_Reset_Password');
	}
		
	public function index(){
        
		$this->load->view('template/header');
		$this->load->view('halaman/v_lupapassword');	
		$this->load->view('template/footer');		
		
    }
    
    public function cekemail(){
        
        $email = $this->input->post('user_email');
        $findemail = $this->M_Reset_Password->ForgotPassword($email);
       
        //memuat halaman konfirmasi password
        //$this->load->view('forgotpassword');
        if ($findemail) {
            $this->M_Reset_Password->sendpassword($findemail);
        } else {
              $this->session->set_flashdata('msg', 'Email Tidak Di Temukan');
              redirect('Lupa_password/index');
    
        }
    }

	
}
