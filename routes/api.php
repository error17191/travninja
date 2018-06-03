<?php

use Illuminate\Http\Request;

Route::post('agencies', 'AgenciesController@store' )
    ->name('agencies.store');
Route::get('agencies','AgenciesController@index')
    ->name('agencies.show');
Route::put('agency/{agency}','AgenciesController@update')
    ->name('agency.update');
