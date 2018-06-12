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
        FAQ::addQ($qu, $id, $subid);
        return redirect()->route('user');
    }

    public function addAdmin() 
    {
        $data = Request::input();
        USERS::addAdmin($data['name'], Hash::make($data['password']));
        return redirect()->route('admin');
    }

    public function chAdmin() 
    {
        $i = Request::input();
        $id = Request::input('admin_id');
        switch ($i['action']) {
            case 'Удалить':
                USERS::delAdmin($id);    
            break;
            case 'Сменить пароль':
                USERS::updateAdmin($id, Hash::make($i['password']));       
            break;
        
        }
        return redirect()->route('admin');
    }

    public function newSubject() {
        $input = Request::input();
        Subject::addSubject($input['subject']);
        return redirect()->route('admin');
    }

    public function delSubject() {
        $id = Request::input('sub_id');
        FAQ::delSubject($id);
        return redirect()->route('admin');
    }

    public function chQ() 
    {

        $i = Request::input();
        switch ($i['action']) {
            case 'Убрать из публикации':
                
                FAQ::publishQ($i['qID'], false);
                
            break;
            case 'Публиковать':
                echo "ID".$i['qID'];
                FAQ::publishQ($i['qID'], true);
            break;
            case 'Изменить тему':
                FAQ::subjectQ($i['qID'], $i['subjects_assign']);
            break;
            case 'Изменить автора':
                FAQ::chAuthorQ($i['qID'],$i['ath_assign']);
            break;
            case 'Ответить':
                FAQ::answerQ($i['qID'], $i['aID'], $i['text']) ;
            break;
            case 'Удалить вопрос':
                FAQ::delQ($i['qID']);
            break;
        }
        
        AdminLogger::create()->info($i['action'], array('Администратор:'=> Auth::user()->name, 'Вопрос:' => $i['qID']));
        
        return redirect()->route('admin');
    }
}
