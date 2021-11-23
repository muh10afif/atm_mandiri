<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

    // menampilkan list mesin yang sudah ada
    public function get_data_mesin_sudah()
    {
        $this->db->select('id_mesin');
        $this->db->from('kelola_mesin');
        $sub = $this->db->get_compiled_select();
        
        $this->db->select('m.id_mesin, m.nama_mesin');
        $this->db->from('mesin as m');
        $this->db->where("m.id_mesin IN ($sub)", NULL, FALSE);
        
        return $this->db->get();
        
    }

    //update hasilTask
    public function updateHasilTask($data,$id)
    {
        $this->db->set('status', $data);
        $this->db->where('id_hasil_task', $id);
        return $this->db->update('hasil_task');
    }

    //menampilkan data hasil tasklist
    public function get_data_hasil_task($id_task)
    {
        $this->db->select('*');
        $this->db->from('hasil_task');
        $this->db->where('id_tasklist', $id_task);
        $this->db->where('status', 0);
        
        return $this->db->get();
    
    }

    function simpan_upload($data)
    {
        try
        {
            $id_tasklist = $data['id_tasklist'];
            $keterangan = $data['keterangan'];
            $status = $data['status'];
            $Foto_dokumen = $data['Foto_dokumen_url'];

            $hasil = array('id_tasklist'=>$id_tasklist,
                            'keterangan'=>$keterangan,
                            'status'=>$status,
                            'foto'=>$Foto_dokumen
                          );
            
            $this->db->insert('hasil_task', $hasil);
            if ($this->db->affected_rows())
            {
                $this->db->query("UPDATE tasklist SET status=1 WHERE id_tasklist = '$id_tasklist'");
                if ($this->db->affected_rows())
                {
                    $ok = true;
                }
            }
            else
            {
                $ok = false;
            }
        }
        catch (Exception $e) 
        {
            return 0;
        }

        return $ok;
    }

    // menampilkan data detail tasklist
    public function get_data_task_detail($id_task)
    {
        $this->db->select('b.id_tasklist, b.keterangan, a.nama_karyawan as penerima,b.penerima_tugas,b.pemberi_tugas, c.nama_karyawan as pemberi, b.tasklist, b.expire_date,b.jenis_task');
        $this->db->from('karyawan a');
        $this->db->join('tasklist b', 'a.id_karyawan = b.penerima_tugas', 'INNER');
        $this->db->join('karyawan c', 'c.id_karyawan = b.pemberi_tugas', 'INNER');
        $this->db->where('b.id_tasklist', $id_task);
        $this->db->order_by('b.add_time', 'desc');

        return $this->db->get();
    }

    public function cari_nama_1($id_tasklist)
    {
        $this->db->from('tasklist a');
        $this->db->join('karyawan h', 'h.id_karyawan = a.pemberi_tugas', 'left');
        $this->db->join('bagian b', 'b.id_bagian = h.id_bagian', 'left');
        
        $this->db->where('a.id_tasklist', $id_tasklist);

        return $this->db->get();
    }
    public function cari_nama_2($id_tasklist)
    {
        $this->db->from('tasklist a');
        $this->db->join('karyawan h', 'h.id_karyawan = a.penerima_tugas', 'left');
        $this->db->join('bagian b', 'b.id_bagian = h.id_bagian', 'left');
        $this->db->where('a.id_tasklist', $id_tasklist);

        return $this->db->get();
    }

    // menampilkan dokumen hasil monitoring
    public function get_foto_hsl_mon($id_hsl_mon)
    {
        return $this->db->get_where('dokumen', array('id_hasil_monitoring' => $id_hsl_mon));
    }

    var $column_order   = ['e.nama_mesin', 'a.nama_karyawan', 'CAST(m.tgl_monitoring as VARCHAR)', 'CAST(e.tgl_jatuh_tempo as VARCHAR)', 't.tindakan', null];
    var $column_search  = ['e.nama_mesin', 'a.nama_karyawan', 'CAST(m.tgl_monitoring as VARCHAR)', 'CAST(e.tgl_jatuh_tempo as VARCHAR)', 't.tindakan'];
    var $order          = ['h.add_time' => 'desc'];

    public function _get_datatables_query($id_jenis, $id_bagian)
    {
        $this->db->select('*');
        $this->db->from('tasklist a');
        $this->db->join('jenis_task h', 'h.id_jenis_tasklist = a.jenis_task', 'left');
        $this->db->join('bagian b', 'b.id_bagian = h.id_bagian', 'inner');
        //
        
        $this->db->where_not_in('a.status', 4);
        if ($id_jenis != ' ') {
            $this->db->where('h.id_jenis_tasklist', $id_jenis);
        }
        $this->db->where('b.id_bagian', $id_bagian);
        if($id_bagian != $this->session->userdata('id_bagian') && $this->session->userdata('id_bagian') != 0)
        {
            $this->db->where('a.pemberi_tugas', $this->session->userdata('id_karyawan'));
        }
        $this->db->order_by('h.add_time', 'desc');
        
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        
    }

    public function _get_datatables_query2($id_jenis, $id_bagian)
    {
        $this->db->select('*');
        $this->db->from('tasklist a');
        $this->db->join('jenis_task h', 'h.id_jenis_tasklist = a.jenis_task', 'left');
        $this->db->join('bagian b', 'b.id_bagian = h.id_bagian', 'left');
        $this->db->join('karyawan k','k.id_karyawan = a.pemberi_tugas','left');
        $this->db->join('bagian c','c.id_bagian = k.id_bagian','left');

        $this->db->where_not_in('c.id_bagian', 0);
        $this->db->where_not_in('a.status', 4);
        if ($id_jenis != ' ') {
            $this->db->where('h.id_jenis_tasklist', $id_jenis);
        }
        $this->db->where('b.id_bagian', $id_bagian);
        if($id_bagian != $this->session->userdata('id_bagian') && $id_bagian != 0)
        {
            $this->db->where('a.pemberi_tugas', $this->session->userdata('id_karyawan'));
        }
        $this->db->order_by('h.add_time', 'desc');
        
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        
    }
 
    public function get_datatables($id_jenis, $id_bagian)
    {
        $this->_get_datatables_query($id_jenis, $id_bagian);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_datatables2($id_jenis, $id_bagian)
    {
        $this->_get_datatables_query2($id_jenis, $id_bagian);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }
 
    public function count_filtered($id_jenis, $id_bagian)
    {
        $this->_get_datatables_query($id_jenis, $id_bagian);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($id_jenis, $id_bagian)
    {
        $this->db->select('*');
        $this->db->from('tasklist a');
        $this->db->join('jenis_task h', 'h.id_jenis_tasklist = a.jenis_task', 'inner');
        $this->db->join('bagian b', 'b.id_bagian = h.id_bagian', 'inner');
        
        $this->db->where_not_in('a.status', 3);
        if ($id_jenis != ' ') {
            $this->db->where('h.id_jenis_tasklist', $id_jenis);
        }
        $this  ->db->where('b.id_bagian', $id_bagian);
      
        return $this->db->count_all_results();
    }

    // hapus data
    public function hapus_data($tabel, $where)
    {
        $this->db->where($where);
        return $this->db->delete($tabel);
        
    }

    // ubah data
    public function ubah_data($tabel, $data, $where)
    {
        $this->db->where($where);
        return $this->db->update($tabel, $data);
    }

    // cari data
    public function cari_data($tabel, $where)
    {
        return $this->db->get_where($tabel, $where);
        
    }

    // input data
    public function input_data($tabel, $data)
    {
        return $this->db->insert($tabel, $data);
    }

    // mengambil id_kelola_mesin
    public function get_id_kelola_mesin($id_mesin)
    {
        $this->db->select('k.id_kelola_mesin, w.id_karyawan, w.nama_karyawan');
        $this->db->from('kelola_mesin as k');
        $this->db->join('karyawan as w', 'w.id_karyawan = k.id_pegawai', 'inner');
        $this->db->where('k.id_mesin', $id_mesin);
        
        return $this->db->get();
    }

    // menampilkan data mesin
    public function get_data($tabel)
    {
        return $this->db->get($tabel);        
    }

    public function get_data_kelolaan()
    {
        $this->db->select('k.nama_karyawan, e.nama_mesin, m.id_kelola_mesin');
        $this->db->from('kelola_mesin as m');
        $this->db->join('karyawan as k', 'k.id_karyawan = m.id_pegawai', 'inner');
        $this->db->join('mesin as e', 'e.id_mesin = m.id_mesin', 'inner');
        $this->db->order_by('m.add_time', 'desc');

        return $this->db->get();
    }

    // menampilkan data edit
    public function edit_data_kelolaan($tabel, $where)
    {
        $this->db->select('k.nama_karyawan, e.nama_mesin, m.id_kelola_mesin, k.id_karyawan, e.id_mesin');
        $this->db->from("$tabel as m");
        $this->db->join('karyawan as k', 'k.id_karyawan = m.id_pegawai', 'inner');
        $this->db->join('mesin as e', 'e.id_mesin = m.id_mesin', 'inner');
        $this->db->where($where);
        
        return $this->db->get();
    }

    // menampilkan data reminder
    public function get_data_reminder()
    {
        $this->db->select('k.nama_karyawan, m.nama_mesin, j.level, r.status, r.id_reminder');
        $this->db->from('reminder as r');
        $this->db->join('kelola_mesin as km', 'km.id_kelola_mesin = r.id_kelola_mesin', 'inner');
        $this->db->join('karyawan as k', 'k.id_karyawan = km.id_pegawai', 'inner');
        $this->db->join('mesin as m', 'm.id_mesin = km.id_mesin', 'inner');
        $this->db->join('jenis_reminder as j', 'j.id_jenis_reminder = r.id_jenis_reminder', 'inner');
        $this->db->order_by('r.add_time', 'desc');
        

        $hasil = $this->db->get()->result_array();

        $value  = array();

        foreach ($hasil as $h) {
            $id_reminder    = $h['id_reminder'];
            $nama_karyawan  = $h['nama_karyawan'];
            $nama_mesin     = $h['nama_mesin'];
            $level          = $h['level'];

            $cari_id_reminder = $this->db->get_where('hasil_monitoring', array('id_reminder' => $id_reminder))->num_rows();

            if ($cari_id_reminder != 0) {
                
                $this->db->where('id_reminder', $id_reminder);
                $this->db->update('reminder', array('status' => 1));
                
            } else {
                
                $this->db->where('id_reminder', $id_reminder);
                $this->db->update('reminder', array('status' => 0));

            }

            $status = $this->db->get_where('reminder', array('id_reminder' => $id_reminder))->row_array();

            $value[]    = [ 'nama_karyawan'  => $nama_karyawan,
                            'nama_mesin'     => $nama_mesin,
                            'level'          => $level,
                            'status'         => $status['status'],
                            'id_reminder'    => $id_reminder
                        ];
        }
        
        return $value;
    }

}

/* End of file M_data.php */
