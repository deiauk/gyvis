<?php

Route::group(['middleware' => 'auth'], function () {
    Route::get('meniu', function () {
        return view('startwindow');
    })->name('meniu');

    Route::post('trinti', 'AnimalController@deleteAnimal')->name('trinti');
    Route::get('gyvunasAxax/{id}', 'AnimalController@getAnimalRowData')->name('gyvunasAxax');

    Route::resource('sarasas', 'AnimalController', [
        'names' => [
            'index' => 'sarasas'
        ]
    ]);

    Route::post('trintiVaista', 'MedicineController@deleteMedical')->name('trintiVaista');
    Route::get('medicalAjax/{id}', 'MedicineController@getMedicineRowData')->name('medicalAjax');

    Route::resource('medikamentai', 'MedicineController', [
        'names' => [
            'index' => 'medikamentai'
        ]
    ]);

    Route::resource('gydymai', 'TreatmentController', [
        'names' => [
            'index' => 'gydymai'
        ]
    ]);

});

Auth::routes();

Route::get('/', 'HomeController@index')->name('prisijugti');
Route::get('prisijungti', 'HomeController@index')->name('prisijugti');
Route::get('registruotis', 'HomeController@index')->name('registruotis');
