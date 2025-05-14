<?php
namespace Controller;
use Src\View;
use Src\Request;
use Model\Department;
use Model\Subject;

class Departments{
     
    public function get_departments(): string
    {
        // Получаем все кафедры
        $departments = Department::all();

        // Получаем все предметы
        $subjects = Subject::all();

        // Передаём всё в один шаблон
        return new View('site.departments', [
            'departments' => $departments,
            'subjects' => $subjects
        ]);
    }

    public function add_departments(Request $request)
    {
        
        // Если это POST-запрос — обрабатываем форму
        if ($request->method === 'POST') {
            $data = $request->all();
    
            // Валидация
            $errors = [];
    
            if (empty($data['name'])) {
                $errors[] = 'Поле "Название" обязательно для заполнения';
            }
    
            if (empty($data['abbreviation'])) {
                $errors[] = 'Поле "Аббревиатура" обязательно для заполнения';
            } elseif (strlen($data['abbreviation']) > 10) {
                $errors[] = 'Аббревиатура не должна превышать 10 символов';
            }
    
            if (!empty($errors)) {
                // Передаем ошибки и полученные данные обратно в форму
                return new View('site.departments', [
                    'errors' => $errors,
                    'old' => $data,
                ]);
            }
    
            // Сохраняем кафедру
            Department::create([
                'name' => $data['name'],
                'abbreviation' => $data['abbreviation']
            ]);
    
            // Редирект после успешного сохранения
            app()->route->redirect('/hello');
        }
    
    }
}