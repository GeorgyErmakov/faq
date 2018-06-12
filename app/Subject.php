<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	protected $table = 'subject';
	protected $fillable = ['name'];


    public function question()
    {
        return $this->hasMany('App\Question');
    }

    public static function getSubjects()
    {
        return Subject::all();
 
    }

    public static function addSubject($name)
    {
        Subject::create(['name' => $name]);
    }

 
}
