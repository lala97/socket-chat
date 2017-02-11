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
session_start();
//<==================Page Routes ==================>
Route::get('/','PagesController@index');
Route::get('/index','PagesController@index');
Route::get('/Qeydiyyat','PagesController@register');
Route::get('/Haqqımızda','PagesController@about');
Route::get('/Əlaqə','PagesController@contact');
Route::post('/Əlaqə','PagesController@contact_send');
Route::get('/istek-list','PagesController@istek_list');
Route::get('/destek-list','PagesController@destek_list');
Route::get('/single/{id}','PagesController@single');
  Route::group(['middleware' => 'auth'],function(){
    Route::get('/Profil','PagesController@profil');
    Route::get('/Tənzimləmələr','PagesController@profil');
    Route::post('/Tənzimləmələr','PagesController@settings');
    Route::get('/Destekler','PagesController@profil');
    Route::get('/Istekler','PagesController@profil');
    });
//<=================Page Routes End ================>



//<==================Istek Routes ==================>
Route::get('/istek-add','IstekController@show');
Route::post('/istek-add','IstekController@istek_add');
Route::post('/add_file_change','IstekController@only_pic');
// ajax istek and destek
Route::group(['middleware' => 'auth'],function(){
  Route::get('/istek-edit/{id}','IstekController@istek_edit');
  Route::get('/istek-delete/{id}','IstekController@istek_delete');
  Route::patch('/istek-edit/{id}','IstekController@istek_update');
  Route::post('/deleteAjax','IstekController@deleteAjax');
  });
//<=================Istek Routes End ================>



//<==================Destek Routes ==================>
Route::get('/destek-add','DestekController@show');
Route::post('/destek-add','DestekController@destek_add');
Route::group(['middleware' => 'auth'],function(){
  Route::get('/destek-edit/{id}','DestekController@destek_edit');
  Route::patch('/destek-edit/{id}','DestekController@destek_update');
});
//<=================Destek Routes End ================>


//<==================Nofification Routes ==================>
Route::group(['middleware' => 'auth'],function(){
Route::post('/notification/{id}','PagesController@notification_count');
Route::get('/Bildirişlər','PagesController@profil');
Route::get('/message/{id}','PagesController@message');
Route::get('/Mesajlar/{id}','PagesController@chat');
Route::get('/Bildiriş/{id}','PagesController@notication_single');
Route::get('/accept','PagesController@accept');
Route::get('/refusal/{id}','PagesController@refusal');
Route::get('/accept/{id}','PagesController@accept');
});
//<=================Nofification Routes End ================>


//<=================Auth and User Routes ===========>
Route::auth();
Route::get('/home', 'PagesController@index');
Route::post('user-login','PagesController@user_login');
Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
//<=================Auth and User Routes End ===========>

//<=================Admin Routes ===========>
Route::get('/alfagen/login', 'AdminController@login');
Route::post('/alfagen/postLogin', 'AdminController@postLogin');

if (isset($_SESSION['admin'])) {
  Route::group(['middleware' => 'admin'],function(){
    Route::get('/alfagen','AdminController@index');
    Route::get('/alfagen/logout', 'AdminController@logout');
    Route::get('/İstək-list','AdminController@istek_list');
    Route::get('/Dəstək-list','AdminController@destek_list');
    Route::get('/activate/{id}','AdminController@activate');
    Route::get('/deactivate/{id}','AdminController@deactivate');
  });
}
//<=================Admin Routes ===========>
