<!DOCTYPE html>
<!-- 
Template Name: Mintos - Responsive Bootstrap 4 Admin Dashboard Template
Author: Hencework
Contact: https://hencework.ticksy.com/

License: You must have a valid license purchased only from templatemonster to legally use the template for your project.
-->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?= (!empty($judul)) ? $judul.' | ' : '' ?>Reminder ATM</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= base_url() ?>assets/dist/img/atm.png" type="image/x-icon">

    <!-- Toggles CSS -->
    <link href="<?= base_url() ?>assets/vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">

    <!-- Data Table CSS -->
    <!-- <link href="<?= base_url() ?>assets/vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" /> -->

    <!-- Data Table CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dataTables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dataTables/css/responsive.bootstrap4.min.css">

    <!-- sweatalert -->
    <link href="<?= base_url() ?>assets/swa/sweetalert2.css">

    <!-- select2 CSS -->
    <link href="<?= base_url() ?>assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Toastr CSS -->
    <link href="<?= base_url() ?>assets/vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="<?= base_url() ?>assets/dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->

    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
            <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand" href="<?= base_url('master/karyawan') ?>">
                <img class="brand-img d-inline-block ml-20" src="<?= base_url() ?>assets/dist/img/atm.png" width="50" alt="brand" /><?= nbs(3) ?>
                Mandiri App
            </a>
            <ul class="navbar-nav hk-navbar-content">
                
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar">
                                    <img src="<?= base_url() ?>assets/dist/img/pp3.png" alt="user" class="avatar-img rounded-circle">
                                </div>
                            </div>
                            <div class="media-body">
                                <span><?= strtoupper($this->session->userdata('username')) ?><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <a class="dropdown-item" href="<?= base_url('login/yuk_keluar') ?>"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                    </div>
                </li>
            </ul>
        </nav>
        <form role="search" class="navbar-search">
            <div class="position-relative">
                <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
                <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
            </div>
        </form>
        <!-- /Top Navbar -->

        <!-- Vertical Nav -->
        <nav class="hk-nav hk-nav-light">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item <?= (!empty($karyawan) || !empty($pengguna) || !empty($mesin_atm) || !empty($jenis_reminder)) ? 'active' : '' ?>" <?php if($this->session->userdata('level') != 4 && $this->session->userdata('level') != 5){echo "hidden";}else{echo " ";}?>>
                            <a class="nav-link" href="<?= base_url('master/jenis_reminder') ?>"><span class="feather-icon"><i data-feather="database"></i></span>
                                <span class="nav-link-text">Jenis Tasklist</span></a>
                        </li>
                        <li class="nav-item <?= (!empty($karyawan) || !empty($pengguna) || !empty($mesin_atm) || !empty($jenis_reminder)) ? 'active' : '' ?>" <?php if($this->session->userdata('level') != 4 && $this->session->userdata('level') != 5){echo "hidden";}else{echo " ";}?>>
                            <a class="nav-link" href="<?= base_url('data/task/'.$this->session->userdata('id_bagian')) ?>">
                            <span class="feather-icon"><i data-feather="inbox"></i></span>
                            <span class="nav-link-text">Reminder Tasklist</span>
                        </li>
                        
                        <li class="nav-item <?= (!empty($karyawan) || !empty($pengguna) || !empty($mesin_atm) || !empty($jenis_reminder)) ? 'active' : '' ?>" <?php if($this->session->userdata('level') == 4 ){echo "hidden";}elseif($this->session->userdata('level') == 5){echo "hidden";}else{ echo " ";}?>>
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#dash_drp">
                                <span class="feather-icon"><i data-feather="database"></i></span>
                                <span class="nav-link-text">Master Data</span>
                            </a>
                            <ul id="dash_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item <?= (!empty($karyawan)) ? $karyawan : '' ?>">
                                            <a class="nav-link" href="<?= base_url('master/karyawan') ?>">Karyawan</a>
                                        </li>
                                        <li class="nav-item <?= (!empty($pengguna)) ? $pengguna : '' ?>">
                                            <a class="nav-link" href="<?= base_url('master/pengguna') ?>">Pengguna</a>
                                        </li>
										<li class="nav-item <?= (!empty($jenis_reminder)) ? $jenis_reminder : '' ?>">
                                            <a class="nav-link" href="<?= base_url('master/jenis_reminder') ?>">Jenis Tasklist</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="nav-item <?= (!empty($kelolaan)) ? $kelolaan : '' ?>" <?= ($this->session->userdata('level') == 1) ? 'hidden' : ''?>>
                            <a class="nav-link" href="<?= base_url('data/kelolaan') ?>" >
                                <span class="feather-icon"><i data-feather="book"></i></span>
                                <span class="nav-link-text">Kelolaan</span>
                            </a>
                        </li> -->
                        <li class="nav-item <?= (!empty($pegawai) || !empty($sewa_tempat)) ? 'active' : '' ?>"<?php if($this->session->userdata('level') == 2){echo "";}else{echo "hidden";}?>>
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_drp">
                                <span class="feather-icon"><i data-feather="inbox"></i></span>
                                <span class="nav-link-text">Data Reminder</span>
                            </a>
                            <ul id="pages_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item <?= (!empty($pegawai)) ? $pegawai : '' ?>">
                                            <a class="nav-link" href="<?= base_url('data/task/1') ?>">Tasklist TBI</a>
                                        </li>
                                        <li class="nav-item <?= (!empty($pegawai)) ? $pegawai : '' ?>">
                                            <a class="nav-link" href="<?= base_url('data/task/2') ?>">Tasklist TBM</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item <?= (!empty($corssT)) ? $corssT : '' ?>"<?php if($this->session->userdata('level') == 3 && $this->session->userdata('id_bagian') == 1){echo "";}else{echo "hidden";}?>>
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#cross">
                                <span class="feather-icon"><i data-feather="inbox"></i></span>
                                <span class="nav-link-text">Data Reminder Tasklist TBI</span>
                            </a>
                            <ul id="cross" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item <?= (!empty($corssT)) ? $corssT : '' ?>">
                                            <a class="nav-link" href="<?= base_url('data/crossTaskTBI') ?>">CrossTaks TBI</a>
                                        </li>
                                        <li class="nav-item <?= (!empty($pegawai)) ? $pegawai : '' ?>">
                                            <a class="nav-link" href="<?= base_url('data/inlineTask/1') ?>">Inline TBI</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?= (!empty($listCross)) ? 'active' : '' ?>"<?php if($this->session->userdata('level') == 3 && $this->session->userdata('id_bagian') == 1){echo"";}else{echo "hidden"; } ?>>
                            <a class="nav-link" href="<?= base_url('data/listCrossTaskTBM') ?>" >
                                <span class="feather-icon"><i data-feather="message-square"></i></span>
                                <span class="nav-link-text">Data Cross Task TBM</span>
                            </a>
                        </li>

                        <li class="nav-item <?= (!empty($corssT)) ? $corssT : '' ?>" <?php if($this->session->userdata('level') == 3 && $this->session->userdata('id_bagian') == 2){echo "";}else{echo "hidden";}?>>
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#dash_drp_tbm">
                                <span class="feather-icon"><i data-feather="database"></i></span>
                                <span class="nav-link-text">Data Reminder Tasklist TBM</span>
                            </a>
                            <ul id="dash_drp_tbm" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item <?= (!empty($corssT)) ? $corssT : '' ?>">
                                            <a class="nav-link" href="<?= base_url('data/crossTaskTBM') ?>">CrossTaks TBM</a>
                                        </li>
                                        <li class="nav-item <?= (!empty($pegawai)) ? $pegawai : '' ?>">
                                            <a class="nav-link" href="<?= base_url('data/inlineTask/2') ?>">Inline TBM</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item <?= (!empty($listCross)) ? 'active' : '' ?>"<?php if($this->session->userdata('level') == 3 && $this->session->userdata('id_bagian') == 2){echo"";}else{echo "hidden"; } ?>>
                            <a class="nav-link" href="<?= base_url('data/listCrossTaskTBI') ?>" >
                                <span class="feather-icon"><i data-feather="message-square"></i></span>
                                <span class="nav-link-text">Data Cross Task TBI</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
           
            <?= $konten ?>

            <!-- Footer -->
            <div class="hk-footer-wrap container">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>© 2019 <a href="https://skdigital.id/" class="text-dark" target="_blank">Solusi Karya Digital</a></p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <p class="d-inline-block">Follow us</p>
                            <a href="https://www.instagram.com/solusikaryadigital/" target="_blank" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-instagram"></i></span></a>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- /Footer -->

        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url() ?>assets/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Data Table JavaScript -->
    <!-- <script src="<?= base_url() ?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/dataTables-data.js"></script> -->

    <!-- data tables -->
    <script src="<?= base_url() ?>assets/dataTables/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/dataTables/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/dataTables/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>assets/dataTables/js/responsive.bootstrap4.min.js"></script>

    <!-- date picker -->
    <script src="<?= base_url() ?>assets/Cross-browser-Date-Time-Selector/date-time-picker.min.js"></script>

    <!-- separator divider -->
    <script src="<?= base_url() ?>assets/divider/number-divider.min.js"></script>

    <!-- sweatalert -->
    <script src="<?= base_url() ?>assets/swa/sweetalert2.all.min.js"></script>

    <!-- Select2 JavaScript -->
    <script src="<?= base_url() ?>assets/vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/select2-data.js"></script>

    <!-- Toastr JS -->
    <script src="<?= base_url() ?>assets/vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

    <!-- Bootstrap Input spinner JavaScript -->
    <script src="<?= base_url() ?>assets/vendors/bootstrap-input-spinner/src/bootstrap-input-spinner.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/inputspinner-data.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="<?= base_url() ?>assets/dist/js/jquery.slimscroll.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="<?= base_url() ?>assets/dist/js/feather.min.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="<?= base_url() ?>assets/dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- Toggles JavaScript -->
    <script src="<?= base_url() ?>assets/vendors/jquery-toggles/toggles.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/toggle-data.js"></script>

    <!-- Init JavaScript -->
    <script src="<?= base_url() ?>assets/dist/js/init.js"></script>

    <script>
        $('#tanggal').dateTimePicker({

            // used to limit the date range
            limitMax: null, 
            limitMin: null, 

            // year name
            yearName: '',

            // month names
            monthName: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

            // day names
            dayName: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],

            // "date" or "dateTime"
            mode: 'date', 

            // custom date format
            format: null 

        });

        $('.separator').divide({
            delimiter: '.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        $('.separator').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

    </script>

</body>

</html>