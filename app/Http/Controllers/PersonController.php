<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Person;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    public function create(Request $request)
    {
        $specialization = $request->input('specialization');
        $person = new Person;
        $person['name'] = $request->input('name');
        $person['phone'] = $request->input('phone');
        $person['telegram'] = $request->input('telegram');
        $person['specialization'] = $request->input('specialization');
        $person['inviter_id'] = $request->input('inviterId');
        $person['event_id'] = $request->input('eventId');
        $person->save();
        return  Task::all()->where('specialization', $specialization);
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');
        return Event::where('id', $id)->first();
    }

    public function list()
    {
        return Event::all();
    }

    public function delete(Request $request): string
    {
        //todo - дописать условие о том что удалить евент нельзя если его id уже используется в других таблицах
        $id = $request->get('id');
        DB::table('events')
            ->where('id', '=', $id)
            ->delete();
        return 'успешно';
    }

}
