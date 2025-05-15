<?php
namespace Controller;
use Src\View;
use Model\User;
use Src\Request;
use Src\Auth\Auth;
class Site
{   
public function hello(): string
{
return new View('site.hello', ['message' => 'hello
working']);
}

public function get_subject (): string
{
return new View('site.subjects');
}


   public function login(Request $request): string
   {
      //Если просто обращение к странице, то отобразить форму
      if ($request->method === 'GET') {
          return new View('site.login');
      }
      //Если удалось аутентифицировать пользователя, то редирект
      if (Auth::attempt($request->all())){
        $user = app()->auth::user();
        if ($user->roles == 1) {
            app()->route->redirect('/admin-form');
        } else {
            app()->route->redirect('/hello');
        }
    }
      //Если аутентификация не удалась, то сообщение об ошибке
      return new View('site.login', ['message' => 'Неправильные логин или пароль']);
   }
   public function logout(): void
{
   Auth::logout();
   app()->route->redirect('/hello');
}

public function noAccess(): string
{
    return new View('site.no_access');
}

}