<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Укажите имя таблицы, если оно отличается от конвенции Laravel
    protected $table = 'employees';

    // Отключаем таймстампы, если они не нужны
    public $timestamps = false;

    // Задайте заполняемые поля
    protected $fillable = [
        'last_name',
        'first_name',
        'patronymic',
        'gender',
        'birth_date',
        'address',
        'position_id',
        'department_id',
        'role_id',
    ];

    //связь с таблицей departments
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'employee_subject', 'employee_id', 'subject_id');
    }
    public static function find(int $id)
    {
        return self::with('department', 'subjects')->where('id', $id)->first();
    }
    // public function position()
    // {
    //     return $this->belongsTo(Position::class, 'position_id');
    // }

    // public function role()
    // {
    //     return $this->belongsTo(Role::class, 'role_id');
    // }
}