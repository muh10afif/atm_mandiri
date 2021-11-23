<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {

    public function get_data($tabel)
    {
        return $this->db->get($tabel);
    }
    
    public function get_data_mesin_belum()
    {
        $this->db->select('id_mesin');
        $this->db->from('kelola_mesin');
        $sub = $this->db->get_compiled_select();
        
        $this->db->select('m.id_mesin, m.nama_mesin');
        $this->db->from('mesin as m');
        $this->db->where("m.id_mesin NOT IN ($sub)", NULL, FALSE);
        
        return $this->db->get();
    }

    // menampilkan list data jenis reminder
    public function get_data_jenis_reminder()
    {
        $this->db->from('jenis_task as p');
        $this->db->join('bagian as k', 'k.id_bagian = p.id_bagian');
        if($this->session->userdata('level') == 4)
        {
            $this->db->where('k.id_bagian', $this->session->userdata('id_bagian'));
        }
        elseif($this->session->userdata('level') == 5)
        {
            $this->db->where('k.id_bagian', $this->session->userdata('id_bagian'));
        }
        elseif($this->session->userdata('level') == 3)
        {
            $this->db->where('k.id_bagian', $this->session->userdata('id_bagian'));
        }
        return $this->db->get();
        
    }

    public function get_data_mesin_atm()
    {
        $this->db->order_by('add_time', 'desc');

        return $this->db->get('mesin');
    }

    public function get_data_karyawan()
    {
        $this->db->join('bagian b', 'a.id_bagian = b.id_bagian', 'left');
        if($this->session->userdata('level') == 4)
        {
            $this->db->where('b.id_bagian', $this->session->userdata('id_bagian'));
        }
        elseif($this->session->userdata('level') == 5)
        {
            $this->db->where('b.id_bagian', $this->session->userdata('id_bagian'));
        }
        elseif($this->session->userdata('level') == 3)
        {
            $this->db->where('b.id_bagian', $this->session->userdata('id_bagian'));
        }
        $this->db->order_by('a.add_time', 'desc');
        
        return $this->db->get('karyawan a');
    }

    public function jenis_task($bagian)
    {
        $this->db->order_by('p.add_time', 'desc');
        $this->db->from('jenis_task as p');
        $this->db->join('bagian as k', 'k.id_bagian = p.id_bagian','left');
        $this->db->where('k.id_bagian', $bagian);

        return $this->db->get();
    }

    public function list_pegawai()
    {
        $this->db->order_by('add_time', 'desc');
        
        return $this->db->get('karyawan');
    }

    public function list_pegawai2($data,$id_bagian)
    {
        $this->db->order_by('add_time', 'desc');
        $this->db->where_not_in('id_karyawan', $data);
        $this->db->where('id_bagian',$id_bagian);
           
        return $this->db->get('karyawan');
    }

    public function list_pegawai3($data)
    {
        $this->db->order_by('add_time', 'desc');
        $this->db->where_not_in('id_karyawan', $data);
        $this->db->where_not_in('id_bagian',0);
           
        return $this->db->get('karyawan');
    }

    // input data
    public function input_data($tabel, $data)
    {
       return $this->db->insert($tabel, $data);
    }
    
    // proses ubah data
    public function ubah_data($tabel, $data, $where)
    {
        $this->db->where($where);
        return $this->db->update($tabel, $data);
    }

    // proses hapus data
    public function hapus_data($tabel, $where)
    {
        $this->db->where($where);
        return $this->db->delete($tabel);
    }

    // mencari jenis_task
    public function data_edit($id)
    {
        $this->db->from('jenis_task as p');
        $this->db->join('bagian as k', 'k.id_bagian = p.id_bagian');
        $this->db->where('id_jenis_tasklist', $id);

        return $this->db->get();
    } 
    // mencari karyawan
    public function karyawan_edit($table, $id)
    {
        $this->db->from('karyawan as p');
        $this->db->join('bagian as k', 'k.id_bagian = p.id_bagian', 'left');
        $this->db->where($id);

        return $this->db->get();
    }
    // menampilkan pengguna
    public function get_data_pengguna()
    {
        $this->db->from('pengguna as p');
        $this->db->join('karyawan as k', 'k.id_karyawan = p.id_karyawan', 'left');
        $this->db->where_not_in('p.level',1);
        if($this->session->userdata('level') == 3)
        {
            $this->db->where('k.id_bagian', $this->session->userdata('id_bagian'));
            
        }

        return $this->db->get();
    }

    // menampilkan karyawan
    public function get_karyawan_pengguna()
    {
        $this->db->select('id_karyawan');
        $this->db->from('pengguna');
        $this->db->where('id_karyawan !=', null);
        
        $sub = $this->db->get_compiled_select();

        $this->db->select('k.nama_karyawan, k.id_karyawan');
        $this->db->from('karyawan as k');
        $this->db->where("k.id_karyawan NOT IN ($sub)", NULL, FALSE);
        
        return $this->db->get();
        
    }

    // menampilkan edit pengguna
    public function data_edit_pengguna($where)
    {
        $this->db->select('k.id_karyawan, p.level, p.username, p.password, p.id_pengguna, k.nama_karyawan, b.bagian');
        $this->db->from('pengguna as p');
        $this->db->join('karyawan as k', 'k.id_karyawan = p.id_karyawan', 'inner');
        $this->db->join('bagian b', 'b.id_bagian = k.id_bagian', 'inner');
        
        $this->db->where($where);
        
        return $this->db->get()->row_array();
        
    }

}

/* End of file M_master.php */
