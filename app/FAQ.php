<?php

namespace App;

use App\Question;
use App\Subject;
use Illuminate\Database\QueryException;

class FAQ extends Question
{

    public static function addQ($question, $authid, $subid)
    {
        try {
            return Question::create(['question' => $question, 'athid' => $authid, 'sid' => $subid, 'vis' => 0]);
        } catch (\Illuminate\Database\QueryException $ex) {
            dd($ex->getMessage());
        }
    }

    public static function delQ($id)
    {
        return Question::destroy($id);

    }

    public static function delSubject($id)
    {
        try {
            Question::where("sid", $id)->delete();
            Subject::destroy($id);
            return true;
        } catch (\Illuminate\Database\QueryException $ex) {
            dd($ex->getMessage());
        }
    }

    public static function subjectQ($id, $sid)
    {
        $question = Question::find($id);
        if ($question->sid != $sid) {

            $question->sid = $sid;
            $question->save();
        }
        return true;

    }

    public static function chAuthorQ($id, $athid)
    {
        try {
            $question        = Question::find($id);
            $question->athid = $athid;
            $question->save();
            return true;
        } catch (\Illuminate\Database\QueryException $ex) {
            dd($ex->getMessage());
        }
    }

    public static function publishQ($id, $bool)
    {
        $question = Question::find($id);
        if ($bool) {
            $question->setVis(1);

        } else {
            $question->setVis(0);
        }

        $question->save();
        return true;
    }

    public static function answerQ($qid, $aid, $txt)
    {

        try {

            if ($txt != '') {
                if (isset($aid)) {
                    $answer       = Answer::find($aid);
                    $answer->text = $txt;
                    $answer->save();
                } else {
                    $aid           = Answer::create();
                    $aid->text     = $txt;
                    $question      = Question::find($qid);
                    $question->aid = $aid->id;
                    $question->setVis(1);
                    $question->save();
                    $aid->save();
                }
            }
            return true;
        } catch (\Illuminate\Database\QueryException $ex) {
            dd($ex->getMessage());
        }
    }

    public static function getSubjectsVisible()
    {
        $res = Question
            ::selectRaw('question.id as qid, subject.id as id, question.vis as visible, question.aid as answered, subject.name as name, count(CASE WHEN question.vis=0 THEN 1 ELSE NULL END) as count, count(CASE WHEN question.aid>0 THEN 1 ELSE NULL END) as count2, count(CASE WHEN question.id>0 THEN 1 ELSE NULL END) as count3')
            ->rightjoin('subject', 'question.sid', '=', 'subject.id')
            ->groupBy('name')
            ->get();
        return $res;
    }

    public static function listGroupedQuestions($filter, $priv)
    {
        if (!$priv) {
            $match = 'question.vis > 0';
        } else {
            $match = 'question.vis >= 0';
            switch ($filter) {
                case 'unpublished':
                    $match = 'question.vis = 0';
                    break;
                case 'unanswer':
                    $match = 'question.aid is NULL AND question.vis >= 0';
                    break;
            }
        }

        $sub   = Subject::getNonEmptySubjects($var = []);
        $match = $match . ' AND subject.id=';

        foreach ($sub as $s) {
            $res = Question
                ::leftjoin('author', 'question.athid', '=', 'author.id')
                ->leftjoin('subject', 'question.sid', '=', 'subject.id')
                ->leftjoin('answer', 'question.aid', '=', 'answer.id')
                ->select('question.id as quid', 'question.question as question', 'question.vis as quvisible', 'author.name as author', 'author.email as email', 'answer.text as answer', 'answer.id as aid', 'subject.name as subject', 'question.created_at as timeadd')
                ->whereRaw($match . $s->id)
                ->get();
            $var[$s->name] = $res;
        }
        return $var;
    }

    public static function listQuestions($filter, $priv)
    {
        if (!$priv) {
            $match = 'question.vis > 0';
        } else {
            $match = 'question.vis >= 0';
            switch ($filter) {
                case 'unpublished':
                    $match = 'question.vis = 0';
                    break;
                case 'unanswer':
                    $match = 'question.aid is NULL OR answer.text ="" AND question.vis >= 0';
                    break;
            }
        }

        $res = Question
            ::leftjoin('author', 'question.athid', '=', 'author.id')
            ->leftjoin('subject', 'question.sid', '=', 'subject.id')
            ->leftjoin('answer', 'question.aid', '=', 'answer.id')
            ->select('question.id as quid', 'question.question as question', 'question.vis as quvisible', 'author.name as author', 'author.email as email', 'answer.text as answer', 'answer.id as aid', 'subject.name as subject', 'question.created_at as timeadd')
            ->whereRaw($match)
            ->orderByRaw('question.created_at DESC')
            ->get();

        return $res;
    }

    public static function getQuestion($id)
    {
        $res = Question
            ::leftjoin('author', 'question.athid', '=', 'author.id')
            ->leftjoin('subject', 'question.sid', '=', 'subject.id')
            ->leftjoin('answer', 'question.aid', '=', 'answer.id')
            ->select('question.id as quid', 'question.question as question', 'question.vis as quvisible', 'author.name as author', 'author.email as email', 'answer.text as answer', 'answer.id as aid', 'subject.name as subject', 'question.created_at as timeadd', 'question.athid as athid', 'question.sid as sid')
            ->whereRaw('question.id = ' . $id)
            ->get();
        return $res[0];
    }

}
