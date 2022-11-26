<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{

    /**
     * @param Request $request
     * @return Task[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\JsonResponse|string
     */
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|alpha|max:255',
            'phone' => 'unique:people|string|required',
            'telegram' => 'string|max:255',
            'specialization' => 'in:JS,WEB,SAP,ESB,SUP,1С',
            'inviterId' => 'exists:people,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json([
                'error' => current($errors),
            ]);
        }
        $specialization = $request->input('specialization');
        $person = new Person;
        $person['name'] = $request->input('name');
        $person['phone'] = $request->input('phone');
        $person['telegram'] = $request->input('telegram');
        $person['specialization'] = $request->input('specialization');
        $person['inviter_id'] = $request->input('inviterId');
        $person['event_id'] = $request->input('eventId');
        if($person->save()){
            return  Task::all()->where('specialization', $specialization);
        }
        return 'не сохранено';
    }
}
