<?php

use Illuminate\Http\Request;

Route::post('agencies', 'AgenciesController@store' )
    ->name('agencies.store');
Route::get('agencies','AgenciesController@index')
    ->name('agencies.show.all');
Route::put('agency/{agency}','AgenciesController@update')
    ->name('agency.update');
Route::get('agency/{agency}','AgenciesController@show')
    ->name('agency.show.one');
Route::delete('agency/{agency}','AgenciesController@destroy')
    ->name('agency.destroy');
