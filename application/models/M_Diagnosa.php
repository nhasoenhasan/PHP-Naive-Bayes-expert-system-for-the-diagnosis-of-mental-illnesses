<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Diagnosa extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function gejala_list(){
		$hasil=$this->db->query("SELECT * FROM penyakit");
		return $hasil->result();
    }

    function get_penyakit(){
		$query=$this->db->query("SELECT * FROM penyakit");
		return $query->result_array();
	}

	function get_nama_penyakit(){
		$query=$this->db->query("SELECT * FROM penyakit");
		return $query->result_array();
	}
    
    public function get_Jpenyakit(){
		$this->db->from('penyakit');
  		return $num_rows = $this->db->count_all_results();
	}

	//Nilai Probabilitas gejala terhadap penyakit
	public function get_probabilitas($data1, $data2){
		
		$this->db->from('probabilitas');
		$this->db->where('Id_Penyakit',$data1);
		$this->db->where('Id_Gejala',$data2);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambah_data_diagnosa($data_diagnosa){
		$this->db->insert('diagnosa_user',$data_diagnosa);
	  	return $this->db->insert_id();
	}

	public function tambah_data_detail_diagnosa($data_detail_diagnosa){
       
        $this->db->insert('detail_diagnosa_user',$data_detail_diagnosa);
      
        return $this->db->insert_id();
        
          
	}

	public function cek_diagnosa($kodeu){
		$this->db->where('Id_User', $kodeu);
        $query = $this->db->get('diagnosa_user');
        if( $query->num_rows() > 0 ){ 
            return TRUE; 
        } else { 
            return FALSE; 
        }
	}
	
	public function search_detail($id){	
		$this->db->from('diagnosa_user');
		$this->db->where('Id_User',$id);
		$query = $this->db->get();
		return $query->result_array();
    }
    
   
  
}
