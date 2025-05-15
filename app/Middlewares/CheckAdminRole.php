<?php

namespace Middlewares;

use Src\Request;
use Src\Middleware;

class CheckAdminRole
{
    public function handle(Request $request, ?string $param = null): void
    {
        $user = app()->auth::user();

        if (!$user || $user->roles != 1) {
            app()->route->redirect('/login');
            exit;
        }
    }
}