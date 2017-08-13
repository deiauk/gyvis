<?php

Route::get('/', function () {
    return view('startwindow');
});

Route::post('trinti', 'AnimalController@deleteAnimal')->name('trinti');
Route::get('gyvunasAxax/{id}', 'AnimalController@getAnimalRowData')->name('gyvunasAxax');

Route::resource('sarasas', 'AnimalController', [
    'names' => [
        'index'=>'sarasas'
    ]
]);