<?php

namespace App\Http\Controllers;

use App\FAQ;
use App\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Request;
use TwigBridge\Facade\Twig;

class SubjController extends Controller
{

    public function subjectList()
    {
        if (Auth::check()) {
            $params = array(
                'subjects' => FAQ::getSubjectsVisible(),
                'message'  => Request::session()->get('message'),
            );
            return Twig::render('subjects', $params);
        } else {
            return redirect()->route('auth');
        }
    }

    public function subjectAdd()
    {

        if (count(Request::input())) {
            $i      = Request::input();
            $result = Subject::addSubject($i['subject']);

            if (isset($result)) {
                $message = "Изменения внесены в систему: добавлена тема " . $i['subject'];
                Log::info($message);
            }

        }
        return redirect()->route('subjects')->with(['message' => $message]);
    }

    public function subjectChangeRender()
    {
        $id     = Request::input('subject_id');
        $name   = Request::input('name');
        $params = array('id' => $id, 'name' => $name);
        return Twig::render('chsubject', $params);
    }

    public function subjectDelete()
    {
        if (count(Request::input())) {
            $id     = Request::input('subject_id');
            $result = FAQ::delSubject($id);
            if ($result) {
                $message = "Изменения внесены в систему: тема удалена id=" . $id;
                Log::info($message);
            }

        }
        return redirect()->route('subjects')->with(['message' => $message]);
    }
}
