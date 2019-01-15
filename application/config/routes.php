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
$route['default_controller'] = 'Dashboard';
$route['404_override'] = 'Dashboard/_404';
$route['translate_uri_dashes'] = FALSE;

/*********** Auth Routes **********/
$route['login'] = 'Auth/index';
$route['check-login'] = 'Auth/login';
$route['logout'] = 'Auth/logout';

/*********** Dashboard Routes **********/
$route['dashboard'] = 'Dashboard';
$route['profile'] = 'Dashboard/profile';
$route['update-profile'] = 'Dashboard/update_profile';
$route['update-profile-data'] = 'Dashboard/update_profile_data';
$route['change-password'] = 'Dashboard/change_password';
$route['change-password-data'] = 'Dashboard/change_password_data';
$route['category-analytics'] = 'Dashboard/category_analytics';
$route['common-delete-module'] = 'Dashboard/common_delete_module';
$route['final-amount'] = 'Dashboard/final_amount';
$route['toDoList'] = 'Dashboard/toDoList';

/*********** Txn Routes **********/
$route['income'] = 'Txn';
$route['income/(:any)'] = 'Txn/index/$1';
$route['add-income'] = 'Txn/add_income';
$route['update-income/(:any)'] = 'Txn/update_income/$1';
$route['update-income'] = 'Txn/update_income';

$route['expenses-category'] = 'Txn/expenses_category';
$route['add-expenses-category'] = 'Txn/add_expenses_category';
$route['update-expenses-category/(:any)'] = 'Txn/update_expenses_category/$1';
$route['update-expenses-category'] = 'Txn/update_expenses_category';

$route['expenditure'] = 'Txn/expenditure';
$route['expenditure/(:any)'] = 'Txn/expenditure/$1';
$route['expenditure/(:any)/(:any)'] = 'Txn/expenditure/$1/$2';
$route['add-expenditure'] = 'Txn/add_expenditure';
$route['update-expenditure/(:any)'] = 'Txn/update_expenditure/$1';
$route['update-expenditure'] = 'Txn/update_expenditure';

/***********  Funds Routes **********/
$route['fund'] = 'Fund';
$route['add-fund'] = 'Fund/add_fund';
$route['add-fund-data'] = 'Fund/add_fund_data';
$route['edit-fund/(:any)'] = 'Fund/edit_fund/$1';
$route['edit-fund-data'] = 'Fund/edit_fund_data';

$route['debitors'] = 'Fund/debitors';
$route['add-debitors'] = 'Fund/add_debitors';
$route['add-debitors-data'] = 'Fund/add_debitors_data';
$route['edit-debitors/(:any)'] = 'Fund/edit_debitors/$1';
$route['edit-debitors-data'] = 'Fund/edit_debitors_data';

$route['creditors'] = 'Fund/creditors';
$route['add-creditors'] = 'Fund/add_creditors';
$route['add-creditors-data'] = 'Fund/add_creditors_data';
$route['edit-creditors/(:any)'] = 'Fund/edit_creditors/$1';
$route['edit-creditors-data'] = 'Fund/edit_creditors_data';

$route['investment'] = 'Fund/investment';
$route['add-investment'] = 'Fund/add_investment';
$route['add-investment-data'] = 'Fund/add_investment_data';
$route['edit-investment/(:any)'] = 'Fund/edit_investment/$1';
$route['edit-investment-data'] = 'Fund/edit_investment_data';

/***********  Settings Routes **********/
$route['site-content'] = 'Settings';
$route['update-site-content'] = 'Settings/update_site_content';
$route['share'] = 'Settings/share';
$route['feedback'] = 'Settings/feedback';
$route['add-feedback'] = 'Settings/add_feedback';

/***********  Reports Routes **********/
$route['reports'] = 'Reports';
$route['monthly-report-details'] = 'Reports/monthly_report_details';
$route['generatePDF'] = 'Reports/generatePDF';
$route['generateExcel'] = 'Reports/generateExcel';

/***********  Cronjob Routes **********/
$route['truncate_demo_user_data/(:any)'] = 'CronJob/truncate_demo_user_data/$1';