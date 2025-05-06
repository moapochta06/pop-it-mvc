<?php

use Src\Route;

Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add('GET', '/subjects', [Controller\Site::class, 'get_subject'])
    ->middleware('auth');
Route::add('GET', '/departments', [Controller\Departments::class, 'get_departments'])
    ->middleware('auth');
Route::add('GET', '/departments/create', [Controller\Departments::class, 'create'])
    ->middleware('auth');
Route::add('POST', '/departments', [Controller\Departments::class, 'add_departments'])
    ->middleware('auth');

