<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validação dos dados
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'function' => ['required', 'in:scrum master,dev,designer'],

            'room_name' => ['required_if:function,scrum master','string','max:255'],
            'room_code' => ['required_if:function,dev','required_if:function,design'],
        ]);

        // Criação do usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'function' => $request->function,
        ]);

        // Criação da sala
        if($request->function === 'scrum master'){

            // Gerador do codigo da sala
            do {
                $code = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6));
            } while (Room::where('id_share', $code)->exists());

            // Cria de fato a sala
            $room = Room::create([
                'name'  => $request->room_name,
                'id_share' => $code,
            ]);

            // Aqui eu associo o scrum master a sala
            $room->users()->attach($user->id);

        } else{

            // Entrada na sala por codigo(para dev e design)
            $room = Room::where('id_share', $request->room_code)->first();

            // Verifico se o código esta certo
            if (!$room) {
                return back()->withErrors([
                    'room_code' => 'Código da sala inválido'
                ])->withInput();
            }

            RoomRequest::create([
                'room_id' => $room->id,
                'user_id' => $user->id,
            ]);

        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
