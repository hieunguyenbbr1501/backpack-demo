<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    CRUD::resource('post', 'PostCrudController');
    CRUD::resource('tag', 'TagCrudController');
    CRUD::resource('user', 'UserCrudController');
    Route::get('/post/{slug}/publish', 'PostCrudController@publish');
    Route::get('/post/{slug}/unpublish','PostCrudController@unpublish');
}); // this should be the absolute last line of this file