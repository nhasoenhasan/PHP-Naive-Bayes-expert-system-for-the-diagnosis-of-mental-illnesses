<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function dataadmin(){
		$hasil=$this->db->query("SELECT * FROM admn");
		return $hasil->result_array();
    }
    
    public function update_data($where, $data)
	{
		$this->db->update('admn', $data, $where);
		return $this->db->affected_rows();
	}


    
}
