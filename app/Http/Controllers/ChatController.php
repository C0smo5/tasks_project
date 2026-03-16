<?php

namespace App\Http\Controllers;


class ChatController extends controller
{   

    public function index()
    {

        return view('chat', [
        'tasks' =>\App\Models\Task::all(),
    ]);
    }

}