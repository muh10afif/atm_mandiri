<style>
    #tabel_karyawan thead tr th {
        text-align: center;
    }
</style>
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item active" aria-current="page">Karyawan</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    

    <div class="row mb-30">
        <div class="col-md-10">
            <div class="hk-pg-header">
                <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="users"></i></span></span>Master Data Karyawan</h4>
            </div>
        </div>
        <div class="col-md-2" align="left">
            <button class="btn btn-info btn-wth-icon btn-rounded icon-right mb-20" data-toggle="modal" data-target="#tambah_karyawan"><span class="btn-text">Tambah Data</span> <span class="icon-label"><span class="feather-icon"><i data-feather="plus-circle"></i></span> </span></button>
        </div>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper  table-responsive">

            <table id="tabel_karyawan" class="table table-bordered table-hover w-100 display pb-30">
                <thead class="thead-info">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Bagian</th>
                        <th width=25%;>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>

            </section>
        </div>
    </div>
    <!-- /Row -->
</div>
<!-- /Container -->

<!-- Modal Tambah Karyawan -->
<div id="tambah_karyawan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah_karyawan_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title text-white" id="my-modal-title"><i class="fa fa-plus-circle"></i><?= nbs(2) ?>Tambah Karyawan</h5>
                <button class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="form_tambah_karyawan">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input class="form-control" id="nama" placeholder="Masukkan Nama" type="text" required>
                </div>

                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input class="form-control" id="nik" placeholder="Masukkan NIK" type="number" required>
                </div>

                <div class="form-group">
                    <label for="no_telp">No Telepon</label>
                    <input class="form-control" id="no_telp" placeholder="Masukkan No Telepon" type="number" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="bagian">Bagian</label>
                    <select class="form-control" id="bagian" name="bagian">
                        <option value="0"></option>
                        <?php if($this->session->userdata('level') == 4 && $this->session->userdata('id_bagian') == 1)
                        {?>            
                        <option value="1">TBI</option>
                        <?php }elseif($this->session->userdata('level') == 5 && $this->session->userdata('id_bagian') == 1){?>
                        <option value="1">TBI</option>
                        <?php } elseif($this->session->userdata('level') == 4 && $this->session->userdata('id_bagian') == 2){?>
                        <option value="2">TBM</option>
                        <?php }elseif($this->session->userdata('level') == 5 && $this->session->userdata('id_bagian') == 2){?>
                        <option value="2">TBM</option>
                        <?php }elseif($this->session->userdata('level') == 3 && $this->session->userdata('id_bagian') == 1){?>
                        <option value="1">TBI</option>
                        <?php }elseif($this->session->userdata('level') == 3 && $this->session->userdata('id_bagian') == 2){?>
                        <option value="2">TBM</option>
                        <?php }else{?>
                        <option value="1">TBI</option>
                        <option value="2">TBM</option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-wth-icon btn-rounded icon-right"  data-dismiss="modal"><span class="btn-text">Tutup</span> <span class="icon-label"><span class="fa fa-close"></span> </span></button>
                <button type="submit" class="btn btn-success btn-wth-icon btn-rounded icon-right"><span class="btn-text">Tambah Data Karyawan</span> <span class="icon-label"><span class="fa fa-check"></span> </span></button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah Karyawan -->

<!-- Modal Edit Karyawan -->

<div id="edit_karyawan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit_karyawan_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title text-white" id="my-modal-title"><i class="fa fa-edit"></i><?= nbs(2) ?>Edit Karyawan</h5>
                <button class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="form_data_karyawan">
        </div>
    </div>
</div>

<!-- AKhir Modal Edit Karyawan -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<script>
$(document).ready(function () {

    $('#pesan').hide();
    $('#pesan_hapus').hide();
    
    var data_karyawan = $('#tabel_karyawan').DataTable({
            "processing"    : true,
            "ajax"          : "<?=base_url("Master/tampil_karyawan")?>",
            stateSave       : true,
            "order"         : []
    });

    // fungsi untuk menambah data  
    // pilih selector dari yang id form_tambah_karyawan  
    $('#form_tambah_karyawan').on('submit', function () {
    var nama    = $('#nama').val(); // diambil dari id nama yang ada diform modal
    var alamat  = $('#alamat').val(); // diambil dari id alamat yanag ada di form modal 
    var nik     = $('#nik').val();
    var no_telp = $('#no_telp').val();
    var bagian  = $('#bagian').val();

        $.ajax({
            type    : "post",
            url     : "<?= base_url('Master/tambah_karyawan')?>",
            beforeSend :function () {
            swal({
                    title   : 'Menunggu',
                    html    : 'Memproses data',
                    onOpen  : () => {
                        swal.showLoading()
                    }
                })     
            },
            data: {nama:nama,alamat:alamat, nik:nik, no_telp:no_telp,bagian:bagian}, // ambil datanya dari form yang ada di variabel
            dataType: "JSON",
            success: function (data) {
                data_karyawan.ajax.reload(null,false);
                swal({
                        type    : 'success',
                        title   : 'Tambah Karyawan',
                        text    : 'Anda Berhasil Menambah Karyawan'
                    });

                $.toast().reset('all');
                $("body").removeAttr('class');
                $.toast({
                    text: '<i class="jq-toast-icon zmdi zmdi-notifications-active"></i><p class="mt-5">Data Berhasil Disimpan.</p>',
                    position: 'top-left',
                    loaderBg:'#7a5449',
                    class: 'jq-has-icon jq-toast-success',
                    hideAfter: 5000, 
                    stack: 6,
                    showHideTransition: 'fade'
                });

                // bersihkan form pada modal
                $('#tambah_karyawan').modal('hide');
                // tutup modal
                $('#nama').val('');
                $('#alamat').val('');
                $('#nik').val('');
                $('#no_telp').val('');
            }
        });

    return false;
    });

    // fungsi untuk edit data
    //pilih selector dari table id datamahasiswa dengan class .ubah-mahasiswa
    $('#tabel_karyawan').on('click','.ubah-karyawan', function () {
    // ambil element id pada saat klik ubah
    var id_karyawan =  $(this).data('id');
    
        $.ajax({
            type: "post",
            url: "<?= base_url('Master/form_edit_karyawan')?>",
            beforeSend :function () {
            swal({
                title: 'Menunggu',
                html: 'Memproses data',
                onOpen: () => {
                    swal.showLoading()
                }
                })      
            },
            data: {id:id_karyawan},
            success: function (data) {
            swal.close();
            $('#edit_karyawan').modal('show');
            $('#form_data_karyawan').html(data);
            
            // proses untuk mengubah data
            $('#form_ubah_karyawan').on('submit', function () {
                var nama    = $('.nama').val(); // diambil dari id nama yang ada diform modal
                var nik     = $('.nik').val(); // diambil dari id alamat yanag ada di form modal 
                var alamat  = $('.alamat').val();
                var no_telp = $('.no_telp').val();
                var id_kr   = $('.id_karyawan').val(); //diambil dari id_karyawan yang ada di form modal
                var bagian  = $('.bagian').val();

                $.ajax({
                    type: "post",
                    url: "<?= base_url('Master/ubah_karyawan')?>",
                    beforeSend :function () {
                    swal({
                            title   : 'Menunggu',
                            html    : 'Memproses data',
                            onOpen  : () => {
                                swal.showLoading()
                            }
                        })      
                    },
                    data: {nama:nama,nik:nik,alamat:alamat,no_telp:no_telp,id_karyawan:id_kr,bagian:bagian}, // ambil datanya dari form yang ada di variabel
                    
                    success: function (data) {
                    data_karyawan.ajax.reload(null,false);
                    swal({
                            type    : 'success',
                            title   : 'Update Karyawan',
                            text    : 'Anda Berhasil Mengubah Data Karyawan'
                        })

                        $.toast().reset('all');
                        $("body").removeAttr('class');

                        $.toast({
                            text: '<i class="jq-toast-icon zmdi zmdi-notifications-active"></i><p class="mt-5">Data Berhasil Diubah.</p>',
                            position: 'top-right',
                            loaderBg:'#7a5449',
                            class: 'jq-has-icon jq-toast-info',
                            hideAfter: 5000, 
                            stack: 6,
                            showHideTransition: 'fade'
                        })

                        // bersihkan form pada modal
                        $('#edit_karyawan').modal('hide');

                    }
                });

                return false;
                });
            }
        });
    });

    // fungsi untuk hapus data
    //pilih selector dari table id data_karyawan dengan class .hapus-karyawan
    $('#tabel_karyawan').on('click','.hapus-karyawan', function () {
    var id =  $(this).data('id');
    swal({
        title: 'Konfirmasi',
        text: "Anda ingin menghapus ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Tidak',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            $.ajax({
            url:"<?=base_url('Master/hapus_karyawan')?>",  
            method:"post",
            beforeSend :function () {
            swal({
                title: 'Menunggu',
                html: 'Memproses data',
                onOpen: () => {
                    swal.showLoading()
                }
                })      
            },    
            data:{id:id},
            success:function(data){
                swal(
                'Hapus',
                'Berhasil Terhapus',
                'success'
                )
                data_karyawan.ajax.reload(null, false);

                $.toast().reset('all');
                $("body").removeAttr('class');

                $.toast({
                    text        : '<i class="jq-toast-icon zmdi zmdi-notifications-active"></i><p class="mt-5">Data Berhasil Dihapus.</p>',
                    position    : 'bottom-right',
                    loaderBg    : '#7a5449',
                    class       : 'jq-has-icon jq-toast-danger',
                    hideAfter   : 5000, 
                    stack       : 6,
                    showHideTransition  : 'fade'
                })
            }
            })
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal(
            'Batal',
            'Anda membatalkan penghapusan',
            'error'
            )
        }
        })
    });
    
});
</script>

