<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity' => \Model\User::class,
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'admin' => \Middlewares\CheckAdminRole::class,
        'denyAdmin' => \Middlewares\DenyAdminAccess::class,
    ],
    'routeAppMiddleware' => [
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,

    ],
    'validators' => [
        'required' => \validators\Validators\RequireValidator::class,
        'unique' => \validators\Validators\UniqueValidator::class,
        'image' => \validators\Validators\ImageValidator::class,
        'max_file_size' => \validators\Validators\MaxSizeValidator::class,
        'max' => \validators\Validators\MaxValidator::class,
    ],

];
