<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora;
use Spatie\Permission\Models\Role;

class RolObserver
{
    public function created(Role $rol)
    {
        $usuario = Auth::user();
        Bitacora::create([
            'fecha' => now(),
            'accion' => 'Nuevo rol creado: ' . json_encode($rol->only(['name'])),
            'tabla' => 'roles',
            'realizado_por' => $usuario ? $usuario->name : 'Sistema',
        ]);
    }

    public function updated(Role $rol)
    {
        Bitacora::create([
            'fecha' => now(),
            'accion' => 'Rol actualizado: ' . json_encode($rol->getChanges()),
            'tabla' => 'roles',
            'realizado_por' => Auth::user()->name,
        ]);
    }

    public function deleted(Role $rol)
    {
        Bitacora::create([
            'fecha' => now(),
            'accion' => 'Rol eliminado: ' . json_encode($rol->only(['name'])),
            'tabla' => 'roles',
            'realizado_por' => Auth::user()->name,
        ]);
    }
}
