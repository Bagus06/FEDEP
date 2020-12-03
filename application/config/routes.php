<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   	= 'web/list';
$route['dashboard']   			= 'dashboard/list';
$route['user']   			 	= 'user/list';
$route['login']                	= 'user/login';
$route['logout']               	= 'user/logout';
$route['berita_cat']   			= 'berita_cat/list';
$route['berita']   				= 'berita/list';
$route['question']   			= 'question/list';
$route['responses']   			= 'responses/list';
$route['galery']   			= 'galery/list_folder';

$route['web']   			= 'web/list';

$route['404_override']         	= '';
$route['translate_uri_dashes'] 	= FALSE;
