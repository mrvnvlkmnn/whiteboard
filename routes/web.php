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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::resource('projects', 'ProjectController');

Auth::routes();


Route::post('/projectSearch', 'SearchController@index');

Route::post('/sortBy', 'SearchController@index');

Route::post('/softDelete', 'SearchController@softDelete');





