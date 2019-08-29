<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Penyakit extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function penyakit_list(){
		$hasil=$this->db->query("SELECT * FROM penyakit");
		return $hasil->result();
	}

	public function get_by_id($id)
	{
		$this->db->from('penyakit');
		$this->db->where('Id_Penyakit',$id);
		$query = $this->db->get();

		return $query->row();
	}

  function tampil_data(){
		return $this->db->get('penyakit');
	}
		
	public function tambah_data($data_penyakit){
		$this->db->insert('penyakit',$data_penyakit);
	  	return $this->db->insert_id();
	}
	
	public function update($where, $data)
	{
		$this->db->update('penyakit', $data, $where);
		return $this->db->affected_rows();
	}

	public function hapus($id)
	{
		$this->db->where('Id_Penyakit', $id);
		$this->db->delete('penyakit');
	}

	public function cek_kode($kode){
		$this->db->where('Id_Penyakit', $kode);
        $query = $this->db->get('penyakit');
        if( $query->num_rows() > 0 ){ 
            return TRUE; 
        } else { 
            return FALSE; 
        }
	}
	
	function penyakit_list_array(){
		$hasil=$this->db->query("SELECT * FROM penyakit");
		return $hasil->result_array();
	}
    
}
