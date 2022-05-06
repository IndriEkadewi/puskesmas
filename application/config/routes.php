<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';
$route['detail-poli/(:num)'] = 'home/detailPoli/$1';
$route['printpdf/(:num)'] = 'booking/exportToPdf/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
