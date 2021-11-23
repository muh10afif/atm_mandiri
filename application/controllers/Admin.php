<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('model_admin');
        $this->load->library('cek_login_lib');
    }

    public function index()
    {
        $data = [   
                    'judul'    => 'Home Admin',
                    'admin'    => 'active'
                ];
        $data['karyawan'] = $this->model_admin->tampil_karyawan()->result_array();
        $this->template->load('template', 'Admin/karyawan/master_karyawan', $data);
    }

     // menampilkan data karyawan dengan json
     public function tampil_karyawan()
     {   
         $data_karyawan = $this->model_admin->tampil_karyawan()->result_array();
         $no =1;
         foreach ($data_karyawan as $value) {
         
             $tbody = array();
             $tbody[] = "<div align='center'>".$no++."</div>";
             $tbody[] = $value['nama_karyawan'];
             $tbody[] = $value['alamat'];
             $tbody[] = $value['no_telp'];
             $aksi= "<div align='center'> <button class='btn btn-warning ubah-karyawan' id='id' data-toggle='modal' data-id_karyawan=".$value['id_karyawan'].">Edit</button>".' '."<button class='btn btn-danger hapus-karyawan' id='id' data-toggle='modal' data-id_karyawan=".$value['id_karyawan'].">Hapus</button> </div>";
             $tbody[] = $aksi;
             $data[]  = $tbody; 
         }
 
         if ($data_karyawan) {
             echo json_encode(array('data'=> $data));
         }else{
             echo json_encode(array('data'=>0));
         }
     }

    // proses tambah data mahasiswa
    public function tambah_karyawan()
    {
        $nama_karyawan  = $this->input->post('nama_karyawan');
        $alamat    = $this->input->post('alamat');
        $no_telp     = $this->input->post('no_telp');
        $status     = $this->input->post('status');
        
        $data       = [ 
                        'nama_karyawan' => $nama_karyawan,
                        'alamat' => $alamat,
                        'no_telp' => $no_telp,
                        'status'  => $status
                      ];
        
        $hasil      = $this->model_admin->input_karyawan('karyawan', $data);

        echo json_encode($hasil);
    }

    // menampilkan form edit mahasiswa
    public function form_edit_mahasiswa()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id_alternatif:id_alternatif}
        $where = ['id_alternatif' => $this->input->post('id_alternatif')];
        $data['data_per_mahasiswa'] = $this->model_admin->data_edit('tb_alternatif', $where);

        $this->load->view('master2014/mahasiswa/V_edit_mahasiswa',$data);
    }

    // proses ubah mahasiswa
    public function ubah_mahasiswa()
    {
        $input_data = [ 'nama' => $this->input->post('nama'),
                        'nim'           => $this->input->post('nim'),
                        'alamat'        => $this->input->post('alamat'),
                        'fakultas'       => $this->input->post('fakultas'),
                        'jurusan'   => $this->input->post('jurusan'),
                        'angkatan' => $this->input->post('angkatan')  
        ];

        $where = ['id_alternatif' => $this->input->post('id_alternatif') ];

        $data = $this->model_admin->ubah_data('tb_alternatif', $input_data, $where);

        echo json_encode($data);
    }

    // proses hapus mahasiswa
    public function hapus_karyawan()
    {
        $where = ['id_karyawan' => $this->input->post('id_karyawan') ];
        $data = $this->model_admin->hapus_data('karyawan', $where);

        echo json_encode($data);
    }
}