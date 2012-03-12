<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "index";
$route['404_override'] = '';


$route['admin/auth'] = 'auth_controller/admin';
$route['admin/logout'] = 'auth_controller/logout';
$route['admin'] = 'admin/dashboard_controller';

$route['admin/users/(:any)'] = 'admin/users_controller/$1';
$route['admin/users'] = 'admin/users_controller';

$route['admin/cities'] = 'admin/city_controller';
$route['admin/cities/(:num)'] = 'admin/city_controller/view/$1';
$route['admin/cities/(:any)'] = 'admin/city_controller/$1';

$route['admin/animals'] = 'admin/animal_controller';
$route['admin/animals/(:any)'] = 'admin/animal_controller/$1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */