<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function create(Request $request)
    {
        $event = new Event;
        $event['name'] = $request->input('name');
        $event['date'] = $request->input('date');
        $event->save();
        return $event;

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
