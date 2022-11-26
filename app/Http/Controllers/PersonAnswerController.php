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

    public function personAnswer(Request $request)
    {
        $personId = $request->input('personId');
        $personAnswer = Person::where('id', $personId)->first();
        $answer = PersonAnswer::where('person_id', $personAnswer['id'])->first();
        $answers = Task::where('id', $answer['task_id'])->first();
        return [
            'person' => $personAnswer,
            'answer' => [
                'title' => $answers['title'],
                'description' => $answers['description'],
                'answer' => $answers['answer'],
                'userAnswer' => $answer['answer'],
                'specialization' => $answers['specialization'],

            ],
        ];
    }
}
