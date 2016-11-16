<?php
function crypt_pass($password, $digito = 9) {
	$set_salt = '/1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	$salt = sprintf('$2x$%02d$', $digito);
	for($i = 0; $i<22; $i++)
	{
		$salt .= $set_salt[mt_rand(0, 62)];
	}
	return crypt($password, $salt);
}

function encriptar($cadena, $clave = "una clave secreta")
{
	$cifrado = MCRYPT_RIJNDAEL_256;
	$modo = MCRYPT_MODE_ECB;
	return mcrypt_encrypt($cifrado, $clave, $cadena, $modo,
	mcrypt_create_iv(mcrypt_get_iv_size($cifrado, $modo), MCRYPT_RAND));
} 
function desencriptar($cadena, $clave = "una clave secreta")
{
	$cifrado = MCRYPT_RIJNDAEL_256;
	$modo = MCRYPT_MODE_ECB;
	return mcrypt_decrypt($cifrado, $clave, $cadena, $modo,
	mcrypt_create_iv(mcrypt_get_iv_size($cifrado, $modo), MCRYPT_RAND));
}
function validarmail($mail)
{
	$patron_mail = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
	return preg_match($patron_mail, $mail, $coincidencias);
	print_r($coincidencias);
}
function validartelefono($telefono)
{
	$patron_tel = '^\d{8,12}$^';
	return preg_match($patron_tel, $telefono, $coincidencias);
}	
function test_input($data)
{
  $data = trim($data);
  $data = htmlspecialchars($data);
  $data = filter_var($data, FILTER_SANITIZE_STRING);
  return $data;
}
function test_input2($data)
{
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}
function test_input_mail($data)
{
  $data = trim($data);
  $data = htmlspecialchars($data);
  $data = filter_var($data, FILTER_SANITIZE_EMAIL);
  return $data;
}
?>