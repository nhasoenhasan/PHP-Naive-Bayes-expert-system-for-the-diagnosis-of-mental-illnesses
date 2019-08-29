<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnosa extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('M_Gejala');
		$this->load->model('M_Diagnosa');
	}
		
	
	public function tahapsatu(){
		if ($this->session->userdata('ses_nama')==FALSE){
			redirect('Login/index');
		}else{
			$this->validasi();
			//-------------------------------[GET DATABASE]----------------------------------
			$jumlah['penyakit'] = $this->M_Diagnosa->get_Jpenyakit();
			$namapenyakit['penyakit'] = $this->M_Diagnosa->get_penyakit();
			//-------------------------------[DEKLARASI VARIABEL]----------------------------
			$hasilatas=0;
			$hasilbawah=0;
			$arraybawah=[];
			$arrayatas=[];
			$npenyakit=$namapenyakit['penyakit'];
			$jpenyakit=$jumlah['penyakit'];
			$input=$_POST['item'];
			
			$jinput=count($input);

			foreach ($npenyakit as $items) {
				
				foreach ($input as $key =>$value1){	

						$id=$items['Id_Penyakit'];
						$ppenyakit=$items['P_penyakit'];
						
						//Mendapatkan Nilai Probabilitas Dari Database
						for ($i= 1; $i <= $jpenyakit; $i++){

							$nilai = $this->M_Diagnosa->get_probabilitas($id,$value1);
							
                        }
                        
						//BAWAH
						foreach ($nilai as  $kunci =>$value2) {
						
							$hasilbawah=$value2['nilai']*$ppenyakit;
							$hasilbawah=round($hasilbawah, 4);
							
							array_push($arraybawah, $hasilbawah);
							
						}	
                        
						//ATAS
						$p = $this->M_Diagnosa->get_probabilitas($id,$value1);
						foreach ($p as $key =>$k) {
								$GejalakePenyakit=$k['nilai'];
								//Memasukan Ke rumus
								$hasilatas=$GejalakePenyakit*$ppenyakit;
								$hasilatas=round($hasilatas, 4);
								array_push($arrayatas, $hasilatas);
								//echo $hasilatas."|";
						}	

				}

			}
			
            
			$this->perhitungandua($arrayatas,$arraybawah,$jinput,$input);
		}
    }

	function perhitungandua($atas,$bawah,$jinput2,$input){
        $while=count($bawah)/$jinput2; 
		$tmp=0;
		$k=0;
		$A=[];
		$x=0;
		$kunci=0;
		$hasil=NULL;
		$hasilakhir=[];
        
		//PENJUMLAHAN BAWAH
		foreach ($bawah as $key => $value) if ($tmp++ < $jinput2) {
  
			while($x < $while) {
			 
			   array_push($A,$bawah[$k]);
			   
			   $k=$k+$jinput2;
			   $x++;
			} 
           
			$kunci++;
			$x=0;
			$hasil=array_sum($A);
			$hasil=round($hasil, 4);
			array_push($hasilakhir,$hasil);
			
			$A=[];
			
			$k=$kunci;
		 }
		 
		 $this->perhitungantiga($atas,$hasilakhir,$jinput2,$input);

	}

	function perhitungantiga($atas,$hasilakhir,$jinput2,$input){
        //PEMBAGIAN
       
        $for1=count($atas);
		$for1=$for1-1;
		$for=count($atas);
        $for2=count($hasilakhir);
       
		$for2=$for2-1;
		$hasilpembagian=0;
        $hasilakhirpembagian=[];

      
		for ($i=0; $i <$for ; $i++) { 

			if($for2 > -1){
				$hasilpembagian=$atas[$for1]/$hasilakhir[$for2];
				$hasilpembagian=round($hasilpembagian, 4);
                array_push($hasilakhirpembagian,$hasilpembagian);
              
                $for2--;
                
			}if($for2 < 0){
				$for2=count($hasilakhir);
                $for2=$for2-1;
                
			}if($for1<0){
				break;
			}
		
		$for1--;
		}
		
		$this->perhitunganempat($hasilakhirpembagian,$jinput2,$input);
	}

	function perhitunganempat($hasilakhirpembagian,$jinput2,$input){
        //PENJUMLAHAN PROBABILITAS SETIAP PENYAKIT
		$jumlah = $this->M_Diagnosa->get_Jpenyakit();
		$hasilpenjumlahanprobabilitas=[];
		$a=0;
		$kunci=0;
		$push=[];
		$push2=[];
		$hasiljumlah=[];
		for ($i=0; $i < $jumlah; $i++) { 
			
			while ($a < $jinput2) {
			
				array_push($push,$hasilakhirpembagian[$kunci]);
				$a++;
				$kunci++;
			}
			$hasiljumlah=array_sum($push);
			$hasiljumlah=round($hasiljumlah, 4);
			array_push($hasilpenjumlahanprobabilitas, $hasiljumlah);
			$push=[];
			
			$a=0;
			

		}
	
		
		$this->perhitunganlima($hasilpenjumlahanprobabilitas,$input);
	}

	function perhitunganlima($hasilempat,$input){
		//TAHAP 3
		$hasillima=[];
		$hasilakhirlima=[];
		$hasiljp=array_sum($hasilempat);
		//var_dump($hasiljp);

		foreach ($hasilempat as $key => $value) {
			$hasillima=($value/$hasiljp)*100;
			array_push($hasilakhirlima, $hasillima);

		}
		
		$this->finalstep($hasilakhirlima,$input);
	}

	function finalstep($hasilakhirlima,$input){
		
		$namapenyakit = $this->M_Diagnosa->get_nama_penyakit();
		$presentase=[];
		$d=[];
		$for=count($hasilakhirlima)-1;
		$namagejala=[];
		$akhirnamagejala=[];
		

		//--------------[UBAH INDEX]--------------------

		for ($i=$for; $i >= 0 ; $i--) { 
			$d=$hasilakhirlima[$i]."\n";
			array_push($presentase, $d);
		}
		
		//-------------------[GET NAMA GEJALA]--------------------
		foreach ($input as $key => $value) {
			$namagejala[]= $this->M_Gejala->gejala_list_array($value);
			
        }
        
        //Membandingkan data tertinggi pada View
		$data['persen']=$presentase;
		$data['penyakit']=$namapenyakit;
		$data['input']=$namagejala;
		
		$this->load->view('template/header');
		$this->load->view('halaman/v_hasil_diagnosa',$data);
		$this->load->view('template/footer');
		
	}

	function diagnosa_user(){
	
		
        $inputgejala=$_POST['gejala'];
        
        
		
		$kodep=htmlspecialchars($this->input->post('IdPenyakit',TRUE),ENT_QUOTES);
		$kodeu=htmlspecialchars($this->input->post('IdUser',TRUE),ENT_QUOTES);
        $persen=htmlspecialchars($this->input->post('Persentase',TRUE),ENT_QUOTES);
        $persen_setiap_penyakit=$_POST['persen_setiap_penyakit'];
        $nama_setiap_penyakit=$_POST['nama_setiap_penyakit'];
		$tgl=date( 'Y-m-d h:i:s');

		$cek_diagnosa=$this->M_Diagnosa->cek_diagnosa($kodeu);
        
        
        
		if ($cek_diagnosa==false) {
			//INPUT DIAGNOSA 
            $data_diagnosa = array(
				'Id_User' => $kodeu,
			);
			$id_diagnosa=$this->M_Diagnosa->tambah_data_diagnosa($data_diagnosa);

			//SELECT NAMA GEJALA
            $g=[];
            $datagejala=[];
            foreach ($inputgejala as $key => $value) {

                $g=$this->M_Gejala->gejala_nama_array($value);
                array_push($datagejala, $g);

            }

            //PEMISAH
            $ngejala=array();
            foreach($datagejala as $value){
                $ngejala[] = $value[0]['nama_gejala'];
            }
            $ngejala=implode('|', $ngejala);

            //PEMISAH NAMA PENYAKIT
            $n_setiap_penyakit=array();
            foreach($nama_setiap_penyakit as $value){
                $n_setiap_penyakit[]=$value;
            }
            $n_setiap_penyakit=implode('|', $n_setiap_penyakit);

            //PEMISAH NAMA PRESENTASE
            $n_setiap_presentase=array();
            foreach( $persen_setiap_penyakit as $value){
                $n_setiap_presentase[]=$value;
            }
            $n_setiap_presentase=implode('|', $n_setiap_presentase);

            
            //INPUT DETAIL
            $id_diagnosa=$this->M_Diagnosa->search_detail($kodeu);
			$data_detail_diagnosa = array(
				'Tanggal' => $tgl,
				'Id_Penyakit' => $kodep,
				'Id_Diagnosa' => $id_diagnosa[0]['Id_Diagnosa'],
                'presentase' => $persen,
                'Nama_Gejala'=>$ngejala,
                'Nama_Penyakit_lain'=>$n_setiap_penyakit,
                'presentase_lain'=>$n_setiap_presentase
            );
           
            $id_detail_diagnosa=$this->M_Diagnosa->tambah_data_detail_diagnosa($data_detail_diagnosa);
			redirect('Profil/riwayat_diagnosa');

        } else {
            //SELECT NAMA GEJALA
            $g=[];
            $datagejala=[];
            foreach ($inputgejala as $key => $value) {

                $g=$this->M_Gejala->gejala_nama_array($value);
                array_push($datagejala, $g);

            }

            //PEMISAH
            $ngejala=array();
            foreach($datagejala as $value){
                $ngejala[] = $value[0]['nama_gejala'];
            }
            $ngejala=implode('|', $ngejala);

            //PEMISAH NAMA PENYAKIT
            $n_setiap_penyakit=array();
            foreach($nama_setiap_penyakit as $value){
                $n_setiap_penyakit[]=$value;
            }
            $n_setiap_penyakit=implode('|', $n_setiap_penyakit);

            //PEMISAH NAMA PRESENTASE
            $n_setiap_presentase=array();
            foreach( $persen_setiap_penyakit as $value){
                $n_setiap_presentase[]=$value;
            }
            $n_setiap_presentase=implode('|', $n_setiap_presentase);
           

           
            //INPUT DETAIL
            $id_diagnosa=$this->M_Diagnosa->search_detail($kodeu);
           
			$data_detail_diagnosa = array(
				'Tanggal' => $tgl,
				'Id_Penyakit' => $kodep,
				'Id_Diagnosa' => $id_diagnosa[0]['Id_Diagnosa'],
                'presentase' => $persen,
                'Nama_Gejala'=>$ngejala,
                'Nama_Penyakit_lain'=>$n_setiap_penyakit,
                'presentase_lain'=>$n_setiap_presentase

            );
          
            $id_detail_diagnosa=$this->M_Diagnosa->tambah_data_detail_diagnosa($data_detail_diagnosa);
            

			redirect('Profil/riwayat_diagnosa');
			
        }
		
	}


	private function validasi()
	{
		

		if($this->input->post('item') == '')
		{
			$data['status'] = FALSE;
			$this->session->set_flashdata('msgbox','<div class="alert alert-danger alert-dismissible fade show" role="alert">
														<strong>Pilih Gejala!!!</strong> Silahkan Pilih Minimal 2 Gejala Di Bawah
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>');
			redirect('Halaman/Diagnosa');

		}
		else {
			$input=$_POST['item'];
			$jinput=count($input);
			
			if($jinput < 2)
			{
				$data['status'] = FALSE;
				$this->session->set_flashdata('msgbox','<div class="alert alert-danger alert-dismissible fade show" role="alert">
															<strong>Pilih Gejala!!!</strong> Silahkan Pilih Minimal 2 Gejala Di Bawah
															<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>');
				redirect('Halaman/Diagnosa');

			}
		}        
		
	}

}