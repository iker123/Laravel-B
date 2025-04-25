<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BitacoraController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->can('Bitacora Listar')) {
            return view('no_autorizado');
        }

        $bitacoras = [];

        if ($request->hasAny(['fecha_inicio', 'fecha_fin', 'realizado_por'])) {
            $fecha_inicio = date('Y-m-d 00:00:00', strtotime($request->fecha_inicio));
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($request->fecha_fin));
            $bitacoras = DB::table('bitacoras')->select('bitacoras.*');

            if ($request->fecha_inicio != null) {
                $bitacoras = $bitacoras->where('fecha', '>=', $fecha_inicio);
            }

            if ($request->fecha_fin != null) {
                $bitacoras = $bitacoras->where('fecha', '<=', $fecha_fin);
            }

            if ($request->realizado_por != null) {
                $bitacoras = $bitacoras->where('realizado_por', 'like', '%' . $request->realizado_por . '%');
            }

            $bitacoras = $bitacoras->orderBy('fecha', 'desc')->get();
        }
        return view('bitacoras.index', compact('bitacoras'));
    }
}
