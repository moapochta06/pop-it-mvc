<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\Department;
use Model\Employee;
use Model\Subject;

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
    public function add_employee(Request $request)
    {
        if ($request->method === 'POST') {
            Employee::create($request->all());

            app()->route->redirect('/hello');
        }
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

            if (!empty($subjectIds)) {
                $employee->subjects()->attach($subjectIds);
            }

            app()->route->redirect("/employee/{$employeeId}");
        }
    }
}
