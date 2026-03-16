<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskService
{
    public function createTask(array $data): void // Aqui crio a função de criação de tasks, e digo que não vai retornar nada(void)
    {
        Task::create([
            'room_id' => $data['room_id'],
            'by_make' => Auth::id(), // Esse Auth pega o id do usuario da sessão
            'who_does' => $data['who_does'],
            'name' => $data['name'],
            'type' => $data['type'],
            'priority' => $data['priority'],
            'descri_task' => $data['descri_task'],
            'date_expiration' =>$data['date_expiration']
        ]);
    }
}

