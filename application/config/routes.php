<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "main";

$route['(^admin.*$)'] = "$1";
$route['(^personal.*$)'] = "$1";

$route['page/(:num)'] = "main/index/all/all/$1";
$route['tag/(:any)/page/(:num)'] = "main/index/all/$1/$2";
$route['tag/(:any)'] = "main/index/all/$1";
$route['(:any)/page/(:num)'] = "main/index/$1/all/$2";
$route['(:any)/(:any)'] = "main/post/$1/$2";
$route['(:any)'] = "main/index/$1";

$route['404_override'] = '';