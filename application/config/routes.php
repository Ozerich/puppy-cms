<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
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

$route['default_controller'] = "main_controller";
$route['404_override'] = '';

$route['UPDATE_FINISH_TIME'] = 'main_controller/update_finish_time';

$route['admin/auth'] = 'auth_controller/admin';
$route['admin/logout'] = 'auth_controller/logout';
$route['admin'] = 'admin/dashboard_controller';

$route['admin/users/(:num)'] = 'admin/users_controller/edit/$1';
$route['admin/users/(:any)'] = 'admin/users_controller/$1';
$route['admin/users'] = 'admin/users_controller';

$route['admin/cities'] = 'admin/city_controller';
$route['admin/cities/(:num)'] = 'admin/city_controller/view/$1';
$route['admin/cities/(:any)'] = 'admin/city_controller/$1';

$route['admin/animals'] = 'admin/animal_controller';
$route['admin/animals/(:num)'] = 'admin/animal_controller/view/$1';
$route['admin/animals/(:any)'] = 'admin/animal_controller/$1';

$route['admin/kinds'] = 'admin/kind_controller';
$route['admin/kinds/(:num)'] = 'admin/kind_controller/view/$1';
$route['admin/kinds/(:any)'] = 'admin/kind_controller/$1';

$route['admin/articles'] = 'admin/article_controller';
$route['admin/articles/(:any)'] = 'admin/article_controller/$1';

$route['admin/config'] = 'admin/config_controller';
$route['admin/config/medal/(:num)'] = 'admin/config_controller/view_medal/$1';
$route['admin/config/(:any)'] = 'admin/config_controller/$1';

$route['login'] = 'auth_controller/user';
$route['logout'] = 'auth_controller/logout';
$route['register'] = 'auth_controller/register';
$route['auth/remind'] = 'auth_controller/remind';

$route['profile'] = 'profile_controller';
$route['profile/(:any)'] = 'profile_controller/$1';
$route['create'] = 'profile_controller/new_item';
$route['edit/(:num)'] = 'profile_controller/edit_item/$1';
$route['view/(:num)'] = 'main_controller/view_item/$1';
$route['admin_item/(:num)'] = 'main_controller/admin_item/$1';
$route['list'] = 'main_controller/item_list';
$route['filter'] = 'main_controller/filter';

$route['statji/(:any)/(:any)'] = 'article_controller/index/$1/$2';
$route['statji/(:any)'] = 'article_controller/index/$1';
$route['statji'] = 'article_controller';

$route['user/(:num)'] = 'user_controller/index/$1';
$route['user/(:any)'] = 'user_controller/$1';

$route['sms_billing'] = 'main_controller/sms_billing';

$route['api'] = 'api_controller/index';
$route['api/(:any)'] = 'api_controller/$1';

$route['(:any)'] = 'main_controller/show_list/$1';
$route['(:any)/(:any)'] = 'main_controller/show_list/$1/$2';







/* End of file routes.php */
/* Location: ./application/config/routes.php */