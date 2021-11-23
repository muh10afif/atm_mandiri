<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Mandiri</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Master Data</a></li>
                    <li class="breadcrumb-item active">Data Karyawan</li>
                </ol>
            </div>
            <h4 class="page-title">Data Karyawan</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="mt-0">Master Data Karyawan</h5>
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <Button class="btn btn-primary" style="align:right" data-toggle="modal" data-target="#tambah_data_karyawan">Tambah Karyawan</Button>
                        </div>
                    </div>
                    <table id="tabel_karyawan" class="table table-bordered">
                        <thead class="thead-info">
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th width=25%;>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<!-- Modal Tambah Mahasiswa -->
<div id="tambah_data_karyawan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah_data_karyawan" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info ">
                <h5 class="modal-title text-gray" id="my-modal-title"><?= nbs(2) ?>Tambah Data Karyawan</h5>
                <button class="close text-gray" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="form_tambah_karyawan">
                <div class="form-group">
                    <label for="nama_karyawan">Nama Karyawan</label>
                    <input class="form-control" id="nama_karyawan" type="text" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input class="form-control" id="alamat" type="text" required>
                </div>

                <div class="form-group">
                    <label for="no_telp">Nomor Telepon</label>
                    <input class="form-control" id="no_telp" required/>
                </div>
                <div class="form-group">
                    <label for="nama">Status</label>
                    <select id = "status" class="form-control" >
                        <option value = "1">Aktif</option>
                        <option value = "0">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"  data-dismiss="modal"><span class="btn-text">Tutup</span></button>
                <button type="submit" class="btn btn-success"><span class="btn-text">Simpan</span></button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah Mahasiswa -->
<script>
$(document).ready(function () {

    $('#pesan').hide();
    $('#pesan_hapus').hide();
    
    var data_karyawan = $('#tabel_karyawan').DataTable({
            "processing"    : true,
            "ajax"          : "<?=base_url("Admin/tampil_karyawan")?>",
            stateSave       : true,
            "order"         : []
    });

    // fungsi untuk menambah data  
    // pilih selector dari yang id form_tambah_karyawan  
    $('#form_tambah_karyawan').on('submit', function () {
    var nama_karyawan  = $('#nama_karyawan').val(); // diambil dari id alamat yanag ada di form modal 
    var alamat  = $('#alamat').val();
    var no_telp = $('#no_telp').val();
    var status = $('#status').val();

        $.ajax({
            type    : "post",
            url     : "<?= base_url('Admin/tambah_karyawan')?>",
            beforeSend :function () {
            swal({
                    title   : 'Menunggu',
                    html    : 'Memproses data',
                    onOpen  : () => {
                        swal.showLoading()
                    }
                })     
            },
            data: {nama_karyawan:nama_karyawan, alamat:alamat, no_telp:no_telp, status:status}, // ambil datanya dari form yang ada di variabel
            dataType: "JSON",
            success: function (data) {
                data_karyawan.ajax.reload(null,false);
                swal({
                        type    : 'success',
                        title   : 'Tambah Data Karyawan',
                        text    : 'Anda Berhasil Menambah Data Karyawan'
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
                $('#tambah_data_karyawan').modal('hide');
                // tutup modal
                $('#nama_karyawan').val('');
                $('#alamat').val('');
                $('#no_telp').val('');
                $('#status').val('');
            }
        });

    return false;
    });

    // fungsi untuk edit data
    //pilih selector dari table id datamahasiswa dengan class .ubah-mahasiswa
    $('#tabel_karyawan').on('click','.ubah-karyawan', function () {
    // ambil element id pada saat klik ubah
    var id_karyawan =  $(this).data('id_karyawan');
    
        $.ajax({
            type: "post",
            url: "<?= base_url('Admin/form_edit_karyawan')?>",
            beforeSend :function () {
            swal({
                title: 'Menunggu',
                html: 'Memproses data',
                onOpen: () => {
                    swal.showLoading()
                }
                })      
            },
            data: {id_karyawan:id_karyawan},
            success: function (data) {
            swal.close();
            $('#edit_karyawan').modal('show');
            $('#form_edit_karyawan').html(data);
            
            // proses untuk mengubah data
            $('#form_ubah_karyawan').on('submit', function () {
                var nama_karyawan    = $('.nama_karyawan').val(); // diambil dari id nama yang ada diform modal
                var alamat  = $('.alamat').val();
                var no_telp = $('.no_telp').val();
                var status = $('.status').val();
                var id_karyawan   = $('.id_karyawan').val(); //diambil dari id_alternatif yang ada di form modal

                $.ajax({
                    type: "post",
                    url: "<?= base_url('Admin/ubah_karyawan')?>",
                    beforeSend :function () {
                    swal({
                            title   : 'Menunggu',
                            html    : 'Memproses data',
                            onOpen  : () => {
                                swal.showLoading()
                            }
                        })      
                    },
                    data: {nama_karyawan:nama_karyawan,alamat:alamat,no_telp:no_telp,status:status,id_karyawan:id_karyawan}, // ambil datanya dari form yang ada di variabel
                    
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
    //pilih selector dari table id data_mahasiswa dengan class .hapus-mahasiswa
    $('#tabel_karyawan').on('click','.hapus-karyawan', function () {
    var id =  $(this).data('id_karyawan');
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
            url:"<?=base_url('Admin/hapus_karyawan')?>",  
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
            data:{id:id_karyawan},
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