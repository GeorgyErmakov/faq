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
Route::get('/ask', 'QuestionController@askQuestion')->name("askquestion");
Route::post('/ask', 'QuestionController@fillQuestion');

Route::get('/dashboard/{filter?}', ['as' => 'admin', 'uses' => 'QuestionController@showAllAdmin']);

Route::any('/question', 'QuestionController@questionChangeRender');
Route::post('/chquestion', 'QuestionController@questionChange')->name("chquestion");
Route::post('/delquestion', 'QuestionController@questionDelete')->name("delquestion");

Route::get('/subjects', ['as' => 'subjects', 'uses' => 'SubjController@subjectList']);
Route::post('/addsubjects', 'SubjController@subjectAdd')->name("subjadd");
Route::post('/delsubjects', 'SubjController@subjectDelete')->name("delsubj");

Route::any('/chsubject', 'SubjController@subjectChangeRender');
Route::post('/chsubjectset', 'SubjController@subjectChange')->name("chsubject");

Route::any('/users', 'UsersController@usersList')->name("users");
Route::post('/addusers', 'UsersController@addAdminUser')->name("addusers");
Route::post('/delusers', 'UsersController@delAdminUser')->name("delusers");

Route::any('/chadmin', 'UsersController@chAdminRender');
Route::post('/chadminset', 'UsersController@chAdminUser')->name("chadmin");

Route::get('/auth/login', 'FAQAuthController@login')->name("auth");
Route::post('/auth/login', 'FAQAuthController@authenticate')->name("authpost");
Route::any('/logout', 'FAQAuthController@logout')->name("logout");
