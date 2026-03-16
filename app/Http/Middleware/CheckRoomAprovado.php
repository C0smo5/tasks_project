<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoomAprovado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        if ($user->function === 'scrum master') {
            return $next($request);
        }

        $aprovado = \App\Models\RoomRequest::where('user_id', $user->id)
        ->where('status', 'aprovado')
        ->exists();

        if (!$aprovado) {
            return redirect()->route('aguardando');
        }

        return $next($request);
    }
}
