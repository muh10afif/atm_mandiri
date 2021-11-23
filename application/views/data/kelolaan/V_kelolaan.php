<style>
    #tabel_kelolaan tr th {
        text-align: center;
    }
</style>
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item">Data Kelolaan</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header mb-50">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="server"></i></span></span>Data Kelolaan</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper table-responsive">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="form_data_kelolaan">

                </div>
                    
                <div class="card bg-light mb-30" id="tambah_kelolaan">
                    <div class="card-header" style="color: black">Tambah Kelolaan</div>
                    <form id="form_tambah_kelolaan">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" align="">Nama Pegawai</label>
                                    <div class="col-sm-8">
                                        <select id="id_pegawai" class="form-control select2">
                                            <option value=" ">-- Pilih Karyawan --</option>
                                            <?php foreach ($d_karyawan as $k) : ?>
                                                <option value="<?= $k['id_karyawan'] ?>"><?= $k['nama_karyawan'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" align="">Unit Mesin</label>
                                    <div class="col-sm-8">
                                        <select id="id_mesin" class="form-control select2 mesin-lama">
                                            <option value=" ">-- Pilih Mesin --</option>
                                            <?php foreach ($d_mesin as $m) : ?>
                                                <option value="<?= $m['id_mesin'] ?>"><?= $m['nama_mesin'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <select id="id_mesin_1" class="form-control select2 mesin-baru">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-12">
                        <button class="btn btn-info float-right btn-wth-icon btn-rounded icon-right" type="submit"><span class="btn-text">Tambah Data</span> <span class="icon-label"><span class="feather-icon"><i data-feather="plus-circle"></i></span> </span></button>
                        </div>
                    </div>
                    </form>
                </div>

            </div>

            <table id="tabel_kelolaan" class="table table-bordered table-hover w-100 display pb-30">
                <thead class="thead-info">
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Nama Mesin</th>
                        <th width=25%;>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>

            </section>
        </div>
    </div>

</div>
<!-- /Container -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<script>

    $(document).ready(function () {

        $('.mesin-baru').next(".select2").hide();

        <?php if (!empty($d_mesin)): ?>
            $('#tambah_kelolaan').show();
        <?php else: ?>
            $('#tambah_kelolaan').hide();
        <?php endif; ?>
        
        // menampilkan data
        var data_kelolaan = $('#tabel_kelolaan').DataTable({
            "processing"    : true,
            "ajax"          : "<?= base_url('Data/tampil_kelolaan') ?>",
            stateSave       : true,
            "order"         : []
        })

        // aksi tambah data
        $('#form_tambah_kelolaan').on('submit', function () {
            var id_pegawai  = $('#id_pegawai').val();
            var id_mesin    = $('#id_mesin').val();

            var id_mesin_1  = $('#id_mesin_1').val();

            var id_mesin_2;

            if (id_mesin != null) {
                id_mesin_2    = $('#id_mesin').val();
            }
            if (id_mesin_1 != null) {
                id_mesin_2    = $('#id_mesin_1').val();
            }    

                if ((id_pegawai == ' ') || (id_mesin_2 == ' ')) {
                    
                    swal({
                        type    : 'warning',
                        title   : 'Peringatan',
                        text    : 'Data harus terisi dahulu'
                    })

                    return false;

                } else {

                    $.ajax({
                        type        : "post",
                        url         : "<?= base_url('data/tambah_kelolaan') ?>",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses data',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        data        : {id_karyawan:id_pegawai, id_mesin:id_mesin_2},
                        dataType    : "JSON",
                        success     : function (data) {
                            data_kelolaan.ajax.reload(null, false);

                            

                            if (data['cek'] == '0 id_mesin') {

                                $('.mesin-baru').next(".select2").show();
                                $('.mesin-baru').html(data['mesin']);
                                $('.mesin-lama').next(".select2").hide();

                                var a = data['mesin'];

                                if (a == 0) {
                                    $('#tambah_kelolaan').hide();
                                }
                                
                                swal({
                                    type    : 'success',
                                    title   : 'Tambah Kelolaan',
                                    text    : 'Anda berhasil tambah kelolaan'
                                })

                                // alert toast
                                $.toast().reset('all');
                                $("body").removeAttr('class');
                                $.toast({
                                    text                : '<i class="jq-toast-icon zmdi zmdi-notifications-active"></i><p class="mt-5">Data Berhasil Disimpan.</p>',
                                    position            : 'top-left',
                                    loaderBg            :'#7a5449',
                                    class               : 'jq-has-icon jq-toast-success',
                                    hideAfter           : 5000, 
                                    stack               : 6,
                                    showHideTransition  : 'fade'
                                });

                                $("#id_pegawai").select2("val", " ");
                                $('#id_mesin').select2("val", " ");

                            } else if (data['cek'] == '1 id_mesin') {
                                swal(
                                    'Peringatan',
                                    'Mesin yang dipilih SUDAH ADA pada data Kelola Mesin',
                                    'warning'
                                )
                            } else {
                                swal(
                                    'Peringatan',
                                    'Nama Pegawai dan Nama Mesin SUDAH ADA pada data kelola Mesin',
                                    'warning'
                                )
                            }

                            
                        }
                    })

                    return false;

                }

            
        })

        // proses ubah data
        $('#tabel_kelolaan').on('click', '.ubah-kelolaan', function () {
            
            var id_kelola_mesin = $(this).data('id');

            $.ajax({
                type        : "post",
                url         : "<?= base_url('data/form_edit_kelolaan') ?>",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses data',
                        onOpen  : () => {
                            swal.showLoading();
                        }
                    })
                },
                data        : {id_kelola_mesin:id_kelola_mesin},
                success     : function (data) {
                    swal.close();

                    $('#form_data_kelolaan').html(data);
                    $('#tambah_kelolaan').hide();

                    // aksi
                    $('#form_ubah_kelolaan').on('submit', function () {

                        var id_pegawai      = $('.id_pegawai').val();
                        var id_mesin        = $('.id_mesin').val();
                        var id_kelola_mesin = $('.id_kelola_mesin').val();
                        var id_pegawai_lama = $('.id_pegawai_lama').val();
                        var id_mesin_lama   = $('.id_mesin_lama').val();

                        if ((id_pegawai == ' ') || (id_mesin == ' ')) {
                    
                            swal({
                                type    : 'warning',
                                title   : 'Peringatan',
                                text    : 'Data harus terisi dahulu'
                            })

                            return false;

                        } else {

                            $.ajax({
                                type        : "post",
                                url         : "<?= base_url('data/ubah_kelolaan') ?>",
                                beforeSend  : function () {
                                    swal({
                                        title   : 'Menunggu',
                                        html    : 'Memproses data',
                                        onOpen  : () => {
                                            swal.showLoading();
                                        }
                                    })
                                },
                                data        : {id_karyawan:id_pegawai, id_mesin:id_mesin, id_kelola_mesin:id_kelola_mesin, id_pegawai_lama:id_pegawai_lama, id_mesin_lama:id_mesin_lama},
                                dataType    : "JSON",
                                success     : function (data) {
                                    data_kelolaan.ajax.reload(null, false);

                                    $('.mesin-lama').next(".select2").hide();
                                    $('.mesin-baru').next(".select2").show();
                                    $('#id_mesin_1').html(data['mesin']);

                                    if (data['cek'] == '0 id_mesin' || data['cek'] == '1 bisa masuk') {
                                
                                        swal({
                                            type    : 'success',
                                            title   : 'Ubah Kelolaan',
                                            text    : 'Anda berhasil mengubah kelolaan'
                                        })

                                        var a = data['mesin'];

                                        if (a == 0) {
                                            $('#tambah_kelolaan').hide();
                                        } else {
                                            $('#tambah_kelolaan').show();
                                        }

                                        $('#edit_kelolaan').hide();

                                        $.toast({
                                            text                : '<i class="jq-toast-icon zmdi zmdi-notifications-active"></i><p class="mt-5">Data Berhasil Diubah.</p>',
                                            position            : 'top-right',
                                            loaderBg            :'#7a5449',
                                            class               : 'jq-has-icon jq-toast-info',
                                            hideAfter           : 5000, 
                                            stack               : 6,
                                            showHideTransition  : 'fade'
                                        })

                                        $("#id_pegawai").select2("val", " ");
                                        $('#id_mesin').select2("val", " ");

                                    } else if (data['cek'] == '1 id_mesin') {
                                        swal(
                                            'Peringatan',
                                            'Mesin yang dipilih SUDAH ADA pada data Kelola Mesin',
                                            'warning'
                                        )
                                    } else {
                                        swal(
                                            'Peringatan',
                                            'Nama Pegawai dan Nama Mesin SUDAH ADA pada data kelola Mesin',
                                            'warning'
                                        )
                                    }


                                }
                            })

                            return false;

                        }

                    }),

                    $('#form_ubah_kelolaan').on('click','#cancel', function () {

                        var id = $(this).attr('value');

                        $.ajax({
                            type        : "post",
                            url         : "<?= base_url('data/ubah_kelolaan/1') ?>",
                            beforeSend  : function () {
                                swal({
                                    title       : 'Batal',
                                    html        : 'Batal Memproses Data',
                                    onOpen      : () => {
                                        swal.showLoading();
                                    }
                                })
                            },
                            dataType    : "JSON",
                            success     : function (data) {
                                swal.close();
                                $('.mesin-lama').next(".select2").hide();
                                $('.mesin-baru').next(".select2").show();
                                $('#id_mesin_1').html(data['mesin']);

                                var a = data['mesin'];

                                if (a == 0) {
                                    $('#tambah_kelolaan').hide();
                                } else {
                                    $('#tambah_kelolaan').show();
                                }

                                $('#edit_kelolaan').hide();

                                $("#id_pegawai").select2("val", " ");
                                $('#id_mesin').select2("val", " ");
                            }
                        })
                    })
                }
            })

        })

        // proses hapus kelolaan
        $('#tabel_kelolaan').on('click', '.hapus-kelolaan', function () {
            
            var id_kelola_mesin = $(this).data('id');

            swal({
                type            : 'warning',
                title           : 'Konfirmasi',
                text            : "Anda ingin menghapus",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonText    : 'Tidak',
                cancelButtonColor   : '#3085d6',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type        : 'post',
                        url         : "<?= base_url('data/hapus_kelolaan') ?>",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        data        : {id_kelola_mesin:id_kelola_mesin},
                        dataType    : "JSON",
                        success     : function (data) {
                            data_kelolaan.ajax.reload(null, false);

                            $('.mesin-lama').next(".select2").hide();
                            $('.mesin-baru').next(".select2").show();
                            $('#id_mesin_1').html(data['mesin']);

                            if (id == 0) {
                                $('#tambah_kelolaan').hide();
                            } else {
                                $('#tambah_kelolaan').show();
                            }

                            swal(
                                'Hapus',
                                'Berhasil Dihapus',
                                'success'
                            )
                            
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
                } else if (result.dismiss === swal.DismissReason.cancel ) {
                    swal(
                        'Batal',
                        'Anda Membatalkan Penghapusan',
                        'error'
                    )
                }
            })
            
        })

    }); // akhir document

</script>