<?php

namespace Middlewares;

use Src\Request;

class DenyAdminAccess
{
    public function handle(Request $request): void
    {
        $user = app()->auth::user();

        if ($user && $user->roles == 1) {
            app()->route->redirect('/no-access');
            exit;
        }
    }
}