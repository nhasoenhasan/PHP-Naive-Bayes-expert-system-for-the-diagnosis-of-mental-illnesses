<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Reset_Password extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->library('email');
	}

	public function sendpassword($data) {

        $email = $data->Email;

        $query1 = $this->db->query("SELECT * from userr where Email = '" . $email . "'");
        $row = $query1->row();
        
        if ($query1->num_rows() > 0) {
            // assign users name to a variable
            $full_name = $row->Nama;
            // generate password from a random integer
            $passwordplain = rand(999999999, 9999999999);
            // encrypt password
            $encrypted_pass = $this->pass_gen($passwordplain);
            $newpass['Pass'] = $encrypted_pass;
            
            
            // update password in db
            $this->db->where('Email', $email);
            $this->db->update('userr', $newpass);
            
        
        // begin email functions
        $result = $this->kirim($full_name, $email, $passwordplain);
        //$result=$this->sendMail();
        echo $result;
        }
    }
    

    function kirim($full_name, $email, $passwordplain){
        
        $ci = get_instance();
        $config = [
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'mh.check2019@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'sekolahku',      // Password gmail kamu
            'smtp_port' => 465,
            'newline'   => "\r\n"
        ];
        $ci->email->initialize($config);
        $ci->email->set_mailtype("html");
       
        $ci->load->library('email', $config);
        $ci->email->from('mh.check2019@gmail.com', 'Mental Health Check');
        
        $ci->email->to($email); 
        $ci->email->subject('Reset Password | MHCheck');
        
        $ci->email->message('Hey,<strong>'.$full_name.'</strong><br><br>Password Baru Anda:'.$passwordplain.'<br>Silahkan Login Menggunakan Password Baru Anda');

        if ($ci->email->send()) {
            $ci->session->set_flashdata('msgs', 'Password Berhasil Di Reset!!, Silahkan Cek Email Anda');
            redirect('Lupa_password/index');
        } else {
            show_error($ci->email->print_debugger());
            $ci->session->set_flashdata('msgs', 'Email Tidak Di Terkirim');
            redirect('Lupa_password/index');
        }
    }
    
    
    
    // Password encryption
    public function pass_gen($password) {
        $encrypted_pass = md5($password);
        return $encrypted_pass;
    }


    public function ForgotPassword($email)
	{
		$this->db->from('userr');
		$this->db->where('Email',$email);
		$query = $this->db->get();
		return $query->row();
	}
    
}
