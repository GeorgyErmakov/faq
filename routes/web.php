<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'FAQController@faqList')->name("user");
Route::post('/', 'FAQController@fillQuestion');


Route::get('/admin/{filter?}', ['as' => 'admin', 'uses' => 'FAQController@showAllAdmin']);
Route::any('newadmin', 'FAQController@addAdmin')->name("newadmin");
Route::get('deladmin', 'FAQController@chAdmin')->name("chadmin");
Route::any('newsubject', 'FAQController@newSubject')->name("newsubject");
Route::any('delsubject', 'FAQController@delSubject')->name("delsubject");
Route::any('changequestion', 'FAQController@chQ')->name("changequestion");

Route::get('/auth/login', 'FAQAuthController@login')->name("auth");
Route::post('/auth/login', 'FAQAuthController@authenticate')->name("authpost");
Route::any('/logout', 'FAQAuthController@logout')->name("logout");


