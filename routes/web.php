<?php

use Illuminate\Support\Facades\Route;
use App\Project;

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


Route::resource('projects', 'ProjectController');

Auth::routes();

Route::get('/sendMail', 'MailController@show');
Route::post('/sendMail', 'MailController@sendMail');

Route::post('/projectSearch', 'SearchController@index');

Route::post('/countProgrammierung', 'SearchController@countProgrammierung');

Route::post('/sortBy', 'SearchController@index');


Route::redirect('/', route("projects.index"));



