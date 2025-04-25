<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can('Rol Listar')) {
            return view('no_autorizado');
        }
        if (Auth::user() == "superadmin") {
            $roles = Role::with('permissions')->paginate(10);
        } else {
            $roles = Role::where('name', '!=', 'superadmin')->with('permissions')->paginate(10);
        }


        $permisos = Permission::all(); // Asegúrate de obtener todos los permisos

        return view('roles.index', compact('roles', 'permisos'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->can('Rol Crear')) {
            return view('no_autorizado');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('roles')->withErrors($validator)->withInput();
        }
        try {
            Role::create(['name' => $request->name, 'guard_name' => 'web'] + $request->all()); // Crea el rol

            return redirect('roles')->with('success', 'Rol creado exitosamente');
        } catch (\Exception $e) {
            return redirect('roles')->withErrors(['error' => 'Ocurrió un error al guardar el rol']);
        }
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->can('Rol Editar')) {
            return view('no_autorizado');
        }
        try {

            $rol = Role::findOrFail($id); // Busca el rol por su id

            $permisos = array_map('intval', $request->input('permisos')); // Convierte los permisos a enteros

            $rol->syncPermissions($permisos); // Asigna los permisos al rol

            return redirect('roles')->with('success', 'Permisos asignados correctamente');
        } catch (\Exception $e) {
            return redirect('roles')->withErrors(['error' => 'Ocurrió un error al asignar los permisos']);
        }
    }

    public function destroy($id)
    {
        if (!Auth::user()->can('Rol Eliminar')) {
            return view('no_autorizado');
        }
        try {
            $rol = Role::findOrFail($id); // Busca el rol por su id
            $rol->delete(); // Elimina el rol

            return redirect('roles')->with('success', 'Rol eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect('roles')->withErrors(['error' => 'Ocurrió un error al eliminar el rol']);
        }
    }
}
