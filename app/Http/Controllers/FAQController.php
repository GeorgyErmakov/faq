<?php

namespace App\Http\Controllers;

use App\Author;
use App\FAQ;
use App\Subject;
use Illuminate\Support\Facades\Auth;
use Request;
use TwigBridge\Facade\Twig;

class FAQController extends Controller
{
    public function faqList()
    {
        $params = array(
            'subjects' => Subject::getNonEmptySubjects(),
            'authuser' => Auth::id(),
            'quanda'   => FAQ::listGroupedQuestions(1, false),
            'authors'  => Author::getAuthors(),
            'message'  => Request::session()->get('message'),
        );return Twig::render('index', $params);
    }
}
