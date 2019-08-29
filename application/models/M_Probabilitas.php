<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Probabilitas extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function probabilitas_list(){
		$this->db->select('*');
		$this->db->from('probabilitas'); 
    	$query = $this->db->get(); 
		return $query->result();
	}

	function select_list_gejala(){
		$this->db->select('*');
		$this->db->from('gejala');
    	$query = $this->db->get(); 
		return $query->result();
	}

	function select_list_penyakit(){
		$this->db->select('*');
		$this->db->from('penyakit');
    	$query = $this->db->get(); 
		return $query->result();
	}

	public function get_by_id($id)
	{
		$this->db->from('probabilitas');
		$this->db->where('Id_Probabilitas',$id);
		$query = $this->db->get();

		return $query->row();
	}

  function tampil_data(){
		return $this->db->get('penyakit');
	}
		
	public function tambah_data($data_penyakit){
		$this->db->insert('probabilitas',$data_penyakit);
	  return $this->db->insert_id();
	}
	
	public function update($where, $data)
	{
		$this->db->update('probabilitas', $data, $where);
		return $this->db->affected_rows();
	}

	public function hapus($id)
	{
		$this->db->where('Id_Probabilitas', $id);
		$this->db->delete('probabilitas');
	}
    
}
