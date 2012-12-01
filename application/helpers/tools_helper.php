<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

function randString($length=10)
{
	$string = "";
	$chars = "abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ0123456789";
	$n = strlen($chars)-1;
	for ($i = 0; $i < $length; $i++)
		$string .= $chars[mt_rand(0, $n)];

	return $string;
}