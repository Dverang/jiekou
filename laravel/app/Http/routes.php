<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//前台首页
Route::get('index', 'IndexController@index');
//公司
Route::get('company', 'CompanyController@index');
//个人中心
Route::get('personal', 'PersonalController@index');
//关于我们
Route::get('about', 'AboutController@index');
//登陆
Route::get('/', 'LoginController@index');

Route::get('home', 'HomeController@index');
Route::any('login','LoginController@login');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::any('register','LoginController@register');
//职位列表
Route::any('list','ListController@index');
Route::any('page','ListController@page');


