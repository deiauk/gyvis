<?php

Route::group(['middleware' => 'auth'], function () {
    Route::get('meniu', function () {
        return view('startwindow');
    })->name('meniu');

    Route::post('gyvunas/trinti', 'AnimalController@delete')->name('animal.delete');
    Route::get('gyvunas/{id}', 'AnimalController@getData')->name('animal.get.data');

    Route::resource('sarasas', 'AnimalController', [
        'names' => [
            'index' => 'sarasas'
        ]
    ]);

    Route::post('vaistai/trinti/{medicine}', 'MedicineController@delete')->name('medicine.delete');
    Route::get('vaistai/{medicine}', 'MedicineController@getData')->name('medicine.get.data');

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

Route::get('/', 'HomeController@index')->name('auth.login');
Route::get('prisijungti', 'HomeController@index')->name('auth.login');
Route::get('registruotis', 'HomeController@index')->name('auth.register');
