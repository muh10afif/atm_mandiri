<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

    public function cek_username($username)
    {
        $this->db->from('pengguna a');
        $this->db->join('karyawan b', 'b.id_karyawan = a.id_karyawan', 'inner');
        
        $this->db->where('a.username', $username);

        return $this->db->get();
    }

}

/* End of file M_login.php */
