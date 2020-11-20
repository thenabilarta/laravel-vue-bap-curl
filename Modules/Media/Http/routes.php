<?php

Route::group(['middleware' => 'web', 'prefix' => 'media', 'namespace' => 'Modules\Media\Http\Controllers'], function()
{
    Route::get('/', 'MediaController@index');
    Route::get('/data', 'MediaController@data');
    Route::get('/main', 'MediaController@main');
});
