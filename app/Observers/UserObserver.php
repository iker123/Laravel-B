<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora;
use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        $usuario = Auth::user();
        Bitacora::create([
            'fecha' => now(),
            'accion' => 'Nuevo usuario creado: ' . json_encode($user->only(['name', 'email', 'estado'])),
            'tabla' => 'users',
            'realizado_por' => $usuario ? $usuario->name : 'Sistema',
        ]);
    }

    public function updated(User $user)
    {
        Bitacora::create([
            'fecha' => now(),
            'accion' => 'Usuario actualizado: ' . json_encode($user->getChanges()),
            'tabla' => 'users',
            'realizado_por' => Auth::user()->name,
        ]);
    }

    public function deleted(User $user)
    {
        Bitacora::create([
            'fecha' => now(),
            'accion' => 'Usuario eliminado: ' . json_encode($user->only(['name', 'email', 'estado'])),
            'tabla' => 'users',
            'realizado_por' => Auth::user()->name,
        ]);
    }
}
