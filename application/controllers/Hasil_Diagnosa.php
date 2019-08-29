<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_Diagnosa extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('M_Hasil_Diagnosa');
        $this->load->model('M_Diagnosa');
        $this->load->add_package_path( APPPATH . 'third_party/fpdf');
		$this->load->library('pdf');
	}
		
	public function index(){
		if ($this->session->userdata('ses_namaadmin')==FALSE){

			redirect('Admin/login');
		}
		else{
			$this->load->view('template_admin/header');
            $data['diagnosa'] = $this->M_Hasil_Diagnosa->tampil_data()->result();
			$this->load->view('admin/v_diagnosa',$data);	
			$this->load->view('template_admin/footer');	
		}
	}

	public function detail_diagnosa($id){
		if ($this->session->userdata('ses_namaadmin')==FALSE){

			redirect('Admin/login');
		}
		else{
			$this->load->view('template_admin/header');
            $riwayat['hasil']=$this->M_Hasil_Diagnosa->penyakit_list_byid($id);
			$riwayat['id_diagnosa']=$id;
			$this->load->view('admin/v_detail_diagnosa',$riwayat);	
			$this->load->view('template_admin/footer');	
		}
	}

	
	function data_diagnosa(){
        $data=$this->M_Hasil_Diagnosa->diagnosa_list();
       
		echo json_encode($data);
	}

	public function hapus()
	{
		$idagnosa=$this->input->post('id');
		$this->M_Hasil_Diagnosa->hapus($idagnosa);
		echo json_encode(array("status" => TRUE));
	}

	public function hapus_detail()
	{
		$idagnosa=$this->input->post('id');
		$this->M_Hasil_Diagnosa->hapus_detail($idagnosa);
		echo json_encode(array("status" => TRUE));
	}

	public function cetak(){

       

        $id=htmlspecialchars($this->input->post('id_diagnosa',TRUE),ENT_QUOTES);
        $awal=htmlspecialchars($this->input->post('awal',TRUE),ENT_QUOTES);
        $akhir=htmlspecialchars($this->input->post('akhir',TRUE),ENT_QUOTES);
      
       

        //Cek Tanggal 
        if ($awal==NULL ||$akhir==NULL ) {
            $pengguna=$this->M_Hasil_Diagnosa->data_pengguna($id);
            $hasil=$this->M_Hasil_Diagnosa->penyakit_list_byid($id);

            $data = array(
                'user' =>  $pengguna,
                'hasil' =>  $hasil
            );
            
            $html = $this->load->view('admin/v_laporan',$data,true);
            $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
            $mpdf->WriteHTML($html);
            $mpdf->Output('Orderan.pdf', 'I');
            
        } else {

            $pengguna=$this->M_Hasil_Diagnosa->data_pengguna($id);
            $hasil=$this->M_Hasil_Diagnosa->hasil_diagnosa_bytanggal($id,$awal,$akhir);

            if ($hasil==NULL) {
                $this->session->set_flashdata('Tanggal', 
                                            'Data Dengan Range Tanggal Tersebut Tidak Di Temukan!!');
                
                redirect('Hasil_Diagnosa/detail_diagnosa/'.$id);
                exit;
            }else{
                $data = array(
                    'user' =>  $pengguna,
                    'hasil' =>  $hasil
                );
                
                $html = $this->load->view('admin/v_laporan',$data,true);
                $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
                $mpdf->WriteHTML($html);
                $mpdf->Output('Orderan.pdf', 'I');
            }
            
        }

	}

	public function cetak_diagnosa(){
    
        $data['diagnosa']=$this->M_Hasil_Diagnosa->diagnosa_cetak();
		
        $html = $this->load->view('admin/v_laporan_diagnosa',$data,true);
       
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
		$mpdf->WriteHTML($html);

		
		$mpdf->Output('Orderan.pdf', 'I');

	}
}
