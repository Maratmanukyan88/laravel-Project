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

/*
|--------------------------------------------------------------------------
| Auth / password
|--------------------------------------------------------------------------
*/

Route::get('/', 'WelcomeController@index');
Route::get('auth', 'Auth\AuthController@getAuth');
Route::get('home', 'HomeController@index');

// login page
Route::get('auth/login', 'Auth\AuthController@getLogin', ['middleware' => 'auth']);
Route::post('auth/login', 'Auth\AuthController@postLogin', ['middleware' => 'auth']);

// register page
Route::get('auth/register', 'Auth\RegisterController@getRegister');
Route::post('auth/register', 'Auth\RegisterController@postRegister');

// register page
Route::get('auth/confirm/{username}/{token}', 'Auth\RegisterController@getConfirm');

// forgot password
Route::get('auth/forgot', 'Auth\AuthController@getForgot');
Route::post('auth/forgot', 'Auth\AuthController@postForgot');

// password change
Route::get('auth/password/{username}/{token}', 'Auth\AuthController@getPassword');

// logout page
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// drip program
Route::get('confirm', 'DripProgramController@getDripStruct');
Route::post('confirm', 'DripProgramController@postDripStruct');


//
// admin panel
//

Route::get('admin/user', 'User\AdminController@getUser');
Route::get('admin/user/listing', 'User\AdminController@getListing');

Route::get('admin/user/edit/{id}', 'User\AdminController@getEdit');
Route::post('admin/user/edit/{id}', 'User\AdminController@postEdit');

Route::get('admin/user/password/{id}', 'User\AdminController@getPassword');
Route::get('admin/users/delete/{id}', 'User\AdminController@getDelete');

/*
|--------------------------------------------------------------------------
| Websites
|--------------------------------------------------------------------------
*/

// display websites listing
Route::get('website', 'Website\WebsiteController@getIndex');
Route::get('website/listing', 'Website\WebsiteController@getListing');

// website create
Route::get('website/create', 'Website\WebsiteController@getCreate');
Route::post('website/create', 'Website\WebsiteController@postCreate');

// website delete
Route::get('website/delete', 'Website\WebsiteController@getDelete');

// website change plan
Route::post('website/changePlan', 'Website\WebsiteController@postPlanChange');

//
// admin panel
//

// display websites listing
Route::get('admin/website', 'Website\AdminController@getIndex');
Route::get('admin/website/listing', 'Website\AdminController@getListing');

// delete website
Route::get('admin/website/delete', 'Website\AdminController@getDelete');

// change plan
Route::post('admin/website/changePlan', 'Website\AdminController@ajaxPlanChange');

/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
*/

//
// auth
// 

Route::get('oauth/authorize', 'Oauth\OauthController@getAuthorize');
Route::post('oauth/authorize', ['as' => 'oauth.authorize.post', 'uses' => 'Oauth\OauthController@postAuthorize']);
Route::get('oauth/generateToken', 'Oauth\OauthController@getGenerateToken');
Route::post('oauth/generateToken', 'Oauth\OauthController@postGenerateToken');
Route::get('oauth/token/display', 'Oauth\OauthController@getToken');

// 
// API endpoints
// 

Route::post('api/prospect/create', 'Prospect\ApiController@postCreate');

/**
 *
 * Drip Program controller
 * 
 */
Route::get('drip', 'DripProgramController@getDrip');
Route::get('logic', 'DripProgramController@getLogic');



/**
 *
 * Profile controller
 * 
 */

Route::get('search', 'PhraseController@getPhrases');
Route::post('new-phrase', 'PhraseController@newPhrase');
Route::get('phrases-delete/{id}', 'PhraseController@deletePhrase');
Route::get('phrase-update/{id}', 'PhraseController@getUpdatePhrase');
Route::post('phrase-update/{id}', 'PhraseController@postUpdatePhrase');
