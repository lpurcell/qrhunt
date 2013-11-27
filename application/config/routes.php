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
|^(?!admin|auth|backend|shop)(:any)
*/
//user agent table
$route['mobile/totals']='user_agent/index_mobile';
$route['browser/totals']='user_agent/index_browser';

//scans table
$route['scan/scanned_most']='scan/view_most_scanned';
$route['scan/delete_cookies'] = 'scan/delete_cookies';
$route['scanned_by/(:any)']='scan/view_reverse/$1';
$route['scan_delete_all/(:any)']='scan/delete_all/$1';
$route['scan_delete/(:any)/(:any)']='scan/delete/$1/$2';
$route['scan/totals']='scan/view_count';
$route['admin/scan/totals']='scan/view_count';
$route['scan_edit/(:any)/(:any)']= 'scan/edit/$1/$2';
$route['scan_view/(:any)']= 'scan/view/$1';
$route['scan/create']= 'scan/create';
$route['scan/(:any)'] = 'scan/insert/$1';

//participant table
$route['participant_delete/(:any)'] = 'register/delete/$1';
$route['participant_edit/(:any)']= 'register/edit/$1';
//view one participant with qrcode
$route['participant/(:any)'] = 'register/view/$1';
//view all participants in the table
$route['participants_all'] = 'register/index';
//Add participants
$route['register/create'] = 'register/create';
$route['register/multCreate'] = 'multRegister/create/multCreate';

//organization table
$route['organization_delete/(:any)']='admin/organization/delete/$1';
$route['organization_all']= 'admin/organization/index';
//code needs to be fixed
$route['organization/(:any)']= 'admin/organization/view/$1';
$route['organization_edit/(:any)']= 'admin/organization/edit/$1';
$route['organization/create']= 'admin/organization/create';

//event table
$route['event_delete/(:any)'] = 'admin/event/delete/$1';
$route['event_edit/(:any)']= 'admin/event/edit/$1';
$route['event/(:any)'] = 'admin/event/view/$1';
$route['events_all'] = 'admin/event/index';
$route['event/create']= 'admin/event/create';

//Labels
$route['labels'] = 'Labels/index/labels';

//other routes
$route['css/get/(:any)'] = 'css/get/$1';
$route['news/create'] = 'news/create';

$route['default_controller'] = 'pages/view';


/* End of file routes.php */
/* Location: ./application/config/routes.php */