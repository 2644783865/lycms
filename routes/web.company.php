<?php

Route::group([], function () {

    Route::get('/company/index', 'CompanyController@index')->name('company.index');
    Route::get('/company/news', 'CompanyController@news')->name('company.news');
    Route::get('/company/news/{id}', 'CompanyController@showNews')->name('company.news-show');
    Route::get('/company/cases', 'CompanyController@case')->name('company.case');
    Route::get('/company/cases/{id}', 'CompanyController@showCase')->name('company.case-show');
    Route::get('/company/contact', 'CompanyController@contact')->name('company.contact');
    Route::get('/company/about', 'CompanyController@about')->name('company.about');
    Route::get('/company/service', 'CompanyController@service')->name('company.service');
    Route::get('/company/process', 'CompanyController@process')->name('company.process');

});