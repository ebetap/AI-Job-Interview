<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//NOTE : route di arahkan ke controller

//index
$route['default_controller'] = 'user/view';

//---------------ADMIN---------------
$route['admin'] = 'admin/login';
$route['admin/home'] = 'admin/home';

$route['admin/interview/result'] = 'admin/result';

//manage user
$route['admin/manage/user/create'] = 'manageuser/create';
$route['admin/manage/user/read'] = 'manageuser/read';
$route['admin/manage/user/update'] = 'manageuser/update';
$route['admin/manage/user/delete'] = 'manageuser/delete';
//manage Soal
$route['admin/manage/soal/create'] = 'managesoal/create';
$route['admin/manage/soal/read'] = 'managesoal/read';
$route['admin/manage/soal/update'] = 'managesoal/update';
$route['admin/manage/soal/delete'] = 'managesoal/delete';

//---------------USER---------------
$route['about'] = 'user/view/about';
$route['(:any)'] = 'user/$1';

//---------------CI---------------
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
