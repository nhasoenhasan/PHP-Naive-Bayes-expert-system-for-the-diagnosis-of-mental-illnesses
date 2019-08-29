<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Daftar extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	
    public function tambah_akun($data_register){
		$this->db->insert('userr',$data_register);
	    return $this->db->insert_id();
    }

    public function cek_email($email){
		$this->db->where('email', $email);
        $query = $this->db->get('userr');
        if( $query->num_rows() > 0 ){ 
            return TRUE; 
        } else { 
            return FALSE; 
        }
    }
    
    
}
