<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{

	protected $table = 'users';
	protected $fillable = ['name', 'password'];

    public static function getUsers()
    {
        return Users::all();
 
    }

    public static function delAdmin($id)
    {
        return Users::destroy($id);
 
    }

    public static function addAdmin($name, $password)
    {
        USERS::create(['name' => $name, 'password' => $password,]);
 
    }

    public static function updateAdmin($id, $password)
    {
        $user = USERS::find($id);
        $user->password = $password;
        $user->save();
 
    }
}
