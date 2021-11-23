<style>
    #tabel_due_date tr th {
        text-align: center;
    }
    #tabel_warning tr th {
        text-align: center;
    }
    #tabel_save tr th {
        text-align: center;
    }
</style>
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item">Monitoring</li>
        <li class="breadcrumb-item active" aria-current="page">Sewa Tempat</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header mb-50">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="map-pin"></i></span></span>Monitoring Sewa Tempat</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper table-responsive">

            <nav>
                <div class="nav nav-pills" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-due-date-tab" data-toggle="tab" href="#nav-due-date" role="tab" aria-controls="nav-due-date" aria-selected="true">Due Date</a>
                    <a class="nav-item nav-link" id="nav-warning-tab" data-toggle="tab" href="#nav-warning" role="tab" aria-controls="nav-warning" aria-selected="false">Warning</a>
                    <a class="nav-item nav-link" id="nav-save-tab" data-toggle="tab" href="#nav-save" role="tab" aria-controls="nav-save" aria-selected="false">Save</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active mt-30" id="nav-due-date" role="tabpanel" aria-labelledby="nav-due-date-tab">
                    <table id="tabel_due_date" class="table table-bordered table-hover w-100 display pb-30">
                        <thead class="thead-info">
                            <tr>
                                <th>No</th>
                                <th>Nama Unit</th>
                                <th>Alamat</th>
                                <th width="20%">Tanggal Jatuh Tempo</th>
                                <th width=15%;>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade mt-30" id="nav-warning" role="tabpanel" aria-labelledby="nav-warning-tab">

                    <table id="tabel_warning" class="table table-bordered table-hover w-100 display pb-30 mt-30">
                        <thead class="thead-info">
                            <tr>
                                <th>No</th>
                                <th>Nama Unit</th>
                                <th>Alamat</th>
                                <th width="20%">Tanggal Jatuh Tempo</th>
                                <th width=15%;>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    
                </div>
                <div class="tab-pane fade mt-30" id="nav-save" role="tabpanel" aria-labelledby="nav-save-tab">

                    <table id="tabel_save" class="table table-bordered table-hover w-100 display pb-30 mt-30">
                        <thead class="thead-info">
                            <tr>
                                <th>No</th>
                                <th>Nama Unit</th>
                                <th>Alamat</th>
                                <th width="20%">Tanggal Jatuh Tempo</th>
                                <th width=15%;>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>

                </div>
            </div>

            </section>
        </div>
    </div>

</div>
<!-- /Container -->


<!-- Modal Detail Monitoring Sewa Tempat -->

<div id="detail_sewa_tempat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detail_sewa_tempat_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title text-white" id="my-modal-title"><i class="fa fa-info"></i><?= nbs(2) ?>Detail Hasil Monitoring</h5>
                <button class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="form_detail_sewa_tempat">
            
            </div>
        </div>
    </div>
</div>

<!-- AKhir Modal Detail Monitoring Sewa Tempat -->


<!-- jQuery -->
<script src="<?= base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<script>

    $(document).ready(function () {
        
        var tabel_due_date = $('#tabel_due_date').DataTable({
            "processing"    : true,
            "ajax"          : "<?= base_url('data/tampil_data_status/3') ?>",
            stateSave       : true,
            "order"         : [],
        })

        tabel_due_date.search('');

        var tabel_warning = $('#tabel_warning').DataTable({
            "processing"    : true,
            "ajax"          : "<?= base_url('data/tampil_data_status/2') ?>",
            stateSave       : true,
            "order"         : []
        })

        tabel_warning.search('');

        var tabel_save = $('#tabel_save').DataTable({
            "processing"    : true,
            "ajax"          : "<?= base_url('data/tampil_data_status/1') ?>",
            stateSave       : true,
            "order"         : []
        })

        tabel_save.search('');

        <?php $tabel = ['#tabel_due_date', '#tabel_warning', '#tabel_save'] ?>

        <?php for ($i=0; $i < count($tabel); $i++): ?>

            $('<?= $tabel[$i] ?>').on('click', '.detail-sewa-tempat', function () {
                
                var id_mesin = $(this).data('id');

                $.ajax({
                    type        : 'post',
                    url         : "<?= base_url('data/form_detail_sewa_tempat') ?>",
                    beforeSend  : function () {
                        swal({
                            title   : 'Menunggu',
                            html    : 'Memproses data',
                            onOpen  : () => {
                                swal.showLoading();
                            }
                        })
                    },
                    data        : {id_mesin:id_mesin},
                    success     : function (data) {
                        swal.close();
                        $('#detail_sewa_tempat').modal('show');
                        $('#form_detail_sewa_tempat').html(data);
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
            
        <?php endfor; ?>

    })

</script>