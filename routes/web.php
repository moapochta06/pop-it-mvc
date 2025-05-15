<?php

use Src\Route;

Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);

Route::add('GET', '/hello', [Controller\Employees::class, 'index'])
    ->middleware('auth', 'denyAdmin');
Route::add('GET', '/employee-form', [Controller\Employees::class, 'showForm'])
    ->middleware('auth');
Route::add('POST', '/add-employee', [Controller\Employees::class, 'add_employee'])
    ->middleware('auth');
Route::add('GET', '/employee/{id}', [Controller\Employees::class, 'get_employee'])
    ->middleware('auth');
Route::add('GET', '/subjects', [Controller\Subjects::class, 'get_subject'])
    ->middleware('auth');
Route::add('GET', '/departments', [Controller\Departments::class, 'get_departments'])
    ->middleware('auth');
Route::add('POST', '/departments', [Controller\Departments::class, 'add_departments'])
    ->middleware('auth');


Route::add('GET', '/employee/{id}/attach-subjects', [Controller\Employees::class, 'showAttachSubjectsForm'])
->middleware('auth');
Route::add('POST', '/employee/attach-subjects', [Controller\Employees::class, 'saveSubjects'])
->middleware('auth');

Route::add('GET', '/admin-form', [Controller\Admin::class, 'add_dean_form'])
->middleware('admin');
Route::add('POST', '/add-user', [Controller\Admin::class, 'add_dean_user'])
->middleware('admin');

Route::add('GET', '/no-access', [Controller\Site::class, 'noAccess']);