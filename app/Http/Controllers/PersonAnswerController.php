<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\PersonAnswer;
use App\Models\Task;
use Illuminate\Http\Request;


class PersonAnswerController extends Controller
{
    public function create(Request $request)
    {
        $answer = new PersonAnswer();
        $answer['person_id'] = $request->input('personId');
        $answer['task_id'] = $request->input('taskId');
        $answer['answer'] = $request->input('answer');
        $answer->save();
    }

    public function personList()
    {
        $personList = Person::all();
        return $personList;

    }

    public function personAnswer()
    {
        $person = PersonAnswer::where([]);
    }
}
