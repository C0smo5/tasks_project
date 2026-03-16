<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
Use App\Services\TaskService;
Use App\Http\Requests\StoreTaskRequest;
Use App\Models\Task;
Use App\Models\User;

class TaskController extends controller
{
    public function __construct( // Esse construct roda toda vez que o controller é iniciado, basicamente ele coloca a chama da taskservice dentro da variavel
        protected TaskService $taskService // esse protected basicamente declara a varivel e atribui o valor recebido a ela
    ) {}

    public function store(StoreTaskRequest $request): RedirectResponse
    {

        $room = auth()->user()->rooms()->first();

        $this->taskService->createTask(array_merge(
            $request->validated(),
            ['room_id' => $room->id]
        ));

        return redirect()->route('dashboard');
    }

    public function ListTasksDashboard()
    {
        // Pego os dados do usuario
        $user = auth()->user();
        $tasks = Task::all();

        // Pego a sala do usuario logado
        $room = $user->rooms()->first();

        $pendentes = $room
        ? \App\Models\RoomRequest::where('room_id', $room->id)
            ->where('status', 'pendente')
            ->with('user')
            ->get()
        : collect();

        return view('dashboard', [
            'tasks' => $tasks,
            'totalTasks' => $tasks->count(),
            'emAndamento'=> $tasks->where('stats', 'pendente')->count(),
            'urgentes' => $tasks->where('priority', 'alta')->count(),
            'room' => $room,
            'pendentes' => $pendentes,

        ]);
    }
}
