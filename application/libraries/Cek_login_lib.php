<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_login_lib
{
    public function logged_in()
    {
    	$_this =& get_instance();
    	if ($_this->session->userdata('masuk') != TRUE) {
    		redirect('login','refresh');
    	}
    }

    public function logged_in_2()
    {
    	$_this =& get_instance();
    	if ($_this->session->userdata('masuk') == TRUE) {
    		redirect('master/karyawan','refresh');
    	}
    }

}

/* End of file Cek_login_lib.php */
