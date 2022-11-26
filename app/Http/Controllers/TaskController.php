<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'string|required',
            'answer' => 'required|max:255',
            'specialization' => 'in:JS,WEB,SAP,ESB,SUP,1С',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json([
                'error' => current($errors),
            ]);
        }
        $task = new Task();
        $task['title'] = $request->input('title');
        $task['description'] = $request->input('description');
        $task['answer'] = $request->input('answer');
        $task['specialization'] = $request->input('specialization');
        $task['variant1'] = $request->input('variant1');
        $task['variant2'] = $request->input('variant2');
        $task['variant3'] = $request->input('variant3');
        $task['variant4'] = $request->input('variant4');

        if($task->save()){
            return  "ok";
        }
        return "не сохранено";
    }
}
