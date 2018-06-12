<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
	protected $table = 'author';
	protected $fillable = ['name', 'email'];


    public function question()
    {
        return $this->hasMany('App\Question');
    }

    public static function getAuthors()
    {
        return Author::all();
    }

    public static function addAuthor($name, $email)
    {
        return Author::create(['name' => $name, 'email' => $email]);
    }


}
