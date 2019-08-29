<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	
    public function cek_data($email,$password){
		$query=$this->db->query("SELECT * FROM userr WHERE Email ='$email' AND Pass=MD5('$password')");
        return $query;
	}
	
	public function cek_login($email,$password){
		$query=$this->db->query("SELECT * FROM admn WHERE Email ='$email' AND Pass=MD5('$password')");
        return $query;
	}
	
	public function get_Juser(){
		$this->db->from('userr');
  		return $num_rows = $this->db->count_all_results();
	}

	public function get_Jpenyakit(){
		$this->db->from('penyakit');
  		return $num_rows = $this->db->count_all_results();
	}

	public function get_Jgejala(){
		$this->db->from('gejala');
  		return $num_rows = $this->db->count_all_results();
	}

	public function get_Jdiagnosa(){
		$this->db->from('diagnosa_user');
  		return $num_rows = $this->db->count_all_results();
    }
    
    public function get_Jdetaildiagnosa(){
		$this->db->from('detail_diagnosa_user');
  		return $num_rows = $this->db->count_all_results();
	}
    
    
}
