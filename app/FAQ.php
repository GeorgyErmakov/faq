<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\Subject;
use App\Author;
use Validator;
use Illuminate\Database\QueryException;


interface iFAQ
{
    public static function addQ($question, $authid, $subid);
    public static function delSubject($id);
    public static function subjectQ($id, $sid);
    public static function chAuthorQ($id, $athid);
    public static function publishQ($id, $bool);
    public static function answerQ($qid, $aid, $txt);
    public static function getSubjectsVisible();
    public static function showQ($filter, $priv);
    public static function delQ($id);    
}


class FAQ extends Question implements iFAQ
{

    public static function addQ($question, $authid, $subid)
    {  
        try{
            Question::create(['question' => $question, 'athid' => $authid, 'sid' => $subid, 'vis' => 0]);
        } catch(\Illuminate\Database\QueryException $ex){ 
            dd($ex->getMessage()); 
        }
    }

    public static function delQ($id)
    {
        Question::destroy($id);
    }
   
    public static function delSubject($id)
    {    
        try{
            Question::where("sid", $id)->delete();
            Subject::destroy($id);
        } catch(\Illuminate\Database\QueryException $ex){ 
            dd($ex->getMessage()); 
        }
    }

    public static function subjectQ($id, $sid)
    {
        try{
            $question = Question::find($id);
            $question->sid = $sid;
            $question->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            dd($ex->getMessage()); 
        }
    }

    public static function chAuthorQ($id, $athid)
    {
        try{
            $question = Question::find($id);
            $question->athid = $athid;
            $question->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            dd($ex->getMessage()); 
        }
    }
    
    public static function publishQ($id, $bool)
    {
        $question = Question::find($id);
        if($bool) {
            $question->setVis(1);


        } else {
           $question->setVis(0); 
        }
 
        $question->save();
    }

    public static function answerQ($qid, $aid, $txt)
    {
        
        try{
            if(isset($aid)) {
                $answer = Answer::find($aid);
                $answer->text = $txt;
                $answer->save();
            } else {
        
                $aid = Answer::create();
                $aid->text = $txt;
                $question = Question::find($qid);
                $question->aid = $aid->id;
                $question->vis = 1;
                $question->save();
                $aid->save();
            }
        } catch(\Illuminate\Database\QueryException $ex){ 
            dd($ex->getMessage()); 
        }
    }

    public static function getSubjectsVisible()
    {
        $res = Question
            ::selectRaw('subject.id as id, question.vis as visible, question.aid as answered, subject.name as name, count(CASE WHEN question.vis=0 THEN 1 ELSE NULL END) as count, count(CASE WHEN question.aid is Null THEN 1 ELSE NULL END) as count2, count(*) as count3')
            ->rightjoin('subject', 'question.sid', '=', 'subject.id')
            ->groupBy('name')
            ->get(); 
            return $res;
    }

    public static  function showQ($filter, $priv)
    {
        if(!$priv) {
            $match = 'question.vis > 0';
        } else {
            $match = 'question.vis >= 0';
            switch ($filter) {
                case 'nonpublished':
                    $match = 'question.vis = 0';
                break;
                case 'nonanswered':
                    $match = 'question.aid is NULL AND question.vis >= 0';
                break;
            }
        }
    
        $sub = Subject::getSubjects($var = []);
        $match = $match.' AND subject.id=';
        
        foreach ($sub as $s) {
            $res = Question
            ::leftjoin('author', 'question.athid', '=', 'author.id')
            ->leftjoin('subject', 'question.sid', '=', 'subject.id')
            ->leftjoin('answer', 'question.aid', '=', 'answer.id')
            ->select('question.id as quid', 'question.question as question', 'question.vis as quvisible', 'author.name as author', 'author.email as email', 'answer.text as answer', 'answer.id as aid' , 'subject.name as subject', 'question.created_at as timeadd')
            ->whereRaw($match.$s->id)
            ->get();
            $var[$s->name] = $res;
        }
    return  $var;
    }


}
