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
        if ($request->method === 'POST') {
            $data = $request->all();
    
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