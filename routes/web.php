<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('articles/', function () {
        return view('admin.articles.index');
    })->where('vue_capture', '[\/\w\.-]*');
});
Route::get('/','ArticleController@index');
Route::resource('articles', 'ArticleController');
Route::POST('articles/{id}/comments', 'ArticleController@comment');
