<?php
date_default_timezone_set('Asia/Jakarta');

// Memebuat token CSRF
function createToken()
{
	$token = base64_encode(openssl_random_pseudo_bytes(32));
	$html = '<input type="hidden" name="csrf_name" value="'.$token.'">';
	$_SESSION['csrfvalue'] = $token;
	return $html;
}

// Menghapus token CSRF
function unsetToken()
{
	unset($_SESSION['csrfvalue']);
}

// Validasi token CSRF
function validationToken()
{
	if (isset($_SESSION['csrfvalue'])) {
		$csrfvalue = $_SESSION['csrfvalue'];
		if (isset($_POST['csrf_name'])) {
			$value_input = $_POST['csrf_name'];
			if ($value_input == $csrfvalue) {
				unsetToken();
				return true;
			} else {
				unsetToken();
				return false;
			}
		} else {
			unsetToken();
			return false;
		}
	}
}

// anti injek inputan
function anti_inject($text)
{
	$string = stripslashes(strip_tags(htmlentities(htmlspecialchars($text, ENT_QUOTES))));

	return $string;
}