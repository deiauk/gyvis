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

Route::post('trintiVaista', 'MedicineController@deleteMedical')->name('trintiVaista');
Route::get('medicalAjax/{id}', 'MedicineController@getMedicineRowData')->name('medicalAjax');

Route::resource('medikamentai', 'MedicineController', [
    'names' => [
        'index'=>'medikamentai'
    ]
]);

Route::resource('gydymai', 'TreatmentController', [
    'names' => [
        'index'=>'gydymai'
    ]
]);