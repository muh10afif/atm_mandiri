<style>
    #tabel_reminder tr th {
        text-align: center;
    }
</style>
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item active" aria-current="page">Data Reminder</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header mb-50">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="message-circle"></i></span></span>Data Reminder</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper table-responsive">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="form_data_reminder">

                </div>
                    
                <div class="card bg-light mb-30" id="tambah_reminder">
                    <div class="card-header" style="color: black">Tambah Reminder</div>
                    <form id="form_tambah_reminder">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" align="">Mesin</label>
                                    <div class="col-sm-8">
                                        <select id="id_mesin" class="form-control select2">
                                                <option value=" ">-- Pilih Mesin --</option>
                                            <?php foreach ($d_mesin as $m): ?>
                                                <option value="<?= $m['id_mesin'] ?>"><?= $m['nama_mesin'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" align="">Jenis Reminder</label>
                                    <div class="col-sm-8">
                                        <select id="id_jenis_reminder" class="form-control select2">
                                            <option value=" ">-- Pilih Jenis Reminder --</option>
                                            <?php foreach ($d_jenis as $j) : ?>
                                                <option value="<?= $j['id_jenis_reminder'] ?>">Level <?= $j['level'] ?></option>
                                            <?php endforeach; ?>
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

            <table id="tabel_reminder" class="table table-bordered table-hover w-100 display pb-30">
                <thead class="thead-info">
                    <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>Mesin</th>
                        <th>Jenis Reminder</th>
                        <th>Status</th>
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
        
        var data_reminder = $('#tabel_reminder').DataTable({
            'processing'    : true,
            'ajax'          : "<?= base_url('data/tampil_reminder') ?>",
            stateSave       : true,
            'order'         : []
        })

        $('#form_tambah_reminder').on('submit', function () {
            var id_mesin        = $('#id_mesin').val();
            var id_jns_reminder = $('#id_jenis_reminder').val();

            if ((id_mesin == ' ') || (id_jns_reminder == ' ')) {
                
                swal({
                    type    : 'warning',
                    title   : 'Peringatan',
                    text    : 'Data harus terisi dahulu!'
                })

                return false;

            } else {

                $.ajax({
                    type        : 'post',
                    url         : "<?= base_url('data/tambah_reminder') ?>",
                    beforeSend  : function () {
                        swal({
                            title   : 'Menunggu',
                            html    : 'Memproses Data',
                            onOpen  : () => {
                                swal.showLoading();
                            }
                        })
                    },
                    data        : {id_mesin:id_mesin,id_jenis_reminder:id_jns_reminder},
                    dataType    : "JSON",
                    success     : function (data) {

                        data_reminder.ajax.reload(null, false);

                        if (data['cek'] == 1) {
                            
                            swal({
                                type    : 'success',
                                title   : 'Tambah Reminder',
                                text    : 'Anda berhasil simpan data reminder'
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

                            $('#id_mesin').select2("val", ' ');
                            $('#id_jenis_reminder').select2("val", ' ');

                        } else {

                            swal(
                                'Peringatan',
                                'Data sudah ada pada tabel Reminder',
                                'warning'
                            )
                            
                        }

                        

                    }
                })

                return false;
                
            }
        })

        // proses ubah data reminder
        $('#tabel_reminder').on('click', '.ubah-reminder', function () {
            
            var id_reminder = $(this).data('id');

            $.ajax({
                type        : 'post',
                url         : "<?= base_url('data/form_edit_reminder') ?>",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses data',
                        onOpen  : () => {
                            swal.showLoading();
                        }
                    })
                },
                data        : {id_reminder:id_reminder},
                success     : function (data) {
                    swal.close();

                    $('#form_data_reminder').html(data);
                    $('#tambah_reminder').hide();

                    // aksi simpan
                    $('#form_ubah_reminder').on('submit', function () {
                        var id_reminder     = $('.id_reminder').val();
                        var id_mesin        = $('.id_mesin').val();
                        var id_jns_reminder = $('.id_jenis_reminder').val();

                        if ((id_mesin == ' ') || (id_jns_reminder == ' ')) {

                            swal({
                                type    : 'warning',
                                title   : 'Peringatan',
                                text    : 'Data harus terisi dahulu'
                            })

                            return false;
                            
                        } else {
                        
                            $.ajax({
                                type        : 'post',
                                url         : "<?= base_url('data/ubah_reminder') ?>",
                                beforeSend  : function () {
                                    swal({
                                        title   : 'Menunggu',
                                        html    : 'Memproses data',
                                        onOpen  : () => {
                                            swal.showLoading();
                                        }
                                    })
                                },
                                data        : {id_reminder:id_reminder,id_mesin:id_mesin,id_jenis_reminder:id_jns_reminder},
                                dataType    : "JSON",
                                success     : function (data) {
                                    data_reminder.ajax.reload(null, false);

                                    swal({
                                        type    : 'success',
                                        title   : 'Ubah Reminder',
                                        text    : 'Anda berhasil menguabah data reminder'
                                    })

                                    $('#tambah_reminder').show();
                                    $('#edit_reminder').hide();

                                    $.toast({
                                        text                : '<i class="jq-toast-icon zmdi zmdi-notifications-active"></i><p class="mt-5">Data Berhasil Diubah.</p>',
                                        position            : 'top-right',
                                        loaderBg            :'#7a5449',
                                        class               : 'jq-has-icon jq-toast-info',
                                        hideAfter           : 5000, 
                                        stack               : 6,
                                        showHideTransition  : 'fade'
                                    })

                                    $('#id_mesin').select2("val", " ");
                                    $('#id_jenis_reminder').select2("val", " ");
                                }
                            })

                            return false;
                        
                        }
                    }),

                    $('#form_ubah_reminder').on('click', '#cancel', function () {
                        $.ajax({
                            beforeSend  : function () {
                                swal({
                                    title   : 'Batal',
                                    html    : 'Batal Memproses Data',
                                    onOpen  : () => {
                                        swal.showLoading();
                                    }
                                })
                            },

                            success     : function () {
                                swal.close();

                                $('#tambah_reminder').show();
                                $('#edit_reminder').hide();

                                $('#id_mesin').select2("val", " ");
                                $('#id_jenis_reminder').select2("val", " ");
                            }
                        })
                    })
                }
            })
        })

        // proses hapus reminder
        $('#tabel_reminder').on('click', '.hapus-reminder', function () {

            var id_reminder = $(this).data('id');

            swal({
                type    : 'warning',
                title   : 'Konfirmasi',
                text    : 'Anda ingin menghapus',

                showCancelButton    : true,
                confirmButtonColor  : '#d33',
                confirmButtonText   : 'Hapus',
                cancelButtonColor   : '#3085d6',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type        : 'post',
                        url         : "<?= base_url('data/hapus_reminder') ?>",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOnpen : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        data        : {id_reminder:id_reminder},
                        success     : function (data) {
                            data_reminder.ajax.reload(null, false);

                            swal(
                                'Hapus',
                                'Berhasil Dihapus',
                                'success'
                            )

                            $.toast().reset('all');
                            $("body").removeAttr('class');

                            $.toast({
                                text                : '<i class="jq-toast-icon zmdi zmdi-notifications-active"></i><p class="mt-5">Data Berhasil Dihapus.</p>',
                                position            : 'bottom-right',
                                loaderBg            : '#7a5449',
                                class               : 'jq-has-icon jq-toast-danger',
                                hideAfter           : 5000, 
                                stack               : 6,
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
            
        })

    }); // akhir document

</script>