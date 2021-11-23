<style>
    #tabel_jenis_reminder tr th {
        text-align: center;
    }
</style>
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item active" aria-current="page">Jenis Reminder</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header mb-50">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="message-circle"></i></span></span>Master Data Jenis Reminder</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper table-responsive">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="form_data_jenis_reminder">

                </div>
                    
                <div class="card bg-light mb-30" id="tambah_jenis_reminder">
                    <div class="card-header" style="color: black">Tambah Jenis Reminder</div>
                    <form id="form_tambah_jenis_reminder">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" align="">Bagian</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="bagian" name="bagian">
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" align="">Jenis Tasklist</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="jenis_tasklist" id="jenis_tasklist" placeholder="jenis task" class="form-control"/>
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

            <table id="tabel_jenis_reminder" class="table table-bordered table-hover w-100 display pb-30">
                <thead class="thead-info">
                    <tr>
                        <th>No</th>
                        <th>Bagian</th>
                        <th>Jenis Tasklist</th>
                        <!-- <th>Rentan Waktu</th> -->
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
        
        // menampilkan list data jenis reminder
        var data_jenis_reminder = $('#tabel_jenis_reminder').DataTable({
            "processing"    : true,
            "ajax"          : "<?= base_url('Master/tampil_jenis_reminder') ?>",
            stateSave       : true,
            "order"         : []
        })

        // proses tambah jenis reminder
        $('#form_tambah_jenis_reminder').on('submit', function () {
            var bagian           = $('#bagian').val();
            var jenis_tasklist    = $('#jenis_tasklist').val();

            $.ajax({
                type    : "post",
                url     : "<?= base_url('Master/tambah_jenis_reminder') ?>",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses data',
                        onOpen  : () => {
                            swal.showLoading()
                        }
                    })
                },
                data        : {bagian:bagian,jenis_tasklist:jenis_tasklist},
                dataType    : "JSON",
                success     : function (data) {
                    data_jenis_reminder.ajax.reload(null, false);
                    
                    swal({
                        type    : 'success',
                        title   : 'Tambah Jenis Reminder',
                        text    : 'Anda Berhasil Menambah Jenis Reminder'
                    })

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

                    $('#bagian').val();
                    $('#jenis_tasklist').val();
                }
            })

            return false;
        })

        // untuk proses edit data
        $('#tabel_jenis_reminder').on('click', '.ubah-jenis', function () {
            var id_jenis_tasklist  = $(this).data('id');

            $.ajax({
                type        : "post",
                url         : "<?= base_url('Master/form_edit_jenis') ?>",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses data',
                        onOpen  : () => {
                            swal.showLoading()
                        }
                    })
                },
                data    : {id:id_jenis_tasklist},
                success : function (data) {
                    swal.close();
                    $('#form_data_jenis_reminder').html(data);
                    $('#tambah_jenis_reminder').hide();

                    $('#form_ubah_jenis_reminder').on('submit', function () {
                        var id_jenis_tasklist   = $('.id_jenis_tasklist').val();
                        var id_bagian   = $('.id_bagian').val();
                        var jenis_tasklist             = $('.jenis_tasklist').val();
                    

                        $.ajax({
                            type        : "post",
                            url         : "<?= base_url('Master/ubah_jenis_reminder') ?>",
                            beforeSend  : function () {
                                swal({
                                    title   : "Menunggu",
                                    html    : "Memproses Data",
                                    onOpen  : () => {
                                        swal.showLoading();
                                    }
                                })
                            },
                            data    : {id_bagian:id_bagian, jenis_tasklist:jenis_tasklist, id_jenis_tasklist:id_jenis_tasklist  },
                            success : function (data) {
                                data_jenis_reminder.ajax.reload(null, false);

                                swal({
                                    type    : 'success',
                                    title   : "Update Jenis Reminder",
                                    text    : "Anda berhasil mengubah Jenis Reminder"
                                })

                                $('#tambah_jenis_reminder').show();
                                $('#edit_jenis_reminder').hide();

                                $.toast().reset('all');
                                $("body").removeAttr('class');

                                $.toast({
                                    text                : '<i class="jq-toast-icon zmdi zmdi-notifications-active"></i><p class="mt-5">Data Berhasil Diubah.</p>',
                                    position            : 'top-right',
                                    loaderBg            :'#7a5449',
                                    class               : 'jq-has-icon jq-toast-info',
                                    hideAfter           : 5000, 
                                    stack               : 6,
                                    showHideTransition  : 'fade'
                                })

                                $('#level').val(0);
                                $('#rentan_waktu').val(0);
                                
                            }
                        })

                        return false;
                    }),

                    $('#form_ubah_jenis_reminder').on('click','#cancel', function () {
                        $.ajax({
                            beforeSend  : function () {
                                swal({
                                    title       : 'Batal',
                                    html        : 'Batal Memproses Data',
                                    onOpen      : () => {
                                        swal.showLoading();
                                    }
                                })
                            },

                            success     : function () {
                                swal.close();
                                $('#tambah_jenis_reminder').show();
                                $('#edit_jenis_reminder').hide();

                                $('#level').val(0);
                                $('#rentan_waktu').val(0);
                            }
                        })
                    })

                }
            })
        })

        // proses hapus jenis reminder
        $('#tabel_jenis_reminder').on('click', '.hapus-jenis', function () {
            
            var id_jenis_reminder = $(this).data('id');

            swal({
                type                : 'warning',
                title               : 'Konfirmasi',
                text                : "Anda ingin menghapus",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonText    : 'Tidak',
                cancelButtonColor   : '#3085d6',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type        : "post",
                        url         : "<?= base_url('Master/hapus_jenis_reminder') ?>",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses data',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        data        : {id:id_jenis_reminder},
                        success     : function (data) {
                            data_jenis_reminder.ajax.reload(null, false);

                            swal(
                                'Hapus',
                                'Berhasil dihapus',
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
                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal(
                        'Batal',
                        'Anda membatalkan penghapusan',
                        'error'
                    )
                }
            })
        })


    })

</script>