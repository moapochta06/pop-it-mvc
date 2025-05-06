<?php
namespace Controller;
use Src\View;
use Src\Request;
use Model\Department;

class Departments{
    public function get_departments(): string
    {
        // Получаем все кафедры из БД
        $departments = Department::all();

        // Передаём данные в шаблон
        return new View('site.departments', ['departments' => $departments]);
    }

    public function add_departments(Request $request)
    {
        // Получаем данные из запроса
        $data = $request->all();
    
        // валидация
        $errors = [];
    
        if (empty($data['name'])) {
            $errors[] = 'Поле "Название" обязательно для заполнения';
        }
    
        if (empty($data['abbreviation'])) {
            $errors[] = 'Поле "Аббревиатура" обязательно для заполнения';
        } elseif (strlen($data['abbreviation']) > 10) {
            $errors[] = 'Аббревиатура не должна превышать 10 символов';
        }
    
        // Если есть ошибки — передать обратно
        if (!empty($errors)) {
            return new View('site.departments', ['errors' => $errors]);
        }
    
        // Сохраняем кафедру
        if ($request->method === 'POST' && Department::create($data)) {
            app()->route->redirect('/departments');
        } else {
            return new View('site.department_form', ['message' => 'Ошибка при создании кафедры']);
        }
    }
}