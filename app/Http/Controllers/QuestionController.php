<?php

namespace App\Http\Controllers;

use App\Author;
use App\FAQ;
use App\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Request;
use TwigBridge\Facade\Twig;

class QuestionController extends Controller
{
    public function questionChangeRender()
    {
        $id      = Request::input('question_id');
        $name    = Request::input('question_name');
        $author  = Request::input('question_author');
        $subject = Request::input('question_subject');
        $params  = array('id' =>
            $id, 'name' => $name, 'subjects' => FAQ::getSubjectsVisible(), 'authors' => Author::getAuthors(), 'author' => $author, 'subject' => $subject, 'question' => FAQ::getQuestion($id));
        return Twig::render('question', $params);
    }

    public function questionChange()
    {
        $i = Request::input();
        FAQ::subjectQ($i['question_id'], $i['subjects_assign']);
        FAQ::chAuthorQ($i['question_id'], $i['ath_assign']);
        if (isset($i['aid'])) {

        }
        FAQ::answerQ($i['question_id'], $i['aid'], $i['answer']);
        if (isset($i['visibleQ'])) {
            FAQ::publishQ($i['question_id'], false);
        } elseif (isset($i['aid'])) {
            FAQ::publishQ($i['question_id'], true);
            echo 'ok';
        }

        $message = "Изменения внесены в систему: изменен вопрос id:" . $i['question_id'];
        Log::info($message);
        return redirect()->route('admin')->with(['message' => $message]);
    }

    public function questionDelete()
    {
        $i      = Request::input();
        $result = FAQ::delQ($i['question_id']);
        if ($result) {
            $message = "Изменения внесены в систему: вопрос id:" . $i['question_id'] . ' удален.';
            Log::info($message);
        }

        return redirect()->route('admin')->with(['message' => $message]);
    }

    public function showAllAdmin($filter = '')
    {
        if (Auth::check()) {
            $params = array(
                'subjects' => FAQ::getSubjectsVisible(),
                'authuser' => Auth::id(),
                'quanda'   => FAQ::listQuestions($filter, true),
                'authors'  => Author::getAuthors(),
                'users'    => Users::getUsers(),
                'message'  => Request::session()->get('message'),
            );
            return Twig::render('admin', $params);
        } else {
            return redirect()->route('auth');
        }
    }

    public function fillQuestion()
    {
        $auth   = Request::input('authname');
        $email  = Request::input('email');
        $qu     = Request::input('question');
        $subid  = Request::input('subjects_assign');
        $id     = Author::addAuthor($auth, $email)->id;
        $result = FAQ::addQ($qu, $id, $subid);
        if (isset($result)) {
            $message = "Вопрос сохранен в системе";
        } else {
            $message = "Извините, что-то не так. Попробуйте еще раз";
        }
        return redirect()->route('user')->with(['message' => $message]);
    }

    public function askQuestion()
    {
        $params = array(
            'subjects' => FAQ::getSubjectsVisible(),
        );
        return Twig::render('askquestion', $params);
    }

}
