<?php

namespace Middlewares;

use Src\Request;
use function Collect\collection;
// class SpecialCharsMiddleware
// {
//    public function handle(Request $request):Request
//    {
//        foreach ($request->all() as $key => $value) {
//            $request->set($key, is_string($value) ? htmlspecialchars($value) : $value);
//        }
//        return $request;
//    }
// }
class SpecialCharsMiddleware
{
   public function handle(Request $request): Request
   {
       collection($request->all())->each(function ($value, $key, $request) {
               $request->set($key, is_string($value) ? htmlspecialchars($value) : $value);
           }, $request);

       return $request;
   }
}

