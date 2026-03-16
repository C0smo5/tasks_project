<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\RoomRequest;

class RoomRequestController extends Controller
{
    public function aprovar($id)
    {
        // Procuro o id do usuario no banco de dados
       $roomRequest = RoomRequest::findOrFail($id);

       // Aqui eu associo o usuario a sala
       $roomRequest->room->users()->attach($roomRequest->user_id);

        // Atualizo os status dele de pendente para aprovado
        $roomRequest->update(['status'=>'aprovado']);

        return back()->with('sucess', 'Solicitação aprovada.');

    }

    public function recusar($id)
    {
        $roomRequest = RoomRequest::findOrFail($id);

        $roomRequest->update(['status'=>'recusado']);

        return back()->with('sucess', 'Solicitação recusada.');
    }

}
