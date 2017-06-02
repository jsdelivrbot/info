<?php
$dbcnx = @mysql_connect('localhost', 'root', 'root');
if (!$dbcnx ) {
	echo( '<p> Komunikacija s strežnikom SUPB ni uspela . </p>');
	exit() ;
}
if(!@mysql_select_db('INFO', $dbcnx)){
die('<p>Zahtevana podatkovna baza ne obstaja.</p>');
}
function password_encrypt($password) {
	$hash_format = "$2y$10$";   // php uporabi blowfish, cena = 10
	$salt_length = 22;          // min dolzina salt-a
	$salt = generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash = crypt($password, $format_and_salt);
	return $hash;
}
function generate_salt($length) {
	//sha1 salt
	$unique_random_string = sha1(uniqid(mt_rand(), true));
	// Valid characters for a salt are [a-zA-Z0-9./]
	$base64_string = base64_encode($unique_random_string);
	// But not '+' which is valid in base64 encoding
	$modified_base64_string = str_replace('+', '.', $base64_string);
	// Truncate string to the correct length
	$salt = substr($modified_base64_string, 0, $length);
	return $salt;
}
function password_check($password, $existing_hash) {
	// existing hash contains format and salt at start
	$hash = crypt($password, $existing_hash);
	if ($hash === $existing_hash) {
		return true;
	}else{
		return false;
	}
}
?>