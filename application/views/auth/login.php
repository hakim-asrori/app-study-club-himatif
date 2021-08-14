<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $title ?> | Study Club TI Polindra</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="/assets/login/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="/assets/login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/login/css/util.css"> 
	<link rel="stylesheet" type="text/css" href="/assets/login/css/main.css">
	<style>
		.login100-form-title {
			padding: 50px 15px;
		}
	</style>
	
	<script src="/assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="/assets/login/vendor/bootstrap/js/popper.js"></script> 
	<script src="/assets/login/vendor/bootstrap/js/bootstrap.min.js"></script> 
	<script src="/assets/plugins/sweetalert2/dist/sweetalert2.all.js"></script>
</head>
<body>
	<?= $this->session->flashdata('message'); ?>
	<div id="pesan"></div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title">
					<span class="login100-form-title-1">
						Selamat Datang
					</span>
				</div>
				<form action="/auth" onsubmit="return false;" id="form" method="post">
					<?= createToken() ?>
					<div class="login100-form validate-form">
						<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
							<span class="label-input100">Email</span>
							<input class="input100" type="text" name="email" id="email" placeholder="Enter email">
							<span class="focus-input100"></span>
						</div>

						<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
							<span class="label-input100">Password</span>
							<input class="input100" type="password" name="password" id="password" placeholder="Enter password">
							<span class="focus-input100"></span>
						</div>

						<div class="validate-input m-b-18" style="display: flex; align-items: center">
							<input type="checkbox" id="look" onclick="lookPass()" class="m-r-10" style="cursor: pointer;">
							<label for="look" style="cursor: pointer;">Lihat password</label>
						</div>

						<div class="container-login100-form-btn">
							<button class="login100-form-btn" id="login"> 
								Sign In
							</button>
						</div>
						<a href="/auth/register" class="small mt-3">Silahkan sign up bagi yang belum punya akun!</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function () {
			$("#login").click(function () {
				let email = $("#email").val().trim();
				let password = $("#password").val().trim();
				if (email == "" && password == "") {
					$("#pesan").html(Swal.fire('Ooops!', 'Email dan password tidak boleh kosong!', 'error'));
				} else if (email == "") {
					$("#pesan").html(Swal.fire('Ooops!', 'Email tidak boleh kosong!', 'error'));
				} else if (password == "") {
					$("#pesan").html(Swal.fire('Ooops!', 'Password tidak boleh kosong!', 'error'));
				} else {
					document.getElementById('form').onsubmit = false;
				}
			})

		});

		function lookPass() {
			let pass = document.getElementById('password');
			if (pass.type === "password") {
				pass.type = "text";
			} else {
				pass.type = "password";
			}
		}
	</script>
</body>
</html>