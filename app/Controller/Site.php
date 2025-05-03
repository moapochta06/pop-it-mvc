<?php
namespace Controller;
use Src\View;
use Model\User;
use Src\Request;
class Site
{   
public function index(): string
{
$view = new View();
return $view->render('site.hello', ['message' => 'index
working']);
}
public function hello(): string
{
return new View('site.hello', ['message' => 'hello
working']);
}
public function signup(Request $request): string
   {
       if ($request->method==='POST' && User::create($request->all())){
           return new View('site.signup', ['message'=>'Вы успешно зарегистрированы']);
       }
       return new View('site.signup');
   }

}