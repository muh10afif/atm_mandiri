<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cek_login_lib');
        $this->cek_login_lib->logged_in();
        $this->load->model(array('M_master'));
    }

    /*******************/
    // MASTER KARYAWAN //
    /*******************/
    
    public function Karyawan()
    {
        $data = ['judul'    => 'Master Karyawan',
                 'karyawan' => 'active',
                ];

        $this->template->load('template', 'master/karyawan/V_karyawan', $data);
    }

    // menampilkan data karyawan dengan json
    public function tampil_karyawan()
    {   
        $data_karyawan = $this->M_master->get_data_karyawan()->result_array();
        $no =1;
        foreach ($data_karyawan as $value) {
            $tbody = array();
            $tbody[] = "<div align='center'>".$no++."</div>";
            $tbody[] = $value['nama_karyawan'];
            $tbody[] = $value['nik'];
            $tbody[] = $value['alamat'];
            $tbody[] = $value['no_telp'];
            $tbody[] = $value['bagian'];
            $aksi= "<div align='center'> <button class='btn btn-icon btn-icon-circle btn-sun btn-icon-style-2 ubah-karyawan' data-toggle='modal' data-id=".$value['id_karyawan']."><span class='btn-icon-wrap'><i class='icon-pencil'></i></span></button>".' '."<button class='btn btn-icon btn-icon-circle btn-red btn-icon-style-2 hapus-karyawan' id='id' data-toggle='modal' data-id=".$value['id_karyawan']."><span class='btn-icon-wrap'><i class='icon-trash'></i></span></button> </div>";
            $tbody[] = $aksi;
            $data[]  = $tbody; 
        }

        if ($data_karyawan) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    // proses tambah data karyawan
    public function tambah_karyawan()
    {
        $nama       = $this->input->post('nama');
        $nik        = $this->input->post('nik');
        $no_telp    = $this->input->post('no_telp');
        $alamat     = $this->input->post('alamat');
        $bagian     = $this->input->post('bagian');
        
        $data       = [ 
                        'nama_karyawan'   => $nama,
                        'nik'             => $nik,
                        'no_telp'         => $no_telp,
                        'alamat'          => $alamat,
                        'id_bagian'       => $bagian
                    ];
        
        $hasil      = $this->M_master->input_data('karyawan', $data);

        echo json_encode($hasil);
    }

    // menampilkan form edit karyawan
    public function form_edit_karyawan()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id_karyawan}
        $where = ['p.id_karyawan' => $this->input->post('id')];

        $data['data_per_karyawan'] = $this->M_master->karyawan_edit('karyawan JOIN bagian ON bagian.id_bagian = karyawan.id_bagian', $where)->row_array();

        $this->load->view('master/karyawan/V_edit_karyawan',$data);
    }

    // proses ubah karyawan
    public function ubah_karyawan()
    {
        $input_data = [ 'nama_karyawan' => $this->input->post('nama'),
                        'nik'           => $this->input->post('nik'),
                        'alamat'        => $this->input->post('alamat'),
                        'no_telp'       => $this->input->post('no_telp'),
                        'id_bagian'     => $this->input->post('bagian')   
        ];

        $where = ['id_karyawan' => $this->input->post('id_karyawan') ];

        $data = $this->M_master->ubah_data('karyawan', $input_data, $where);

        echo json_encode($this->input->post('bagian'));
    }

    // proses hapus karyawan
    public function hapus_karyawan()
    {
        $where = ['id_karyawan' => $this->input->post('id') ];

        $data = $this->M_master->hapus_data('karyawan', $where);

        echo json_encode($data);
    }

    /*******************/
    // MASTER PENGGUNA //
    /*******************/

    // menampilkan list pengguna
    public function pengguna()
    {
        $data = [ 'pengguna'    => 'active',
                  'judul'       => 'Master Pengguna',
                  'd_karyawan'  => $this->M_master->get_karyawan_pengguna()->result_array()
                ];

        $this->template->load('template', 'master/pengguna/V_pengguna', $data);
    }

    // menampilkan data pengguna
    public function tampil_pengguna()
    {
        $this->db->select('*');
        $this->db->from('pengguna');
        $this->db->where('level', 3);
        $var = $this->db->get()->num_rows();
        $data_pengguna = $this->M_master->get_data_pengguna()->result_array();
        $no = 1;
        foreach ($data_pengguna as $d) {
            $tbody = array();

            $level = $d['level'];

            if ($level == 1) {
                $level = "Admin";
            } else if($level == 2){
                $level = "Head";
            }
            else if($level == 3){
                $level = "Manager";
            }
            else if($level == 4){
                $level = "Officer";
            }
            else if($level == 5){
                $level = "Team";
            }

            $tbody[] = "<div align='center'>".$no++."</div>";
            $tbody[] = $d['nama_karyawan'];
            $tbody[] = $d['username'];
            $tbody[] = $d['no_reg'];
            $tbody[] = $level;
            $aksi    = "<div align='center'> <button class='btn btn-icon btn-icon-circle btn-sun btn-icon-style-2 ubah-pengguna' data-id=".$d['id_pengguna']."><span class='btn-icon-wrap'><i class='icon-pencil'></i></span></button>".' '."<button class='btn btn-icon btn-icon-circle btn-red btn-icon-style-2 hapus-pengguna' id='id' data-id=".$d['id_pengguna']."><span class='btn-icon-wrap'><i class='icon-trash'></i></span></button> </div>";
            $tbody[] = $aksi;

            $data[]  = $tbody;
        }

        if ($data_pengguna) {
            echo json_encode(array('data' => $data,'cek'=>$var));
        } else {
            echo json_encode(array('data' => 0));
        }

    }

    // proses tambah pengguna
    public function tambah_pengguna()
    {
        $karyawan   = $this->input->post('karyawan');
        $level      = $this->input->post('level');
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $no_reg     = "REG".random_string('alnum', 5);

        $password_hash   = password_hash($password, PASSWORD_DEFAULT);

        $data       = [ 'id_karyawan'   => $karyawan,
                        'level'         => $level,
                        'username'      => $username,
                        'password'      => $password,
                        'sha'           => $password_hash,
                        'no_reg'        => $no_reg,
                        'status'        => 1
                    ];

        $hasil      = $this->M_master->input_data('pengguna', $data);

        $d_karyawan = $this->M_master->get_karyawan_pengguna()->result_array();

        if ($d_karyawan) {

            $option[] = "<option value=' '>-- Pilih Karyawan --</option>";
            foreach ($d_karyawan as $k) {
                $option[]   = "<option value=".$k['id_karyawan'].">".$k['nama_karyawan']."</option>";
            }
        } else {
            $option   = 0;
        }
        

        echo json_encode(array('hasil'   => $hasil, 'karyawan'   => $option));

        //echo json_encode($hasil);
    }

    // menampilkan data edit pengguna
    public function form_edit_pengguna()
    {
        $where    = ['id_pengguna'  => $this->input->post('id')];

        $data   = [ 'd_pengguna'    => $this->M_master->data_edit_pengguna($where),
                    'd_karyawan'    => $this->M_master->get_karyawan_pengguna()->result_array()
                    ];

        $this->load->view('master/pengguna/V_edit_pengguna', $data);
    }

    // proses ubah pengguna
    public function ubah_pengguna($id = 0)
    {

        $id_pengguna    = $this->input->post('id_pengguna');
        $username       = $this->input->post('username');
        $password       = $this->input->post('password');
        $password_sha   = password_hash($password, PASSWORD_DEFAULT);
        $level          = $this->input->post('level');
        
        $data   = [ 'username'  => $username,
                    'password'  => $password,
                    'sha'       => $password_sha,
                    'level'     => $level
                    ];


        $where  = [ 'id_pengguna'   => $id_pengguna];

        if ($id == 0) {
            $hasil = $this->M_master->ubah_data('pengguna', $data, $where);
        } else {
            $hasil = null;
        }

        $d_karyawan = $this->M_master->get_karyawan_pengguna()->result_array();

        if ($d_karyawan) {

            $option[] = "<option value=' '>-- Pilih Karyawan --</option>";
            foreach ($d_karyawan as $k) {
                $option[]   = "<option value=".$k['id_karyawan'].">".$k['nama_karyawan']."</option>";
            }
        } else {
            $option   = 0;
        }

        echo json_encode(array('hasil'   => $hasil, 'karyawan'   => $option));

        //echo json_encode($hasil);
    }

    // proses hapus
    public function hapus_pengguna()
    {
        $where = ['id_pengguna' => $this->input->post('id')]; 

        $data = $this->M_master->hapus_data('pengguna', $where);

        $d_karyawan = $this->M_master->get_karyawan_pengguna()->result_array();

        if ($d_karyawan) {

            $option[] = "<option value=' '>-- Pilih Karyawan --</option>";
            foreach ($d_karyawan as $k) {
                $option[]   = "<option value=".$k['id_karyawan'].">".$k['nama_karyawan']."</option>";
            }
        } else {
            $option   = 0;
        }

        echo json_encode(array('data'   => $data, 'data_karyawan'   => $option));
        
    }

    /********************/
    // MASTER MESIN ATM //
    /********************/

    // menampilkan halaman mesin atm
    public function mesin_atm()
    {
        $data = ['judul'        => 'Mesin ATM',
                 'mesin_atm'    => 'active'
                ];

        $this->template->load('template', 'master/mesin_atm/V_mesin_atm', $data);
    }

    // menampilkan data tabel mesin_atm
    public function tampil_mesin_atm()
    {
        $data_mesin = $this->M_master->get_data_mesin_atm()->result_array();

        $no = 1;
        foreach ($data_mesin as $h) {
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no++."</div>";
            $tbody[]    = $h['nama_mesin'];
            $tbody[]    = $h['alamat'];
            $tbody[]    = tgl_indo($h['tgl_jatuh_tempo']);
            $tbody[]    = "Rp. ".number_format($h['nilai_kontrak'],0,'.','.');
            $aksi    = "<div align='center'> <button class='btn btn-icon btn-icon-circle btn-sun btn-icon-style-2 ubah-mesin' data-toggle='modal' data-id=".$h['id_mesin']."><span class='btn-icon-wrap'><i class='icon-pencil'></i></span></button>".' '."<button class='btn btn-icon btn-icon-circle btn-red btn-icon-style-2 hapus-mesin' data-toggle='modal' id='id' data-id=".$h['id_mesin']."><span class='btn-icon-wrap'><i class='icon-trash'></i></span></button> </div>";
            $tbody[] = $aksi;

            $data[]  = $tbody;
        }

        if ($data_mesin) {
            echo json_encode(['data' => $data]);
        } else {
            echo json_encode(['data' => 0]);

        }
        
    }

    // proses tambah mesin
    public function tambah_mesin()
    {
        $nama               = $this->input->post('nama');
        $tgl_jatuh_tempo    = $this->input->post('tanggal');
        $nilai_kontrak      = $this->input->post('n_kontrak');
        //$alamat             = $this->input->post('alamat');
        $lat                = $this->input->post('lat');
        $long               = $this->input->post('long');

        $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($long).'&key=AIzaSyDx0U_l7WLDkzQ72SbpfaYIWCALbIa60wk'.'&sensor=true'); 
        $output = json_decode($geocodeFromLatLong);
        $status = $output->status;
        
        $jalan     = ($status=="OK")?$output->results[0]->address_components[1]->long_name:'';
        $nomer     = ($status=="OK")?$output->results[0]->address_components[0]->long_name:'';
        $desa      = ($status=="OK")?$output->results[0]->address_components[2]->long_name:'';
        $kecamatan = ($status=="OK")?$output->results[0]->address_components[3]->long_name:'';
        $kota      = ($status=="OK")?$output->results[0]->address_components[4]->long_name:'';
        $provinsi  = ($status=="OK")?$output->results[0]->address_components[5]->long_name:'';
        $negara    = ($status=="OK")?$output->results[0]->address_components[6]->long_name:'';
        $kode_pos  = ($status=="OK")?$output->results[0]->address_components[7]->long_name:'';

        $alamat = $jalan." ".$nomer.", ".$desa." ".$kecamatan." ".$kota." ".$provinsi." ".$negara." ".$kode_pos;
        
        $data   = [ 'nama_mesin'        => $nama,
                    'tgl_jatuh_tempo'   => $tgl_jatuh_tempo,
                    'nilai_kontrak'     => $nilai_kontrak,
                    'alamat'            => $alamat,
                    'lat'               => $lat,
                    'long'              => $long,
                    'status'            => 0
                ];

        $hasil  = $this->M_master->input_data('mesin', $data);

        echo json_encode($hasil);
        
    }

    // menampilkan form edit mesin
    public function form_edit_mesin()
    {
        $where = ['id_mesin' => $this->input->post('id')];

        $data['d_mesin']    = $this->M_master->data_edit('mesin', $where);

        $this->load->view('Master/mesin_atm/V_edit_mesin', $data);
    }

    // proses ubah data mesin
    public function ubah_mesin()
    {
        $lat    = $this->input->post('lat');
        $long   = $this->input->post('long');

        $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($long).'&key=AIzaSyDx0U_l7WLDkzQ72SbpfaYIWCALbIa60wk'.'&sensor=true'); 
        $output = json_decode($geocodeFromLatLong);
        $status = $output->status;
        
        $jalan     = ($status=="OK")?$output->results[0]->address_components[1]->long_name:'';
        $nomer     = ($status=="OK")?$output->results[0]->address_components[0]->long_name:'';
        $desa      = ($status=="OK")?$output->results[0]->address_components[2]->long_name:'';
        $kecamatan = ($status=="OK")?$output->results[0]->address_components[3]->long_name:'';
        $kota      = ($status=="OK")?$output->results[0]->address_components[4]->long_name:'';
        $provinsi  = ($status=="OK")?$output->results[0]->address_components[5]->long_name:'';
        $negara    = ($status=="OK")?$output->results[0]->address_components[6]->long_name:'';
        $kode_pos  = ($status=="OK")?$output->results[0]->address_components[7]->long_name:'';

        $alamat = $jalan." ".$nomer.", ".$desa." ".$kecamatan." ".$kota." ".$provinsi." ".$negara." ".$kode_pos;

        $data   = [ 'nama_mesin'        => $this->input->post('nama'),
                    'tgl_jatuh_tempo'   => $this->input->post('tanggal'),
                    'alamat'            => $alamat,
                    'nilai_kontrak'     => $this->input->post('nilai_k'),
                    'lat'               => $this->input->post('lat'),
                    'long'              => $this->input->post('long')
                    ];

        $where  = [ 'id_mesin'   => $this->input->post('id_mesin') ];

        $hasil = $this->M_master->ubah_data('mesin', $data, $where);

        echo json_encode($hasil);
    }

    // proses hapus mesin
    public function hapus_mesin()
    {
        $where  = ['id_mesin'   => $this->input->post('id')];

        $hasil = $this->M_master->hapus_data('mesin', $where);

        echo json_encode($hasil);
    }

    /*************************/
    // MASTER JENIS REMINDER //
    /************************/

    // menampilkan halaman jenis reminder
    public function jenis_reminder()
    {
        $data   = [ 'jenis_reminder'    => 'active',
                    'judul'             => 'Jenis Reminder'
                ];

        $this->template->load('template', 'master/jenis_reminder/V_jenis_reminder', $data);
    }

    public function tampil_jenis_reminder()
    {
        $data_jenis_reminder = $this->M_master->get_data_jenis_reminder()->result_array();

        $no = 1;
        foreach ($data_jenis_reminder as $j) {
            $tbody  = array();

            $tbody[]    = "<div align='center'>".$no++."</div>";
            $tbody[]    = $j['bagian'];
            $tbody[]    = $j['jenis_tasklist'];
            //$tbody[]    = "<div align='right'>".$j['rentan_waktu']." Hari</div>";
            $aksi       = "<div align='center'> <button class='btn btn-icon btn-icon-circle btn-sun btn-icon-style-2 ubah-jenis' data-id=".$j['id_jenis_tasklist']."><span class='btn-icon-wrap'><i class='icon-pencil'></i></span></button>".' '."<button class='btn btn-icon btn-icon-circle btn-red btn-icon-style-2 hapus-jenis' id='id' data-id=".$j['id_jenis_tasklist']."><span class='btn-icon-wrap'><i class='icon-trash'></i></span></button> </div>";
            $tbody[]    = $aksi;
            $data[]     = $tbody;
        }

        if ($data_jenis_reminder) {
            echo json_encode(['data' => $data]);
        } else {
            echo json_encode(['data' => 0]);
        }
        
    }

    // proses tambah data
    public function tambah_jenis_reminder()
    {
        $data   = [ 'id_bagian'          => $this->input->post('bagian'),
                    'jenis_tasklist'  => $this->input->post('jenis_tasklist')
                  ];

        $hasil  = $this->M_master->input_data('jenis_task', $data);

        echo json_encode($hasil);
    }

    // mengambil data sesuai id_jenis_reminder
    public function form_edit_jenis()
    {
        $where  = ['id_jenis_tasklist' => $this->input->post('id')];
        
        $data['d_jenis_tasklist']   = $this->M_master->data_edit($this->input->post('id'))->row_array();
        $data['bagian']             = $this->M_master->get_data('bagian')->result_array();
        $data['jenis_task']         = $this->M_master->get_data('jenis_task')->result_array();

        $this->load->view('Master/jenis_reminder/V_edit_jenis_reminder', $data);
        
    }

    // proses update jenis reminder
    public function ubah_jenis_reminder()
    {
        $data   =   ['id_bagian'        => $this->input->post('id_bagian'),
                     'jenis_tasklist' => $this->input->post('jenis_tasklist')                     
                    ];

        $where  =   ['id_jenis_tasklist'    => $this->input->post('id_jenis_tasklist')];

        $hasil  = $this->M_master->ubah_data('jenis_task', $data, $where);

        echo json_encode($hasil);
    }

    // proses hapus jenis reminder
    public function hapus_jenis_reminder()
    {
        $where  = ['id_jenis_tasklist'  => $this->input->post('id')];

        $hasil  = $this->M_master->hapus_data('jenis_task', $where);

        echo json_encode($hasil);
    }

}

/* End of file Master.php */
