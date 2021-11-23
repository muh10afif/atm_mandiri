<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_admin extends CI_Model {

    public function tampil_karyawan()
    {
        $this->db->from('karyawan');
        return $this->db->get();
    }

    public function input_karyawan($table,$data)
    {
        $this->db->trans_start();
        $tambah = $this->db->insert($table,$data);
        $this->db->trans_complete();
        if($this->db->trans_status() == true)
        {
            return true;
        }
        else
        {
           $this->db->trans_rollback();
           return false; 
        }
    }

    // proses hapus data
    public function hapus_data($tabel, $where)
    {
        $this->db->where($where);
        return $this->db->delete($tabel);
    }

}
