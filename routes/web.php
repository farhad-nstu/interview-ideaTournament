<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Clears Cache facade value:
Route::get('/cc', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Cashe</h1>';
});

//admin route
require('admin.php');

Route::group(['namespace' => 'Front'], function () {
	Route::get('all-users', 'HomeController@fetch_users')->name('front.users');
	Route::get('all-ideas', 'HomeController@fetch_ideas')->name('front.ideas');
	Route::get('first-phase', 'HomeController@count_idea')->name('front.count_idea');
	Route::get('second-phase', 'HomeController@check_second_five_minute')->name('front.second_phase');
	Route::get('final-phase', 'HomeController@check_final_five_minute')->name('front.final_phase');
});

// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
