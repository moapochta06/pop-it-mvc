<?php
namespace Controller;
use Src\View;
use Src\Request;
use Model\Subject;

class Subjects{
    public function get_subject(): string
    {   
        $subjects = Subject::all();
        return new View('site.subjects', [
            'subjects'=> $subjects
        ]);
    }
}
