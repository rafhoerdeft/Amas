<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Diskominfo Kab. Magelang">
	<title>Login AMAS</title>
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/logo/logo_kab_sm.png">

	<!-- BEGIN VENDOR CSS-->
	<link rel="stylesheet" type="text/css" href="<?= assets_url ?>app-assets/css/vendors.css">
	<link rel="stylesheet" type="text/css" href="<?= assets_url ?>app-assets/vendors/css/extensions/toastr.css">
	<!-- END VENDOR CSS-->
	<!-- BEGIN MODERN CSS-->
	<link rel="stylesheet" type="text/css" href="<?= assets_url ?>app-assets/css/app.css">
	<!-- END MODERN CSS-->
	<!-- BEGIN Page Level CSS-->
	<link rel="stylesheet" type="text/css" href="<?= assets_url ?>app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
	<link rel="stylesheet" type="text/css" href="<?= assets_url ?>app-assets/css/core/colors/palette-gradient.css">
	<link rel="stylesheet" type="text/css" href="<?= assets_url ?>app-assets/css/plugins/extensions/toastr.css">
	<!-- END Page Level CSS-->
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>theme/login/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>theme/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>theme/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>theme/login/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>theme/login/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>theme/login/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>theme/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>theme/login/css/main.css">
	<!--===============================================================================================-->
</head>

<body>
	<style>
		.triangle-up {
			width: 0;
			height: 0;
			border-left: 55px solid transparent;
			border-right: 55px solid transparent;
			border-bottom: 50px solid #ffffff78;
		}

		.box-form {
			background-color: #ffffff78;
			padding: 50px;
			border-radius: 50px 50px 50px 50px;
			box-shadow: 10px 10px 7px #4019073b;
		}
	</style>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?= base_url() ?>theme/login/images/wh.jpg');">
			<!-- <div class="triangle-up"></div> -->
			<div class="row">
				<div class="col-md-6 d-flex justify-content-center align-items-center px-5">
					<!-- <div class="justify-content-center"> -->
						<img src="<?= base_url('assets/img/logo/logo_amas_full_2.png') ?>" style="width: 90%;" alt="LOGO">
					<!-- </div> -->
				</div>

				<div class="col-md-6">
					<div style="margin: auto; max-width: 400px; padding: 20px">
						<form class="login100-form validate-form" id="loginform">
							<!-- <div class="login100-form-avatar m-b-25">
								<img src="" alt="AVATAR">
							</div> -->

							<span class="login100-form-title p-b-25">
								Sign In
							</span>

							<div id="alert_login" class="alert alert-danger alert-dismissible" style="width: 100%; border-radius: 50px; text-align: center; display: none;">
								<!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
								<h4><i class="icon fa fa-ban"></i> Login Gagal!</h4>
								Username atau Password salah!
							</div>

							<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

							<div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
								<input class="input100" type="text" id="username" name="username" placeholder="Username">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-user"></i>
								</span>
							</div>

							<style>
								.show-pass {
									font-size: 18px;
									color: #999999;
									cursor: pointer;
									display: inline;
									position: absolute;
									margin-top: 16px;
									right: 15px;
								}

								#img_captcha img{
									/* border-radius: 100px; */
									border: 1px solid #a6445d !important;
									width: 100%;
									height: 50px;
								}
							</style>

							<div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
								<i class="fa fa-eye-slash show-pass" id="cek_pass"></i>
								<input class="input100" type="password" id="password" name="password" placeholder="Password">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-lock"></i>
								</span>
							</div>

							<div class="row">
								<div class="col-md-6 m-b-10" id="img_captcha"><?= $img_captcha; ?></div>
								<div class="validate-input m-b-10 col-md-6" data-validate="Captcha is required">
									<input class="input100 text-center" type="text" id="captcha" name="captcha" placeholder="Captcha" maxlength="4" style="padding: 10px; font-size: 16pt !important;">
									<span class="focus-input100"></span>
								</div>
							</div>

							<div class="container-login100-form-btn p-t-10">
								<button class="login100-form-btn" type="submit">
									Login
								</button>
							</div>

							<!-- <div class="text-center w-full p-t-25">
								<a href="#" class="txt1">
									Lupa password ?
								</a>
							</div> -->
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>



	<!-- BEGIN VENDOR JS-->
	<script src="<?= assets_url ?>app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
	<!-- BEGIN VENDOR JS-->
	<!-- BEGIN PAGE VENDOR JS-->
	<script src="<?= assets_url ?>app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
	<!-- END PAGE VENDOR JS-->
	<!-- BEGIN MODERN JS-->
	<script src="<?= assets_url ?>app-assets/js/core/app-menu.js" type="text/javascript"></script>
	<script src="<?= assets_url ?>app-assets/js/core/app.js" type="text/javascript"></script>
	<!-- <script src="<?= assets_url ?>app-assets/js/scripts/customizer.js" type="text/javascript"></script> -->
	<!-- END MODERN JS-->
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>theme/login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>theme/login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url() ?>theme/login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>theme/login/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>theme/login/js/main.js"></script>

	<script src="<?= base_url() ?>assets/js/auth_log.js"></script>

	<script>
		$('#cek_pass').on('click', function() {
			var x = document.getElementById("password");
			if (x.type === "password") {
				x.type = "text";
				$(this).removeClass('fa-eye-slash').addClass('fa-eye');
			} else {
				x.type = "password";
				$(this).removeClass('fa-eye').addClass('fa-eye-slash');
			}
		});
	</script>


</body>

</html>