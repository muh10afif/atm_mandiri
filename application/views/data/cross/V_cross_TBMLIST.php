<style>
    #tabel_mon_pegawai tr th {
        text-align: center;
    }
</style>
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item">Tasklist</li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $bagian['bagian'] ?></li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container"> 

    <!-- Title -->
    <div class="hk-pg-header mb-50">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="users"></i></span></span>Tasklist <?php echo $bagian['bagian'] ?></h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper table-responsive">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#normal">Normal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#warning">Warning</a>
                    </li>
                </ul>
                <br/>
                <div class="tab-content">
                <div id="normal" class="container tab-pane active"><br>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">           
                        <div class="card bg-light mb-30" id="filter_kelolaan">
                            <form id="form_filter_kelolaan">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" align="">Jenis Task</label>
                                            <div class="col-sm-8">
                                                <select id="id_jenis" class="form-control select2">
                                                    <option value=" ">-- Pilih Jenis Tasklist</option>
                                                    <?php foreach ($d_karyawan as $k) : ?>
                                                        <option value="<?= $k['id_jenis_tasklist'] ?>"><?= $k['jenis_tasklist'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" align="center">
                                        <button class="btn btn-info btn-wth-icon btn-rounded icon-right mr-10" type="button" id="filter"><span class="btn-text">Filter</span> <span class="icon-label"><span class="feather-icon"><i data-feather="filter"></i></span> </span></button>
                                        <button class="btn btn-light btn-wth-icon btn-rounded icon-right" type="button" id="reset"><span class="btn-text">Reset</span> <span class="icon-label"><span class="feather-icon"><i data-feather="x"></i></span> </span></button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <table id="tabel_mon_pegawai" class="table table-bordered table-hover w-100 display pb-30">
                        <thead class="thead-info">
                            <tr>
                                <th>No</th>
                                <th>Jenis Task</th>
                                <th>Pemberi Tugas</th>
                                <th>Bagian</th>
                                <th>Penerima Tugas</th>
                                <th>Bagian</th>
                                <th>Tugas</th>
                                <th>Expire Date</th>
                                <th>Status</th>
                                <th width=20%;>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                <div id="warning" class="container tab-pane fade"><br>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">           
                        <div class="card bg-light mb-30" id="filter_kelolaan">
                            <form id="form_filter_kelolaan">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" align="">Jenis Task</label>
                                            <div class="col-sm-8">
                                                <select id="id_jenis" class="form-control select2">
                                                    <option value=" ">-- Pilih Jenis Tasklist</option>
                                                    <?php foreach ($d_karyawan as $k) : ?>
                                                        <option value="<?= $k['id_jenis_tasklist'] ?>"><?= $k['jenis_tasklist'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" align="center">
                                        <button class="btn btn-info btn-wth-icon btn-rounded icon-right mr-10" type="button" id="filter"><span class="btn-text">Filter</span> <span class="icon-label"><span class="feather-icon"><i data-feather="filter"></i></span> </span></button>
                                        <button class="btn btn-light btn-wth-icon btn-rounded icon-right" type="button" id="reset"><span class="btn-text">Reset</span> <span class="icon-label"><span class="feather-icon"><i data-feather="x"></i></span> </span></button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <table id="tabel_mon_pegawai" class="table table-bordered table-hover w-100 display pb-30">
                        <thead class="thead-info">
                            <tr>
                                <th>No</th>
                                <th>Jenis Task</th>
                                <th>Pemberi Tugas</th>
                                <th>Penerima Tugas</th>
                                <th>Tugas</th>
                                <th>Expire Date</th>
                                <th>Status</th>
                                <th width=20%;>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

</div>
<!-- /Container -->

<!-- Modal tambah data tasklist-->
<div id="tambah_task" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah_task" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title text-white" id="my-modal-title"><i class="fa fa-plus-circle"></i><?= nbs(2) ?>Tambah Tasklist</h5>
                <button class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="form_tambah_tasklist">
                <div class="form-group">
                    <label for="nama">Pegawai</label>
                    <select class="form-control" id="penerima_tugas">
                    <?php foreach($l_karyawan as $row){?>
                        <option value="<?= $row['id_karyawan'];?>"><?= $row['nama_karyawan'];?>-<?= $row['id_karyawan'];?></option>
                    <?php }?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">Jenis Task</label>
                    <select class="form-control" id="jenis_task">
                    <?php foreach($d_karyawan as $row){?>
                        <option value="<?= $row['id_jenis_tasklist'];?>"><?= $row['jenis_tasklist'];?></option>
                    <?php }?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tasklist">Tugas</label>
                    <input class="form-control" id="tasklist" placeholder="Masukkan tugas" type="text" required>
                </div>
                <div class="form-group">
                    <label for="no_telp">Expire Date</label>
                    <input class="form-control" id="expire_date" placeholder="Masukkan Expire Date" type="date" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                </div>

                <input type="hidden" id="pemberi_tugas" value="<?= $this->session->userdata('id_karyawan') ;?>"/>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-wth-icon btn-rounded icon-right"  data-dismiss="modal"><span class="btn-text">Tutup</span> <span class="icon-label"><span class="fa fa-close"></span> </span></button>
                <button type="submit" class="btn btn-success btn-wth-icon btn-rounded icon-right"><span class="btn-text">Tambah Data Karyawan</span> <span class="icon-label"><span class="fa fa-check"></span> </span></button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal tambah data tasklist-->

<!-- Modal Detail Monitoring Pegawai -->

<div id="detail_mon_pegawai" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detail_mon_pegawai_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title text-white" id="my-modal-title"><i class="fa fa-info"></i><?= nbs(2) ?>Detail Hasil Monitoring</h5>
                <button class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="form_detail_mon_pegawai">
            
            </div>
        </div>
    </div>
</div>

<!-- AKhir Modal Detail Monitoring Pegawai -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        
        // datatables
        var data_mon_pegawai = $('#tabel_mon_pegawai').DataTable({
             "processing"   : true,
             "serverSide"   : true,
             "order"        : [],

             "ajax"         : {
                "url"   : "<?php echo base_url("data/tampil_crosstask/1") ?>",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_jenis = $('#id_jenis').val();
                }
             },

             "columnDefs"   : [
                 {
                     "targets"      : [ 0 ],
                     "orderable"    : false,
                 }
             ],
        });

        $('#filter').click(function () {
            data_mon_pegawai.ajax.reload();
        })

        $('#reset').click(function () {
            $('#id_jenis').select2("val", ' ');
            data_mon_pegawai.ajax.reload();
        })

        // menampilkan detail hasil monitoring
        $('#tabel_mon_pegawai').on('click', '.detail-hasil-mon-pegawai', function () {
            
            var id_tasklist = $(this).data('id');

            $.ajax({
                type        : 'post',
                url         : "<?= base_url('data/form_detail_mon_pegawai') ?>",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses data',
                        onOpen  : () => {
                            swal.showLoading();
                        }
                    })
                },
                data        : {id_tasklist:id_tasklist},
                success     : function (data) {
                    swal.close();
                    $('#detail_mon_pegawai').modal('show');
                    $('#form_detail_mon_pegawai').html(data);
                },
                error       : function (jqXHR, textStatus, errorThrown) {
                    swal(
                        'Gagal',
                        'Tidak bisa menampilkan detail',
                        'error'
                    )
                }
            })
        })
        
        $('#form_tambah_tasklist').on('submit', function () {
        var penerima_tugas    = $('#penerima_tugas').val();
        var pemberi_tugas = $('#pemberi_tugas').val();
        var jenis_task = $('#jenis_task').val();
        var tasklist  = $('#tasklist').val();
        var expire_date = $('#expire_date').val();
        var keterangan = $('#keterangan').val();

            $.ajax({
                type    : "post",
                url     : "<?= base_url('Data/tambah_tasklist')?>",
                beforeSend :function () {
                swal({
                        title   : 'Menunggu',
                        html    : 'Memproses data',
                        onOpen  : () => {
                            swal.showLoading()
                        }
                    })     
                },
                data: {penerima_tugas:penerima_tugas,pemberi_tugas:pemberi_tugas, jenis_task:jenis_task,tasklist:tasklist, expire_date:expire_date, keterangan:keterangan}, // ambil datanya dari form yang ada di variabel
                dataType: "JSON",
                success: function (data) {
                    data_mon_pegawai.ajax.reload(null,false);
                    swal({
                            type    : 'success',
                            title   : 'Tambah Tasklist',
                            text    : 'Anda Berhasil Menambah Data Tasklist'
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
                    $('#tambah_task').modal('hide');
                    // tutup modal
                    $('#penerima_tugas').val('');
                    $('jenis_task').val();
                    $('#tasklist').val('');
                    $('#expire_date').val('');
                    $('#keterangan').val('');
                }
            });

        return false;
        });

    }); // akhir document

</script>