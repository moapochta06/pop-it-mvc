<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\Department;
use Model\Employee;
use Model\Subject;
use Src\Validator\Validator;

class Employees
{
    public function index(): string
    {
        $employees = Employee::with('department')->get();

        return new View('site.hello', [
            'employees' => $employees
        ]);
    }
    public function showForm(): string
    {
        $departments = Department::all();

        return new View('site.employee_form', [
            'departments' => $departments
        ]);
    }
    public function add_employee(Request $request): string
{
    if ($request->method === 'POST') {
        $validator = new Validator($request->all(), [
            'last_name' => ['required'],
            'first_name' => ['required'],
            'gender' => ['required'],
            'birth_date' => ['required'],
            'department_id' => ['required'],
            'img' => ['image', 'max_file_size:600']
        ], [
            'required' => 'Поле :field обязательно',
            'image' => 'Файл должен быть изображением',
            'max_file_size' => 'Размер файла не должен превышать :max_file_size KB'
        ]);

        if ($validator->fails()) {
            return new View('site.employee_form', [
                'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)
            ]);
        }

        $data = $request->except(['img']);
        $employee = Employee::create($data);
        
        if (!empty($_FILES['img']['name'])) {
            $this->saveAvatar($employee, $_FILES['img']); 
        }
    }

    return new View('site.hello');
}
    private function saveAvatar($employee, $file): void
    {
        $uploadDir = __DIR__ . '/../../public/uploads/';

        // Генерируем уникальное имя
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('avatar_') . '.' . $extension;

        if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            $employee->update(['avatar' => '/uploads/' . $filename]);
        } else {
            $_SESSION['errors']['img'][] = 'Ошибка при сохранении файла';
            app()->route->redirect('/add-employee');
        }
    }
    public function search(Request $request): string
    {
        $validator = new Validator($request->all(), [
            'query' => ['required', 'max:4']
        ], [
            'required' => 'Поле :field не должно быть пустым',
            'max' => 'Поле :field должно содержать не более :max символов'
        ]);
         if($validator->fails()){
            return new View('site.hello',
                ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
        }
        $query = $request->get('query');
        $employees = Employee::search($query);

        return new View('site.hello', [
            'employees' => $employees,
            'search_query' => $query
        ]);
    }
    public function get_employee(string $id): string
    {
        $id = (int)$id;
    
        if (!$id) {
            app()->route->redirect('/hello');
        }
        $employee = Employee::find($id);
    
        if (!$employee) {
            app()->route->redirect('/hello');
        }
    
        return new View('site.employee', [
            'employee' => $employee
        ]);
    }

    public function showAttachSubjectsForm(string $id): string
    {
        $id = (int)$id;
        if (!$id) app()->route->redirect('/hello');

        $employee = Employee::with('department')->find($id);
        if (!$employee) app()->route->redirect('/hello');

        $subjects = Subject::all();

        return new View('site.attach_subjects_form', [
            'employee' => $employee,
            'subjects' => $subjects
        ]);
    }
    
    public function saveSubjects(Request $request)
    {
        if ($request->method === 'POST') {
            $data = $request->all();

            $employeeId = $data['employee_id'] ?? null;
            $subjectIds = $data['subjects'] ?? [];

            if (!$employeeId) app()->route->redirect('/hello');

            // Получаем сотрудника
            $employee = Employee::find($employeeId);

            if (!$employee) app()->route->redirect('/hello');

            foreach ($subjectIds as $subjectId) {
                if (!$employee->subjects->contains($subjectId)) {
                    $employee->subjects()->attach($subjectId);
                }
            }
           
            app()->route->redirect("/employee/{$employeeId}");
        }
    }
}
