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

Route::get('/', 'SubmissionController@index');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');
    Route::get('/', 'Admin\OrganizationController@index');
    Route::get('register', 'Auth\Admin\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'Auth\Admin\RegisterController@register')->name('admin.register');

    Route::get('organization/search', 'Admin\OrganizationController@search')->name('admin.organization.search');
    Route::resource('organization', 'Admin\OrganizationController', [
        'as' => 'admin'
    ]);
    Route::get('submission/search', 'Admin\SubmissionController@search')->name('admin.submission.search');
    Route::get('submission/{submission}/download', 'Admin\SubmissionController@download')->name('admin.submission.download');
    Route::resource('submission', 'Admin\SubmissionController', [
        'as' => 'admin'
    ]);
}) ;


Route::resource('organization', 'OrganizationController');
Route::get('submission/search', 'SubmissionController@search')->name('submission.search');
Route::get('submission/{submission}/download', 'SubmissionController@download')->name('submission.download');
Route::resource('submission', 'SubmissionController');

Auth::routes();