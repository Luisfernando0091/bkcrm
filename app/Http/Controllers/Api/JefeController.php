<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jefe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JefeController extends Controller
{
    // 📌 Listar
    public function index()
    {
        return response()->json(
            Jefe::where('estado_registro', 1)->get()
        );
    }

    // 📌 Crear
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:50',
            'email'   => 'required|email|max:80|unique:jefe,email',
            'password'=> 'required|min:6'
        ]);

        $jefe = Jefe::create([
            'nombres' => $request->nombres,
            'email'   => $request->email,
            'password'=> Hash::make($request->password),
            'telefono'=> $request->telefono,
            'dni'     => $request->dni
        ]);

        return response()->json([
            'message' => 'Jefe creado correctamente',
            'data' => $jefe
        ], 201);
    }

    // 📌 Mostrar uno
    public function show($id)
    {
        return response()->json(
            Jefe::findOrFail($id)
        );
    }

    // 📌 Actualizar
    public function update(Request $request, $id)
    {
        $jefe = Jefe::findOrFail($id);

        $jefe->update($request->only([
            'nombres',
            'telefono',
            'dni',
            'estado_registro'
        ]));

        return response()->json([
            'message' => 'Actualizado correctamente'
        ]);
    }

    // 📌 Eliminar lógico
    public function destroy($id)
    {
        $jefe = Jefe::findOrFail($id);
        $jefe->estado_registro = 0;
        $jefe->save();

        return response()->json([
            'message' => 'Jefe desactivado'
        ]);
    }
}
