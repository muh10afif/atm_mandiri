<style>
    #tabel_pengguna tr th {
        text-align: center;
    }
</style>
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header mb-50">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="user"></i></span></span>Master Data Pengguna</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper table-responsive">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
                <div id="form_data_pengguna">

                </div>
                
                <div class="card bg-light mb-30" id="tambah_pengguna">
                    <div class="card-header" style="color: black">Tambah Pengguna</div>
                    <form id="form_tambah_pengguna">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Karyawan</label>
                                    <div class="col-sm-8">
                                        <select id="karyawan" class="form-control select2 awal-karyawan">
                                            <option value=" ">-- Pilih Karyawan --</option>
                                            <?php foreach ($d_karyawan as $k): ?>
                                                <option value="<?= $k['id_karyawan'] ?>"><?= $k['nama_karyawan'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <select id="karyawan_1" class="form-control select2 nama-karyawan">
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Level</label>
                                    <div class="col-sm-8">
                                        <select name="level" id="level" class="form-control select2">
                                            <option value=" ">-- Pilih Level --</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Head</option>
                                            <option value="3">Manager</option>
                                            <option value="4">Officer</option>
                                            <option value="5">Team</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Username</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" onclick="myFunction()">
                                            <label class="custom-control-label" for="customCheck1">Show Password</label>
                                        </div>
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

            <table id="tabel_pengguna" class="table table-bordered table-hover w-100 display pb-30">
                <thead class="thead-info">
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Username</th>
                        <th>No Registrasi</th>
                        <th>Level</th>
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

<!-- jQuery -->
<script src="<?= base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<script>

    function myFunction() {
        var x = document.getElementById("password");
        
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    $(document).ready(function () {

        $('#pesan').hide();
        $('#pesan_hapus').hide();
        $('#tambah_pengguna').show();
        $('.nama-karyawan').next(".select2").hide();

        <?php if ($d_karyawan): ?>
            $('#tambah_pengguna').show();
        <?php else: ?>
            $('#tambah_pengguna').hide();
        <?php endif; ?>

        // menampilkan data dengan dataTables
        var data_pengguna = $('#tabel_pengguna').DataTable({
            "processing"    : true,
            "ajax"          : "<?= base_url("Master/tampil_pengguna") ?>",
            stateSave       : true,
            "order"         : []
        });

        // untuk proses tambah pengguna
        $('#form_tambah_pengguna').on('submit', function () {
            var karyawan    = $('#karyawan').val();

            var karyawan_1  = $('.nama-karyawan').val();

            var karyawan_2;

            if (karyawan != null) {
                karyawan_2    = $('#karyawan').val();
            }
            if (karyawan_1 != null) {
                karyawan_2    = $('.nama-karyawan').val();
            }
                
            var level       = $('#level').val();
            var username    = $('#username').val();
            var password    = $('#password').val();

            if ((karyawan_2 == ' ') || (level == ' ') || (username == '') || (password == '' )) {

                swal(
                    'Peringatan',
                    'Data harus terisi dahulu',
                    'warning'
                )
                
                return false;
            }
            else {
                <?php
                        $this->db->select('*');
                        $this->db->from('pengguna');
                        $this->db->where('level', 3);
                        $var = $this->db->get()->num_rows();
                        
                        if($var != '0')
                        {
                    ?>
                           swal({
                            title   : 'Konfirmasi',
                            text    : "Anda ingin menambah manager",
                            type    : 'warning',

                            showCancelButton    : true,
                            confirmButtonText   : 'Tambah',
                            confirmButtonColor  : '#3085d6',
                            cancelButtonColor   : '#d33',
                            cancelButtonText    : 'Tidak',
                            reverseButtons      : true
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    type    : "post",
                                url     : "<?= base_url('Master/tambah_pengguna') ?>",
                                beforeSend  : function () {
                                    swal({
                                        title   : 'Menunggu',
                                        html    : 'Memproses data',
                                        onOpen  : () => {
                                            swal.showLoading()
                                        }
                                    })
                                },
                                data        : {karyawan:karyawan_2,level:level,username:username,password:password},
                                dataType    : "JSON",
                                success     : function (data) {
                                    data_pengguna.ajax.reload(null, false);

                                    $('.nama-karyawan').next(".select2").show();
                                    $('.nama-karyawan').html(data['karyawan']);
                                    $('.awal-karyawan').next(".select2").hide();

                                    var a = data['karyawan'];
                                    
                                    if (a == 0) {
                                        $('#tambah_pengguna').hide();
                                    }

                                    
                                        swal({
                                            type    : 'success',
                                            title   : 'Tambah Pengguna',
                                            text    : 'Anda berhasil menambah Karyawan'
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

                                        $('#karyawan').select2("val", ' ');
                                        $('#level').select2("val", ' ');
                                        $('#username').val('');
                                        $('#password').val('');

                                    
                                }
                                })
                            } else if (result.dismiss === swal.DismissReason.cancel) {
                                swal(
                                    'Batal',
                                    'Anda membatalkan tambah pengguna level manager',
                                    'error'
                                )
                            }
                        })

                    <?php    }else{ ?>
                        $.ajax({
                            type    : "post",
                            url     : "<?= base_url('Master/tambah_pengguna') ?>",
                            beforeSend  : function () {
                                swal({
                                    title   : 'Menunggu',
                                    html    : 'Memproses data',
                                    onOpen  : () => {
                                        swal.showLoading()
                                    }
                                })
                            },
                            data        : {karyawan:karyawan_2,level:level,username:username,password:password},
                            dataType    : "JSON",
                            success     : function (data) {
                                data_pengguna.ajax.reload(null, false);

                                $('.nama-karyawan').next(".select2").show();
                                $('.nama-karyawan').html(data['karyawan']);
                                $('.awal-karyawan').next(".select2").hide();

                                var a = data['karyawan'];
                                
                                if (a == 0) {
                                    $('#tambah_pengguna').hide();
                                }

                                
                                    swal({
                                        type    : 'success',
                                        title   : 'Tambah Pengguna',
                                        text    : 'Anda berhasil menambah Karyawan'
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

                                    $('#karyawan').select2("val", ' ');
                                    $('#level').select2("val", ' ');
                                    $('#username').val('');
                                    $('#password').val('');

                                
                            }
                        })
                    <?php } ?>
                return false;
            }
        })

        // untuk proses edit data
        $('#tabel_pengguna').on('click','.ubah-pengguna', function () {
            
            var id_pengguna = $(this).data('id');

            $.ajax({
                type    : "post",
                url     : "<?= base_url('Master/form_edit_pengguna') ?>",
                beforeSend : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses Data',
                        onOpen  : () => {
                            swal.showLoading()
                        }
                    })
                },
                data    : {id:id_pengguna},
                success : function (data) {
                    swal.close();
                    $('#form_data_pengguna').html(data).fadeIn('slow');
                    $('#tambah_pengguna').hide();
                    
                    // aksi
                    $('#form_ubah_pengguna').on('submit', function () {
                        var id_pengguna = $('.id_pengguna').val();
                        var level       = $('.level').val();
                        var username    = $('.username').val();
                        var password    = $('.password').val();

                        if ((level == ' ') || (username == '') || (password == '')) {

                            swal(
                                'Peringatan',
                                'Data harus terisi dahulu',
                                'warning'
                            )

                            return false;
                            
                        } else {

                            $.ajax({
                                type    : "post",
                                url     : "<?= base_url('Master/ubah_pengguna') ?>",
                                beforeSend : function () {
                                    swal({
                                        title   : "Menunggu",
                                        html    : "Memproses Data",
                                        onOpen  : () => {
                                            swal.showLoading();
                                        }
                                    })
                                },
                                data        : {id_pengguna:id_pengguna, level:level, username:username, password:password},
                                dataType    : "JSON",
                                success     : function (data) {
                                data_pengguna.ajax.reload(null, false);

                                    $('.awal-karyawan').next('.select2').hide();
                                    $('.nama-karyawan').next('.select2').show();
                                    $('#karyawan_1').html(data['karyawan']);
                                    
                                    var b = data['karyawan'];
                            
                                    if (b == 0) {
                                        $('#tambah_pengguna').hide();
                                    } else {
                                        $('#tambah_pengguna').show();
                                    }

                                    swal({
                                        type    : 'success',
                                        title   : 'Update Pengguna',
                                        text    : 'Anda berhasil mengubah pengguna'
                                    })

                                    $('#edit_pengguna').hide();

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

                                    $('#karyawan').select2("val",' ');
                                    $('#level').select2("val",' ');
                                    $('#username').val('');
                                    $('#password').val('');
                                }

                            })

                            return false;

                        }
                    }),

                    $('#form_ubah_pengguna').on('click', '#cancel', function () {
                        var id = $(this).attr('value');

                        $.ajax({
                            type        : "post",
                            url         : "<?= base_url('Master/ubah_pengguna/1') ?>",
                            beforeSend  : function () {
                                swal({
                                    title   : "Batal",
                                    html    : "Batal Memproses Data",
                                    onOpen  : () => {
                                        swal.showLoading();
                                    }
                                })
                            },
                            dataType    : "JSON",
                            success     : function (data) {
                                swal.close();

                                $('.awal-karyawan').next('.select2').hide();
                                $('.nama-karyawan').next('.select2').show();
                                $('#karyawan_1').html(data['karyawan']);
                        
                                if (id == 0) {
                                    $('#tambah_pengguna').hide();
                                } else {
                                    $('#tambah_pengguna').show();
                                }
                                
                                $('#edit_pengguna').hide();

                                $('#karyawan').select2("val", ' ');
                                $('#level').select2("val", ' ');
                                $('#username').val('');
                                $('#password').val('');
                                
                            }
                        })
                            
                    })

                }

            })

        })

        $('#tabel_pengguna').on('click', '.hapus-pengguna', function () {
        
            var id = $(this).data('id');

            swal({
                title   : 'Konfirmasi',
                text    : "Anda ingin menghapus",
                type    : 'warning',

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Tidak',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url     : "<?= base_url('Master/hapus_pengguna') ?>",
                        method  : "post",
                        beforeSend : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses data',
                                onOpen  : () => {
                                    swal.showLoading()
                                }
                            })
                        },
                        data     : {id:id},
                        dataType : "JSON",
                        success  : function (data) {
                            
                            data_pengguna.ajax.reload(null, false);

                            $('.awal-karyawan').next(".select2").hide();
                            $('.nama-karyawan').next(".select2").show();
                            $('#karyawan_1').html(data['data_karyawan']);
                            
                            var a = data['data_karyawan'];
                    
                            if (a == 0) {
                                $('#tambah_pengguna').hide();
                            } else {
                                $('#tambah_pengguna').show();
                            }

                            swal(
                                'Hapus',
                                'Berhasil Terhapus',
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



    })

</script>