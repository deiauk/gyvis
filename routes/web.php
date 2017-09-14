<?php

Route::group(['middleware' => 'auth'], function () {
    Route::get('meniu', function () {
        return view('startwindow');
    })->name('meniu');

    Route::post('gyvunas/trinti/{animal}', 'AnimalController@delete')->middleware('role:admin')->name('animal.delete');
    Route::get('gyvunas/{animal}', 'AnimalController@getData')->name('animal.get.data');

    Route::resource('sarasas', 'AnimalController', [
        'names' => [
            'index' => 'sarasas'
        ]
    ]);

    Route::post('vaistai/trinti/{medicine}', 'MedicineController@delete')->middleware('role:admin')->name('medicine.delete');
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

    Route::get('zetonas', 'TokenController@index')->middleware('role:admin')->name('token.index');
    Route::post('zetonas', 'TokenController@store')->middleware('role:admin')->name('token.store');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('auth.login');
Route::get('prisijungti', 'HomeController@index')->name('auth.login');
//Route::get('registruotis', 'HomeController@index')->name('auth.register');

Route::get('zetonas/{token}', 'TokenController@create')->name('token.create');
