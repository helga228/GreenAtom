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

    public function answerList()
    {
        $personAnswer = PersonAnswer::all();
        $person = Person::where('id', $personAnswer['person_id'])->all();
        $task = Task::where('id', $personAnswer['task_id'])->all();
        $answer = PersonAnswer::where('task_id', $task['id'])->all();

        return [
            'person' => $person,
            'task' => $task,
            'answer' => $answer,

        ];
    }
}
