<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table    = 'subject';
    protected $fillable = ['name'];

    public function question()
    {
        return $this->hasMany('App\Question', 'sid');
    }

    public static function getSubjects()
    {
        return Subject::all();

    }

    public static function getNonEmptySubjects()
    {

        return Subject::has('Question')->get();
    }

    public static function addSubject($name)
    {
        return Subject::create(['name' => $name]);
    }

}
