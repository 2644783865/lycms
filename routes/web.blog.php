<?php

Route::group([], function () {

    Route::get('/blog/index', 'BlogController@index')->name('blog.index');
    Route::get('/blog/about', 'BlogController@about')->name('blog.about');
    Route::get('/blog/archive', 'BlogController@archive')->name('blog.archive');
    Route::get('/blog/category/{id}', 'BlogController@category')->name('blog.category');
    Route::get('/blog/tag/{id}', 'BlogController@tag')->name('blog.tag');
    Route::get('/blog/{id}', 'BlogController@show')->name('blog.show');

});