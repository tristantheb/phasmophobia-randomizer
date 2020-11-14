<?php
require_once "vendor/autoload.php";
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if (file_exists('lang/'.$lang.'/lang.mo')) {
	load_textdomain('lang', 'lang/'.$lang.'/lang.mo');
} else {
	$lang = "en";
}
$version = "0.3.1";
