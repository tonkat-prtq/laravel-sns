<?php

Auth::routes();
Route::get('/', 'ArticleController@index')->name('articles.index');
Route::resource('/articles', 'ArticleController')->except(['index'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']); // この書き方でshowではauthミドルウェアを使わないよう設定できる
Route::prefix('article')->name('articles.')->group(function() {
  Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
  Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');