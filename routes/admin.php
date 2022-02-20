<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware'=>'auth'], function () {
	Route::get('dashboard', 'HomeController@dashboard')->name('admin.dashboard');

	// Route::resource('ideas', IdeaController::class);
	Route::resource('rules', RuelsController::class);
});