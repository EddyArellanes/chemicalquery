<?php
/**
 * @package	Extras
 * @author	Balam Guzman
 * @since	Version 1.0.0 08/02/2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Password {

	public function crypt_pass($password, $digito = 9) {
		$set_salt = '/1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$salt = sprintf('$2x$%02d$', $digito);
		for($i = 0; $i<22; $i++)
		{
			$salt .= $set_salt[mt_rand(0, 62)];
		}
		return crypt($password, $salt);
	}

	public function is_valid_password($contrasena_in, $contrasena_us_db) {
		if( crypt($contrasena_in, $contrasena_us_db) == $contrasena_us_db){
			//si pasa
			return true;
		} else {
			//no pasa
			return false;
		}
	}

}
