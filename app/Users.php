<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    protected $table    = 'users';
    protected $fillable = ['name', 'password'];

    public static function getUsers()
    {
        return Users::all();

    }

    public static function delAdmin($id)
    {
        Users::destroy($id);
        return true;

    }

    public static function addAdmin($name, $password)
    {
        USERS::create(['name' => $name, 'password' => $password]);
        return true;

    }

    public static function updateAdmin($id, $password)
    {
        $user           = USERS::find($id);
        $user->password = $password;
        $user->save();
        return true;

    }
}
