<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function list(Request $request)
    {
        $specialization = $request->get('specialization');
        return Task::where('specialization', $specialization)->all();
    }

}
