<?php
require_once 'setting.php';
session_destroy();
//Include google login configuration
include_once 'google_login.php';
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title>MyMPP | MBSA</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE CSS ================== -->
	<link href="assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>


<style>
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	body {
		background: linear-gradient(135deg, #007aff 0%, #007aff 100%);
		min-height: 100vh;
		font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 20px;
	}

	.main-container {
		background: #ffffff;
		border-radius: 24px;
		max-width: 900px;
		width: 100%;
		min-height: 500px;
		display: flex;
		overflow: hidden;
		box-shadow: 0 20px 60px rgba(91, 95, 237, 0.3);
	}

	.left-section {
		flex: 1;
		padding: 60px 50px;
		display: flex;
		flex-direction: column;
		justify-content: center;
	}

	.right-section {
		flex: 1;
		background: linear-gradient(135deg, #F8F9FF 0%, #E8EAFF 100%);
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		padding: 40px;
		position: relative;
	}

	.logo-title {
		font-size: 32px;
		font-weight: 700;
		color: #2D3748;
		margin-bottom: 40px;
	}

	.form-group {
		margin-bottom: 24px;
	}

	.form-label {
		display: block;
		margin-bottom: 8px;
		color: #6B7280;
		font-size: 14px;
		font-weight: 500;
	}

	.form-control {
		width: 100%;
		height: 48px;
		padding: 12px 16px;
		border: 2px solid #E5E7EB;
		border-radius: 12px;
		font-size: 16px;
		background: #F9FAFB;
		transition: all 0.3s ease;
		outline: none;
	}

	.form-control:focus {
		border-color: #004394;
		background: #ffffff;
		box-shadow: 0 0 0 3px rgba(0, 67, 148, 0.1);
	}

	.password-container {
		position: relative;
	}

	.password-toggle {
		position: absolute;
		right: 16px;
		top: 50%;
		transform: translateY(-50%);
		background: none;
		border: none;
		color: #9CA3AF;
		cursor: pointer;
		font-size: 18px;
	}

	.forgot-password {
		text-align: right;
		margin-top: 8px;
	}

	.forgot-password a {
		color: #004394;
		text-decoration: none;
		font-size: 14px;
	}

	.forgot-password a:hover {
		text-decoration: underline;
	}

	.remember-me {
		display: flex;
		align-items: center;
		margin: 20px 0;
	}

	.remember-me input[type="checkbox"] {
		margin-right: 8px;
		transform: scale(1.1);
	}

	.remember-me label {
		color: #6B7280;
		font-size: 14px;
		cursor: pointer;
	}

	.btn-login {
		width: 100%;
		height: 48px;
		background: #004394;
		color: white;
		border: none;
		border-radius: 12px;
		font-size: 16px;
		font-weight: 600;
		cursor: pointer;
		transition: all 0.3s ease;
		margin-bottom: 24px;
	}

	.btn-login:hover {
		background: #003366;
		transform: translateY(-1px);
		box-shadow: 0 8px 25px rgba(0, 67, 148, 0.3);
	}

	.signup-link {
		text-align: center;
		color: #6B7280;
		font-size: 14px;
	}

	.signup-link a {
		color: #004394;
		text-decoration: none;
		font-weight: 600;
	}

	.signup-link a:hover {
		text-decoration: underline;
	}

	.illustration {
		width: 100%;
		height: 300px;
		margin-bottom: 30px;
		position: relative;
		border-radius: 20px;
		overflow: hidden;
	}

	.illustration img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.illustration-overlay {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: linear-gradient(135deg, rgba(0, 67, 148, 0.7) 0%, rgba(91, 95, 237, 0.6) 100%);
	}

	.illustration-title {
		font-size: 24px;
		font-weight: 700;
		color: #2D3748;
		text-align: center;
		margin-bottom: 12px;
	}

	.illustration-text {
		font-size: 14px;
		color: #6B7280;
		text-align: center;
		line-height: 1.5;
		max-width: 280px;
	}

	.copyright {
		position: absolute;
		bottom: 20px;
		left: 50%;
		transform: translateX(-50%);
		color: #6B7280;
		font-size: 11px;
		text-align: center;
		white-space: nowrap;
	}

	@media (max-width: 768px) {
		.main-container {
			flex-direction: column;
			margin: 10px;
			border-radius: 16px;
		}

		.left-section {
			padding: 40px 30px;
		}

		.right-section {
			display: none;
		}

		.copyright {
			position: static;
			transform: none;
			margin-top: 30px;
			text-align: center;
			color: rgba(255, 255, 255, 0.8);
		}
	}
</style>
<!-- New Login Page Design - Start -->

<body>
	<div class="main-container">
		<div class="left-section">
			<h1 class="logo-title">MyMPP | MBSA</h1>
			<form action="action.check" method="POST" id="loginForm">
				<div class="form-group">
					<label class="form-label">No.Kad Pengenalan</label>
					<input type="text" class="form-control" id="nokadpengenalan" name="user" placeholder="No.Kad Pengenalan" required>
				</div>

				<div class="form-group">
					<label class="form-label">Kata Laluan</label>
					<input type="password" class="form-control" id="katalaluan" name="pass" placeholder="Password" required>
					<button type="button" class="password-toggle" onclick="togglePassword()">
						<i class="fa fa-eye" id="toggleIcon"></i>
					</button>
				</div>
				<button type="submit" class="btn-login">Log Masuk</button>
				<!-- <div class="signup-link">
					Tidak mempunyai akaun? <a href="#">Daftar Akaun Baharu</a>
				</div> -->
			</form>
		</div>

		<div class="right-section">
			<div class="illustration">
				<img src="assets/images/bg-image/temp_bg.jpg" alt="temp">
				<div class="illustration-overlay"></div>
			</div>

			<h2 class="illustration-title">Selamat Datang Ke Sistem MyMPP</h2>
			<p class="illustration-text">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sollicitudin quam at orci porttitor interdum.
			</p>

			<div class="copyright">
				© Hak Milik Jabatan Digital & Teknologi Maklumat MBSA
			</div>
		</div>
	</div>

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/js/login-v2.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
	<script>
		function togglePassword() {
			const passwordField = document.getElementById('katalaluan');
			const toggleIcon = document.getElementById('toggleIcon');

			if (passwordField.type === 'password') {
				passwordField.type = 'text';
				toggleIcon.className = 'fa fa-eye-slash';
			} else {
				passwordField.type = 'password';
				toggleIcon.className = 'fa fa-eye';
			}
		}

		$(document).ready(function() {
			$('#loginForm').on('submit', function(e) {
				e.preventDefault();

				var nokadpengenalan = $('#nokadpengenalan').val();
				var katalaluan = $('#katalaluan').val();

				if (nokadpengenalan && katalaluan) {
					$('.btn-login').text('Sedang memproses...');
					$('.btn-login').prop('disabled', true);

					setTimeout(function() {
						alert('Demo: Log masuk berjaya!\nNo. Kad: ' + nokadpengenalan);
						$('.btn-login').text('Log Masuk');
						$('.btn-login').prop('disabled', false);
						$('#loginForm')[0].reset();
					}, 2000);
				} else {
					alert('Sila isi semua medan yang diperlukan.');
				}
			});
		});
	</script>
</body>
<!-- New Login Page Design - End -->
</html>