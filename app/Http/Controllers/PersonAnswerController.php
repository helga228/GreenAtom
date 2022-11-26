<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\PersonAnswer;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PersonAnswerController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function create(Request $request): string
    {
        $validator = Validator::make($request->all(), [
            'personId' => 'exists:people,id',
            'taskId' => 'exists:tasks,id',
            'answer' => 'max:255',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json([
                'error' => current($errors),
            ]);
        }
        $answer = new PersonAnswer();
        $answer['person_id'] = $request->input('personId');
        $answer['task_id'] = $request->input('taskId');
        $answer['answer'] = $request->input('answer');
        if($answer->save()){
            return "Сохранено";
        }
        return "не удалось сохранить запись";
    }

    /**
     * @return Person[]|\Illuminate\Database\Eloquent\Collection
     */
    public function personList(): self
    {
        return Person::all();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function personAnswer(Request $request): array
    {
        $personId = $request->input('personId');
        $tasks = Task::all();

        foreach ($tasks as $task => $value){
            $data[] =[
                'person' => Person::where('id', $personId)->first(),
                'title'=>$value['title'],
                'description'=>$value['description'],
                'answer'=>$value['answer'],
                'userAnswer' => PersonAnswer::where('task_id', $value['id'])->get('answer')->first(),
            ];
        }
        return $data;

    }
}
