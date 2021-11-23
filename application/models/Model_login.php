<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

    public function cek_username($username)
    {
        $this->db->from('karyawan');
        $this->db->where('username', $username);

        return $this->db->get();
    }

}

/* End of file M_login.php */
