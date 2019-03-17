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


Route::get('/',function(){
    return view('front.articles.index');
});

Auth::routes();
//
//Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
//    Route::get('articles/', function(){
//        return view('admin.articles.index');
//    })->where('vue_capture', '[\/\w\.-]*');
//});
//
//Route::get('/','ArticleController@index');

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/{any?}', function () {
        return view('admin.articles.index');
    })->where('any', '^(?!api\/)[\/\w\.-]*');
//});


//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/',  function () {
//    return view('front.articles.index');
//});
//
//Route::get('/vue/{vue_capture?}', function () {
//    return view('vue.index');
//})->where('vue_capture', '[\/\w\.-]*');