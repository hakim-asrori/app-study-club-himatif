<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $heading; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="/assets/login/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="/assets/login/css/util.css"> 
	<link rel="stylesheet" type="text/css" href="/assets/login/css/main.css">
	<style>
		.login100-form {
			justify-content: center;
			padding: 43px 0;
		}
	</style>
</head>
<body>
	<div id="pesan"></div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title">
					<span class="login100-form-title-1">
						<?php echo $heading; ?>
					</span>
				</div>
				<div class="login100-form validate-form">
					<button onclick="history.back(-1)" class="login100-form-btn">Kembali</button>
				</div>
			</div>
		</div>
	</div>

</body>
</html>