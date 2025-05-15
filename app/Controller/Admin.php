<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\User;


class Admin
{   
    public function add_dean_form(): string
    {
        return new View('site.admin_form');
    }

    public function add_dean_user(Request $request): string
{
    if ($request->method === 'POST') {
        $data = $request->all();

        // Сохраняем пользователя
        if (User::create($data)) {
            return new View('site.admin_form', [
                'message' => 'Пользователь успешно добавлен'
            ]);
        }

        // Если не удалось сохранить
        return new View('site.admin_form', [
            'error' => 'Ошибка при добавлении пользователя'
        ]);
    }

    // Если не POST-запрос
    return new View('site.admin_form');
}

}