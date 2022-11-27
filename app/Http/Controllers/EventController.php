<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Person;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'date' => 'date|required',

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json([
                'error' => current($errors),
            ]);
        }
        $event = new Event;
        $event['name'] = $request->input('name');
        $event['date'] = $request->input('date');
        $event->save();
        return $event;

    }


    public function detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:events',

        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json([
                'error' => current($errors),
            ]);
        }
        $id = $request->get('id');
        $event = Event::where('id', $id)->first();

        $personInEvent = Person::where('event_id', $event['id'])->get();
        return [
            'event' => $event,
            'person' => $personInEvent,
            'statistic' => Statistic::where('event_id', $id)->first('count')
        ];
    }
    public function statistic(Request $request)
    {
        $id = $request->get('eventId');
        $statistic = Statistic::where('event_id', $id)->first();
        $statistic['count'] = ($statistic['count'] + 1);
        $statistic->save();

    }

    public function list()
    {
        return Event::all();
    }


    public function delete(Request $request): string
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:event',
            'date' => 'date|required',

        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json([
                'error' => current($errors),
            ]);
        }
        $id = $request->get('id');
        $PersonEvent = Person::where('event_id', $id)->first();
        if($PersonEvent != null){
            return 'Запись используется в другой таблице, не удалай';
        }
        DB::table('events')
            ->where('id', '=', $id)
            ->delete();
        return 'успешно';
    }

}
