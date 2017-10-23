<?php

Route::get('/', 'FrontendController@index')->name('home');

Route::get(
    LaravelLocalization::transRoute('routes.about'),
    'PagesController@about'
)->name('about');

Route::match(['GET', 'POST'],
    LaravelLocalization::transRoute('routes.contact'),
    'PagesController@contact'
)->name('contact');

Route::get(
    LaravelLocalization::transRoute('routes.contact-sent'),
    'PagesController@contactSent'
)->name('contact-sent');

Route::get(
    LaravelLocalization::transRoute('routes.legal-mentions'),
    'PagesController@legalMentions'
)->name('legal-mentions');

if (config('blog.enabled')) {
    Route::get('blog', 'BlogController@index')->name('blog.index');
    Route::get('blog/{post}', 'BlogController@show')->name('blog.show');
    Route::get('blog/tags/{tag}', 'BlogController@tag')->name('blog.tag');

    Route::get(
        LaravelLocalization::transRoute('routes.redactors'),
        'BlogController@owner'
    )->name('blog.owner');
}
