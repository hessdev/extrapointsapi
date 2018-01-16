<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'api_controller';
$route['login'] = "api_controller/login";
$route['logout'] = "api_controller/logout";
$route['forgot'] = "api_controller/forgot_password";
$route['info'] = "api_controller/info";
$route['info/(:num)'] = "api_controller/info/$1";
$route['lineup/(:num)/(:any)/(:num)'] = "api_controller/lineup/$1/$2/$3";
$route['player/(:num)'] = "api_controller/player/$1";
$route['player/(:num)/(:num)'] = "api_controller/player/$1/$2";
$route['teams'] = "api_controller/teams";
$route['teams/(:num)'] = "api_controller/teams/$1";
$route['teams/(:num)/(:any)'] = "api_controller/teams/$1/$2";
$route['scores'] = "api_controller/scores";
$route['scores/(:num)/(:any)'] = "api_controller/scores/$1/$2";
$route['players/(:num)/(:any)'] = "api_controller/players/$1/$2";
$route['nfl-schedule/(:num)'] = "api_controller/nfl_schedule/$1";
$route['draft/(:num)'] = "api_controller/draft/$1";
$route['draft/(:num)/(:any)'] = "api_controller/draft/$1/$2";
$route['career'] = "api_controller/career";
$route['career/(:num)/(:num)'] = "api_controller/career/$1/$2";
$route['transactions/(:num)'] = "api_controller/transactions/$1";
$route['transactions/(:num)/(:any)'] = "api_controller/transactions/$1/$2";
$route['talk/(:num)'] = "api_controller/talk/$1";
$route['talk/(:num)/(:any)'] = "api_controller/talk/$1/$2";
$route['404_override'] = 'api_controller/page_not_found';
$route['translate_uri_dashes'] = FALSE;
