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

    Route::get('medikamentai/{categorie}', 'MedicineController@index')->name('medikamentai');

    Route::resource('medikamentai', 'MedicineController');

    Route::get('gydymas/{treatment}', 'TreatmentController@getData')->name('treatment.get.data');
    Route::resource('gydymai', 'TreatmentController', [
        'names' => [
            'index' => 'gydymai'
        ]
    ]);

    Route::get('zetonas', 'TokenController@index')->middleware('role:admin')->name('token.index');
    Route::post('zetonas', 'TokenController@store')->middleware('role:admin')->name('token.store');

    Route::post('galerija', 'GalleryController@create')->middleware('role:admin')->name('gallery.create');
    Route::delete('galerija/{gallery}', 'GalleryController@delete')->middleware('role:admin')->name('gallery.delete');
});

Route::group(['middleware' => 'role:user'], function() {
    Route::post('spausdinti/{route}/{category?}', 'PdfController@create')->name('pdf.create');

    Route::post('ruja/trinti/{heat}', 'HeatController@delete')->middleware('role:user')->name('heat.delete');
    Route::get('/ruja/autocomplete', 'HeatController@autocomplete')->name('heat.autocomplete');
    Route::get('ruja/{heat}', 'HeatController@getData')->name('heat.get.data');
    Route::post('ruja/ieskoti', 'HeatController@index')->name('heat.search');
    Route::resource('ruja', 'HeatController', [
        'names' => [
            'index' => 'ruja'
        ]
    ]);
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('auth.login');
Route::get('prisijungti', 'HomeController@index')->name('auth.login');
//Route::get('registruotis', 'HomeController@index')->name('auth.register');

Route::get('zetonas/{token}', 'TokenController@create')->name('token.create');

Route::get('galerija', 'GalleryController@index')->name('galerija');
