<?php

use Illuminate\Http\Request;

Route::post('agencies', 'AgenciesController@store')
    ->name('agencies.store');
Route::get('agencies', 'AgenciesController@index')
    ->name('agencies.index');
Route::put('agencies/{agency}', 'AgenciesController@update')
    ->name('agencies.update');
Route::get('agencies/{agency}', 'AgenciesController@show')
    ->name('agencies.show');
Route::delete('agencies/{agency}', 'AgenciesController@destroy')
    ->name('agencies.destroy');
