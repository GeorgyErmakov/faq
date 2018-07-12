<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Request;
use TwigBridge\Facade\Twig;

class UsersController extends Controller
{

    public function usersList()
    {
        if (Auth::check()) {
            $params = array(
                'users'   =>
                Users::getUsers(),
                'message' => Request::session()->get('message'),
            );
            return Twig::render('users', $params);
        } else {
            return redirect()->route('auth');
        }
    }

    public function addAdminUser()
    {
        if (count(Request::input())) {
            $i      = Request::input();
            $result = USERS::addAdmin($i['username'], Hash::make($i['password']));
            if ($result) {
                $message = "Изменения внесены в систему: пользователь " . $i['username'] . " создан.";
                Log::info($message);
            }

        }
        return redirect()->route('users')->with(['message' => $message]);
    }

    public function delAdminUser()
    {
        if (count(Request::input())) {
            $id     = Request::input('admin_id');
            $result = USERS::delAdmin($id);
            if ($result) {
                $message = "Изменения внесены в систему: пользователь системы id=" . $id . " удален.";
                Log::info($message);
            }

        }
        return redirect()->route('users')->with(['message' => $message]);
    }

    public function chAdminRender()
    {
        $id     = Request::input('admin_id');
        $name   = Request::input('name');
        $params = array('id' => $id, 'name' => $name);
        return Twig::render('chadmin', $params);
    }

    public function chAdminUser()
    {
        if (count(Request::input())) {
            $i      = Request::input();
            $result = USERS::updateAdmin($i['admin_id'], Hash::make($i['password']));
            if ($result) {
                $message = "Изменения внесены в систему: пользователь " . $i['username'] . " изменен.";
                Log::info($message);
            }

        }
        return redirect()->route('users')->with(['message' => $message]);
    }

}
