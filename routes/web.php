<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// slice books ini ya buat ngarahin get httpnya itu

//mindahin ke api.php

// view books jika tidak muncul, hrs bkin view baru di resources