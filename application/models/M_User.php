<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function user_list(){
		$hasil=$this->db->query("SELECT * FROM userr");
		return $hasil->result();
	}

	public function get_by_id($id)
	{
		$this->db->from('userr');
		$this->db->where('Id_User',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_by_id_profil($id)
	{
		
		$hasil=$this->db->query("SELECT `Nama`, `Jenis_Kelamin`,`Email` ,`Pass`,`Tgl_Lahir` FROM `userr` WHERE `Id_User`=$id");
		return $hasil->result_array();
	}

	public function update($where, $data)
	{
		$hasil=$this->db->query("UPDATE `userr` SET `Pass`= '$data' WHERE `Id_User`=$where ");
		return $this->db->affected_rows();
	}

  	function tampil_data(){
		return $this->db->get('userr');
	}
		
	public function hapus($id)
	{
		$this->db->where('Id_User', $id);
		$this->db->delete('userr');
	}

	public function update_data($where, $data)
	{
		$this->db->update('userr', $data, $where);
		return $this->db->affected_rows();
	}
    
}
