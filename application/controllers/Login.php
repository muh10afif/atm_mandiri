<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_login'));
        $this->load->library('cek_login_lib'); 
    }
    
    // menampilkan halaman login
    public function index()
    {
        $this->cek_login_lib->logged_in_2();
        $this->load->view('V_login');
    }

    // proses pengecekan login
    public function cek_login()
    {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        $username   = trim(htmlspecialchars($user, ENT_QUOTES));
        $password   = trim(htmlspecialchars($pass, ENT_QUOTES));

        $data = ['username' => $username];

        $cek_username = $this->M_login->cek_username($username);

        if ($cek_username->num_rows() != 0) {

            $data = $cek_username->row_array();

            if (password_verify($password, $data['sha'])) {
                // if ($data['level'] == 1) {
                
                    $array = array(
                        'username'      => $data['username'],
                        'id_pengguna'   => $data['id_pengguna'],
                        'id_karyawan'   => $data['id_karyawan'],
                        'id_bagian'     => $data['id_bagian'],
                        'level'         => $data['level'],
                        'masuk'         => TRUE
                    );
                    
                    $this->session->set_userdata( $array );

                    echo json_encode(array('hasil' => 'masuk'));

                // }

            } else {
                
                echo json_encode(array('hasil' => 'salah password'));
                
            }
            
        } else {

            echo json_encode(array('hasil' => 'user tidak ada'));
        }
        
        
    }

    // logoutnya
    public function yuk_keluar()
    {
        $this->session->sess_destroy();

        redirect('login');
        
    }

}

/* End of file Login.php */
