<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('M_User');
	}
		
	public function index(){
		if ($this->session->userdata('ses_namaadmin')==FALSE){

			redirect('Admin/login');
		}
		else{
			$this->load->view('template_admin/header');
			$data['user'] = $this->M_User->tampil_data()->result();
			$this->load->view('admin/v_user',$data);	
			$this->load->view('template_admin/footer');		
		}
       
	}

	function data_user(){
		$data=$this->M_User->user_list();
		echo json_encode($data);
	}

	public function get_edit_user($id)
	{
		$data = $this->M_User->get_by_id($id);
		echo json_encode($data);
	}

	public function hapus()
	{
		$iduser=$this->input->post('id');
		$this->M_User->hapus($iduser);
		echo json_encode(array("status" => TRUE));
	}

	
}
