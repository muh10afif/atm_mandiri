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
		<title>Mandiri APP</title>
		<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
		
		<!-- Favicon -->
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
	<body>
		<!-- Preloader -->
		<div class="preloader-it">
			<div class="loader-pendulums"></div>
		</div>
		<!-- /Preloader -->
		
		<!-- HK Wrapper -->
		<div class="hk-wrapper">
			
			<!-- Main Content -->
			<div class="hk-pg-wrapper hk-auth-wrapper">
				<header class="d-flex justify-content-end align-items-center">
					<div class="btn-group btn-group-sm">
						
					</div>
				</header>
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12 pa-0">
							<div class="auth-form-wrap pt-xl-0 pt-70">
								<div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">
                                    <a class="auth-brand text-center d-block mb-20" href="#">
										<img class="brand-img" src="<?= base_url() ?>assets/dist/img/atm.png" width="250" alt="brand"/>
                                    </a>
									<form id="form-login">
                                        <h1 class="display-4 text-center mb-50">Mandiri APP</h1>
                                        <?= $this->session->flashdata('pesan') ?>
										<div class="form-group">
											<input class="form-control" placeholder="Username" type="text" id="username">
										</div>
										<div class="form-group">
											<div class="input-group">
												<input class="form-control" placeholder="Password" type="password" id="password">
											</div>
										</div>
                                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                                        <?= br(7) ?>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /HK Wrapper -->
		
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
							url 		: "<?= base_url('login/cek_login') ?>",
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
										var url = "<?= base_url('master/jenis_reminder') ?>";

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