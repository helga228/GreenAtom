<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\PersonAnswer;
use App\Models\Task;
use App\Models\User;
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

    public function personAnswer(Request $request)
    {
        $personId = $request->input('personId');
        $personAnswer = Person::where('id', $personId)->first();
        $answer = PersonAnswer::where('person_id', $personAnswer['id'])->get('task_id');
        $tasks = Task::all();

        foreach ($tasks as $task => $value){
            $data[] = [
                'person' => Person::where('id', $personId)->get(),
                'id'=>$value['id'],
                'title'=>$value['title'],
                'description'=>$value['description'],
                'answer'=>$value['answer'],
                'userAnswer' => PersonAnswer::where('task_id', $value['id'])->get('answer'),
            ];
        }
        return $data;
    }
}
