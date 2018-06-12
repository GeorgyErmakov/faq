<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Question extends Model
{

	protected $table = 'question';
	protected $fillable = ['id','visible', 'question', 'aid', 'sid', 'athid', 'vis'];

     public function author()
    {
        return $this->belongsTo('App\Author', 'athid');
    }

    public function answer()
    {
        return $this->belongsTo('App\Answer', 'aid');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject', 'sid');
    }

    public function setVis($i)
    {
        $this->vis = $i;
    }

}
