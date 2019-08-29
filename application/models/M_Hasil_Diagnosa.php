<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Hasil_Diagnosa extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function diagnosa_list(){
		$hasil=$this->db->query("SELECT diagnosa_user.Id_Diagnosa, userr.Nama,userr.Jenis_Kelamin,userr.Email FROM (diagnosa_user INNER JOIN userr ON diagnosa_user.Id_User = userr.Id_User)");
        return $hasil->result();
    }
    
    function diagnosa_cetak(){
		$hasil=$this->db->query("SELECT diagnosa_user.Id_Diagnosa, userr.Nama,userr.Jenis_Kelamin,userr.Email FROM (diagnosa_user INNER JOIN userr ON diagnosa_user.Id_User = userr.Id_User)");
        return $hasil->result_array();
	}

	function penyakit_list_byid($id){
		$hasil=$this->db->query("SELECT detail_diagnosa_user.id_detail_diagnosa, penyakit.Nama_Penyakit,detail_diagnosa_user.Nama_Gejala,detail_diagnosa_user.Tanggal,detail_diagnosa_user.presentase,detail_diagnosa_user.Nama_Penyakit_lain,detail_diagnosa_user.presentase_lain
		FROM (detail_diagnosa_user 
		INNER JOIN penyakit ON detail_diagnosa_user.Id_Penyakit = penyakit.Id_Penyakit)
		WHERE detail_diagnosa_user.Id_Diagnosa=$id  ORDER BY detail_diagnosa_user.Tanggal DESC");
		return $hasil->result_array();
    }

    function hasil_diagnosa_bytanggal($id,$awal,$akhir){
       
		$hasil=$this->db->query("SELECT detail_diagnosa_user.id_detail_diagnosa, penyakit.Nama_Penyakit,detail_diagnosa_user.Nama_Gejala,detail_diagnosa_user.Tanggal,detail_diagnosa_user.presentase
		FROM (detail_diagnosa_user 
		INNER JOIN penyakit ON detail_diagnosa_user.Id_Penyakit = penyakit.Id_Penyakit)
		WHERE detail_diagnosa_user.Id_Diagnosa=$id   AND (detail_diagnosa_user.Tanggal BETWEEN '".$awal."'AND '".$akhir."')
        ORDER BY detail_diagnosa_user.Tanggal DESC");
        return $hasil->result_array();
        
    }
    

    function gejala_detail(){
        $hasil=$this->db->query("SELECT gejala.nama_gejala FROM input_gejala_user INNER JOIN gejala ON input_gejala_user.Id_Gejala=gejala.Id_Gejala ");
		return $hasil->result_array();
    }


  	function tampil_data(){
		  
		return $this->db->get('diagnosa_user');
	}

	public function hapus($id)
	{
		$this->db->where('Id_Diagnosa', $id);
		$this->db->delete('diagnosa_user');
	}

	public function hapus_detail($id)
	{
		$this->db->where('id_detail_diagnosa', $id);
		$this->db->delete('detail_diagnosa_user');
	}
    
    function data_pengguna($id){
		
		
		$hasil=$this->db->query("SELECT userr.Nama,userr.Jenis_Kelamin,userr.Usia,diagnosa_user.Id_Diagnosa FROM (diagnosa_user INNER JOIN userr ON diagnosa_user.Id_User = userr.Id_User) WHERE diagnosa_user.Id_Diagnosa = $id");
		return $hasil->result_array();
    }
    //CHART 
    function chart($nama){
        $chart=$this->db->query("SELECT penyakit.Nama_Penyakit FROM detail_diagnosa_user INNER JOIN penyakit ON detail_diagnosa_user.Id_Penyakit = penyakit.Id_Penyakit WHERE penyakit.Nama_Penyakit='$nama'");
        return $chart->result_array();
    }

    function nama_penyakit(){
        $this->db->select('Nama_Penyakit');
        $this->db->from('penyakit');
       $query=$this->db->get();
       return $query->result_array();
    }
    
}
