<?php
error_reporting(E_ALL);

// http://www.webtatic.com/blog/2009/07/php-public-key-cryptography/

/*
if (function_exists('openssl_get_privatekey'))
{
	echo 'function exists.';
}

if (extension_loaded('openssl'))
{
	echo 'extension loaded';
}
*/

$dir = 'd:/home/rudisoft/www/localhost/public_html/certs/';
$data = "A secret message for Bob"; // the data to encrypt 
$cert = 'sandbox.crt';
$key = 'sandbox.key';

print "<pre>";
print "Input Data:\t$data\n";

// Get the public key
$publicKey = openssl_pkey_get_public(file_get_contents($dir.$cert));

$c = openssl_x509_parse(file_get_contents($dir.$cert));
$cd = $c['subject']['CN'];
echo '<pre>';
var_dump($c);
exit();

// encrypt the data
openssl_seal($data, $sealed, $ekeys, array($publicKey));

openssl_free_key($publicKey);

$sealed = base64_encode($sealed);

$Xevk = base64_encode($ekeys[0]);

print "Encypted data:\t$sealed\n";
print "Xevk:\t\t$Xevk\n";

// Now do the round trip for example - decrypt using the private key
$privateKey = openssl_get_privatekey(file_get_contents($dir.$key));

openssl_open(base64_decode($sealed), $opened, base64_decode($Xevk), $privateKey) or die(openssl_error_string());
openssl_free_key($privateKey);

print "Decypted data:\t$opened\n";
?>