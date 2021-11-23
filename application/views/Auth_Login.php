<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Authorization - Mandiri APP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A premium admin dashboard template by themesbrand" name="description" />
        <meta content="Themesbrand" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url()?>assets/dist/img/logo@2x.png">

        <link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?= base_url() ?>assets/dist/img/atm.png" type="image/x-icon">
		
		<!-- Toggles CSS -->
		<link href="<?= base_url() ?>assets/vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
		<link href="<?= base_url() ?>assets/vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">

		 <!-- sweatalert -->
		 <link href="<?= base_url() ?>assets/swa/sweetalert2.css">
		
		<!-- Custom CSS -->
		<link href="<?= base_url() ?>assets/dist/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body class="bg-white">

        <!-- Log In page -->
        <div class="row">
            <div class="col-lg-4 pr-0">
            </div>
            <div class="col-lg-3 pr-0">
                <div class="card mb-0 shadow-none">
                    <div class="card-body">
                        <h3 class="text-center m-0">
                            <a href="<?= base_url();?>" class="logo logo-admin"><img src="<?php echo base_url()?>assets/dist/img/logo@2x.png" height="60" alt="logo" class="my-3"></a>
                        </h3>
    
                        <div class="px-3">
                            <h4 class="text-muted font-18 mb-2 text-center">Welcome Back !</h4>
                            <p class="text-muted text-center">Sign in to continue to App Mandiri.</p>
                            <?= $this->session->flashdata('pesan') ?>
                            <form class="form-horizontal my-4" id="form-login">
    
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">   
                                            <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                                    </div>                                    
                                </div>
    
                                <div class="form-group">
                                    <label for="userpassword">Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                                    </div>                                
                                </div>
    
                                <div class="form-group row mt-4">
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a href="#" class="text-muted font-13"><i class="mdi mdi-lock"></i> Forgot your password?</a>                                    
                                    </div>
                                </div>
    
                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-2">
                                        <button class="btn btn-info btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                    </div>
                                </div>                            
                            </form>
                            <?= br(7) ?>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="mb-0">© 2019 Bank Mandiri.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Log In page -->

        <!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="<?= base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="<?= base_url() ?>assets/vendors/popper.js/dist/umd/popper.min.js"></script>
		<script src="<?= base_url() ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

		<!-- sweatalert -->
		<script src="<?= base_url() ?>assets/swa/sweetalert2.all.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="<?= base_url() ?>assets/dist/js/jquery.slimscroll.js"></script>
	
		<!-- Fancy Dropdown JS -->
		<script src="<?= base_url() ?>assets/dist/js/dropdown-bootstrap-extended.js"></script>
		
		<!-- FeatherIcons JavaScript -->
		<script src="<?= base_url() ?>assets/dist/js/feather.min.js"></script>
		
		<!-- Init JavaScript -->
		<script src="<?= base_url() ?>assets/dist/js/init.js"></script>

        <script>
		
			$(document).ready(function () {
				
				$('#form-login').on('submit', function () {
					
					var username = $('#username').val();
					var password = $('#password').val();

					if ((username == "") || (password == "")) {
						swal(
							'Peringatan',
							'Data harus terisi dahulu',
							'warning'
						)

						return false;
					} else {

						$.ajax({
							type 		: "post",
							url 		: "<?= base_url('index.php/Auth/cek_login') ?>",
							beforeSend 	: function () {
								swal({
									title 	: 'Menunggu',
									html 	: 'Memproses data',
									onOpen : () => {
										swal.showLoading();
									}
								})
							},
							data 		: {username:username, password:password},
							dataType 	: "JSON",
							success 	: function (data) {
								 
								if (data['hasil'] == 'masuk') {

									swal({
										title 	: 'Berhasil Login',
										text	: 'Selamat Datang',
										type 	: 'success',
										timer	: 1000,

										showConfirmButton: false
									}).then(function () {
										var url = "<?= base_url('Admin/index') ?>";

										window.location.href = url;
									})
									
								} else if(data['hasil'] == 'salah password') {
									$('#password').val('');

									swal({
										title 	: 'Gagal',
										text 	: 'Password yang dimasukkan salah!!',
										type 	: 'error',
										timer 	: 1000,

										showConfirmButton 	: false
									})

									setTimeout(() => {
										$('#password').focus();
									}, 1300)

								} else {

									$('#username').val('');
									$('#password').val('');

									swal({
										title 	: 'Gagal',
										text 	: 'Username tidak ditemukan!!',
										type 	: 'error',
										timer 	: 1000,

										showConfirmButton 	: false
									})

									setTimeout(() => {
										$('#username').focus();
									}, 1300);
									
								}

							}
						})

						return false;
						
					}

				})


			})
		
		</script>
    </body>
</html>