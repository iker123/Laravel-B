<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->can('Usuario Listar')) {
            return view('no_autorizado');
        }
        $usuarios = User::with('roles')->paginate(10);
        $roles = Role::all(); // Obtén todos los roles
        return view('usuarios.index', compact('usuarios', 'roles'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->can('Usuario Crear')) {
            return view('no_autorizado');
        }
        $validatos = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'rol_id' => 'required|exists:roles,id', // Validar que el rol exista
        ]);

        if ($validatos->fails()) {
            // Retorno el error
            return redirect('usuarios')
                ->withErrors($validatos)
                ->withInput();
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ] + $request->all());

            // Asociar el rol al usuario
            $user->roles()->attach($request->rol_id);

            return redirect('usuarios')->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            return redirect('usuarios')
                ->withErrors(['error' => 'Ocurrió un error al guardar el usuario'])
                ->withInput();
        }
    }
    public function update(Request $request, $id)
    {
        if (!Auth::user()->can('Usuario Editar')) {
            return view('no_autorizado');
        }
        $validatos = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'rol_id' => 'required|exists:roles,id',
        ]);

        if ($validatos->fails()) {
            return redirect('usuarios')
                ->withErrors($validatos)
                ->withInput();
        }

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->estado = $request->estado;

            if ($request->password) {
                $user->password = bcrypt($request->password); // Solo actualizar la contraseña si se proporciona
            }

            $user->save();

            // Actualizar los roles del usuario
            $user->roles()->sync([$request->rol_id]);

            return redirect('usuarios')->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect('usuarios')
                ->withErrors(['error' => 'Ocurrió un error al actualizar el usuario'])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        if (!Auth::user()->can('Usuario Eliminar')) {
            return view('no_autorizado');
        }
        try {
            $user = User::findOrFail($id);

            // si el usuario esta en una orden de servicio no se puede eliminar
            if ($user->ordenes_servicio()->count() > 0) {
                return redirect('usuarios')
                    ->withErrors(['error' => 'El usuario no se puede eliminar porque tiene ordenes de servicio asociadas']);
            }
            //cambio de estado
            $user->estado = 0;
            $user->save();

            return redirect('usuarios')->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect('usuarios')
                ->withErrors(['error' => 'Ocurrió un error al eliminar el usuario']);
        }
    }
}
