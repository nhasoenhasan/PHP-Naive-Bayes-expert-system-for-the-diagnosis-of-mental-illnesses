<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Gejala extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function gejala_list(){
		$hasil=$this->db->query("SELECT * FROM gejala");
		return $hasil->result();
	}

	public function get_by_id($id)
	{
		$this->db->from('gejala');
		$this->db->where('Id_Gejala',$id);
		$query = $this->db->get();

		return $query->row();
		
	}

  	function tampil_data(){
		return $this->db->get('gejala');
	}

	function checkbox(){
		$query=$this->db->query("SELECT * FROM gejala");
		return $query;
	}
		
	public function tambah_data($data_gejala){
		$this->db->insert('gejala',$data_gejala);
	  return $this->db->insert_id();
	}
	
	public function update($where, $data)
	{
		$this->db->update('gejala', $data, $where);
		return $this->db->affected_rows();
	}

	public function hapus($id)
	{
		$this->db->where('Id_Gejala', $id);
		$this->db->delete('gejala');
	}

	public function cek_kode($kode){
		$this->db->where('Id_Gejala', $kode);
        $query = $this->db->get('gejala');
        if( $query->num_rows() > 0 ){ 
            return TRUE; 
        } else { 
            return FALSE; 
        }
	}
	
	function gejala_list_array($id){ 
		$this->db->from('gejala');
		$this->db->where('Id_Gejala',$id);
		$query = $this->db->get();
		return $query->result_array();
    }
    
    function gejala_nama_array($id){ 
        $this->db->select('nama_gejala');
		$this->db->from('gejala');
		$this->db->where('Id_Gejala',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
    
}
