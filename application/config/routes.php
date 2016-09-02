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

$route['default_controller'] = 'frontend/home';
$route['index'] = 'frontend/home';
$route['admin'] = 'admin/auth/login';
$route['admin/adminLogout'] = 'admin/auth/logout';
$route['404_override'] = 'custom_404';
$route['translate_uri_dashes'] = FALSE;
$route['signup'] = "frontend/home/signUp";
$route['clientSignUp'] = "frontend/home/clientSignUp";

$route['staff'] = "frontend/staff/index";
$route['client'] = "frontend/client/index";
$route['client'] = "frontend/client/client";
$route['updateNotification'] = "frontend/client/updateNotification";
$route['signin'] = "frontend/login/index";
$route['logout'] = "frontend/logout/index";
$route['accountActivation'] = "frontend/home/accountActivation";
$route['stafflist/(:any)'] = "frontend/home/search/$1";
$route['staffs/(:any)'] = 'frontend/home/staffs/$1';
$route['staffs/(:any)'] = 'frontend/home/staffs/$1';
$route['resetPassword'] = 'frontend/reset/resetPassword';
$route['privacypolicy'] = 'frontend/pagecontent/privcayandpolicy';
$route['termcondition'] = 'frontend/pagecontent/termandconditions';

$route['mybooking'] = 'frontend/client/mybooking';
$route['myjobs'] = 'frontend/staff/myJobs';
$route['googleLogin'] = 'frontend/login/googleLogin';
$route['registration/(:any)'] = 'frontend/staff/registration/$1';
$route['clientregistration'] = 'frontend/client/clientregistration';
$route['staffsetting'] = 'frontend/staff/profileEdit';

