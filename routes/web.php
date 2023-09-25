<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
Route::get('/stores', 'App\Http\Controllers\StoreController@index');
Route::get('/my_page', function () {
    return 'aaaaa';
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('stores', ['as' => 'stores.index', 'uses' => 'App\Http\Controllers\StoreController@index']);
    Route::get('stores/create', ['as' => 'stores.create', 'uses' => 'App\Http\Controllers\StoreController@create']);
    Route::post('stores', ['as' => 'stores.store', 'uses' => 'App\Http\Controllers\StoreController@store']);
    Route::get('stores/{store}/edit', ['as' => 'stores.edit', 'uses' => 'App\Http\Controllers\StoreController@edit']);
    Route::patch('stores/{store}', ['as' => 'stores.update', 'uses' => 'App\Http\Controllers\StoreController@update']);
    Route::delete('stores/{store}', ['as' => 'stores.delete', 'uses' => 'App\Http\Controllers\StoreController@delete']);

    Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
    Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
    Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
    Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
    Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
    Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
    Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


