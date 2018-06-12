<?php

namespace App\Http\Controllers;

use App\User;
use App\Users;
use App\FAQ;
use App\Question;
use App\Subject;
use App\Author;
use App\AdminLogger; 
use Request;
use Illuminate\Support\Facades\DB;
use TwigBridge\Facade\Twig;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FAQController extends Controller
{
    public function faqList() 
    {
	   $params = array(
       'subjects' => FAQ::getSubjectsVisible(),
       'authuser' => Auth::id(),
       'quanda' => FAQ::showQ(1,false),
       'authors' => Author::getAuthors(),
       'message'=> Request::session()->get('message'),
            );
    return Twig::render('index', $params);
    }

    public function showAllAdmin($filter = '') 
    {
        if(Auth::check()) {
            $params = array(
            'subjects' => FAQ::getSubjectsVisible(),
            'authuser' => Auth::id(),
            'quanda' => FAQ::showQ($filter, true),
            'authors' => Author::getAuthors(),
            'users' => Users::getUsers(),
            'message'=> Request::session()->get('message'),
            );
      return Twig::render('admin', $params);
        } else {
	       return redirect()->route('auth');
        }
    }

    public function fillQuestion() 
    {
        $auth = Request::input('authname');
        $email = Request::input('email');
        $qu = Request::input('question');
        $subid = Request::input('subjects_assign');
        $id = Author::addAuthor($auth, $email)->id;
        $result = FAQ::addQ($qu, $id, $subid);
        if(isset($result)) {
            $message = "Вопрос сохранен в системе";
        } else {
            $message = "Извините, что-то не так. Попробуйте еще раз";
        }
        return redirect()->route('user')->with(['message'=>$message]);
    }


    public function chAdmin($message = '') 
    {
          
        if(count(Request::input())) {
            $i = Request::input();
            switch ($i['action']) {
                case 'Убрать из публикации вопрос':
                    $result = FAQ::publishQ($i['qID'], false);      
                break;
                case 'Публиковать вопрос':
                    $result = FAQ::publishQ($i['qID'], true);
                break;
                case 'Изменить тему вопроса':
                     $result = FAQ::subjectQ($i['qID'], $i['subjects_assign']);
                break;
                case 'Изменить автора вопроса':
                    $result = FAQ::chAuthorQ($i['qID'],$i['ath_assign']);
                break;
                case 'Ответить на вопрос':
                    $result = FAQ::answerQ($i['qID'], $i['aID'], $i['text']) ;
                break;
                case 'Удалить вопрос':
                    $result = FAQ::delQ($i['qID']);
                break;
                case 'Сменить пароль администратора':
                    $result = USERS::updateAdmin($i['admin_id'], Hash::make($i['password']));
                break;
                case 'Удалить администратора':
                    $id = Request::input('admin_id');
                    $result = USERS::delAdmin($id);
                break;
                case 'Добавить администратора':
                    $result = USERS::addAdmin($i['name'], Hash::make($i['password']));
                break;
                    case 'Новая тема':
                    $result = Subject::addSubject($i['subject']);
                break;
                case 'Удалить тему':
                    $id = Request::input('sub_id');
                    $result = FAQ::delSubject($id);
                break;
            }

            if(isset($result) && Auth::check()) {
                AdminLogger::create()->info($i['action'], ['Администратор:'=> Auth::user()->name,]);
                $message = "Изменения внесены в систему";
            }
        }
        
        return redirect()->route('admin')->with(['message'=>$message]);
    }
}
