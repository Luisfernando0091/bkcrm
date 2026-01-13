<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserProspecto;
use Illuminate\Http\Request;

class UserProspectoController extends Controller
{
    // Listar todos los UserProspectos
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);

        $userProspectos = UserProspecto::with([
            'prospecto',
            //'estadoCivil', 'sexo', 'departamento', 'provincia', 'distrito' // agregar si existen las tablas
        ])->paginate($perPage);

        return response()->json($userProspectos);
    }

    // Mostrar un UserProspecto
    public function show($id)
    {
        $userProspecto = UserProspecto::with([
            'prospecto',
            //'estadoCivil', 'sexo', 'departamento', 'provincia', 'distrito'
        ])->findOrFail($id);

        return response()->json($userProspecto);
    }

    // Crear un nuevo UserProspecto
    public function store(Request $request)
    {
        $data = $request->validate([
            'prospecto_id' => 'required|integer|exists:prospecto,id',
            'id_estado_civil' => 'nullable|integer',
            'fecha_nacimiento' => 'nullable|date',
            'id_sexo' => 'nullable|integer',
            'id_departamento' => 'nullable|integer',
            'id_provincia' => 'nullable|integer',
            'id_distrito' => 'nullable|integer',
            'telef_domicilio' => 'nullable|string|max:15',
            'telef_oficina' => 'nullable|string|max:15',
            'celular' => 'nullable|string|max:15',
            'direccion_prospecto' => 'nullable|string|max:100',
            'numero_documento' => 'nullable|string|max:20',
            'urbanizacion' => 'nullable|string|max:100',
            'referencia' => 'nullable|string|max:100',
            'ocupacion' => 'nullable|string|max:50',
            'nombres' => 'nullable|string|max:50',
            'ubigeo' => 'nullable|string|max:6',
            'estado_eliminacion' => 'nullable|boolean',
        ]);

        $userProspecto = UserProspecto::create($data);
        return response()->json($userProspecto, 201);
    }

    // Actualizar un UserProspecto
    public function update(Request $request, $id)
    {
        $userProspecto = UserProspecto::findOrFail($id);

        $data = $request->validate([
            'prospecto_id' => 'required|integer|exists:prospecto,id',
            'id_estado_civil' => 'nullable|integer',
            'fecha_nacimiento' => 'nullable|date',
            'id_sexo' => 'nullable|integer',
            'id_departamento' => 'nullable|integer',
            'id_provincia' => 'nullable|integer',
            'id_distrito' => 'nullable|integer',
            'telef_domicilio' => 'nullable|string|max:15',
            'telef_oficina' => 'nullable|string|max:15',
            'celular' => 'nullable|string|max:15',
            'direccion_prospecto' => 'nullable|string|max:100',
            'numero_documento' => 'nullable|string|max:20',
            'urbanizacion' => 'nullable|string|max:100',
            'referencia' => 'nullable|string|max:100',
            'ocupacion' => 'nullable|string|max:50',
            'nombres' => 'nullable|string|max:50',
            'ubigeo' => 'nullable|string|max:6',
            'estado_eliminacion' => 'nullable|boolean',
        ]);

        $userProspecto->update($data);
        return response()->json($userProspecto);
    }

    // Eliminar un UserProspecto
    public function destroy($id)
    {
        $userProspecto = UserProspecto::findOrFail($id);
        $userProspecto->delete();
        return response()->json(['message' => 'UserProspecto eliminado']);
    }

    // Obtener UserProspecto por prospecto_id
    public function showByProspecto($prospectoId)
    {   //llamar el atributo producto dentro de prospecto
        $userProspecto = UserProspecto::where('prospecto_id', $prospectoId)
            ->with(['prospecto.tipoDocumento','prospecto.producto','prospecto.certificado','prospecto.vendedor','sexo','estadocivil','prospecto.canalDigital',    'prospecto.conclusion'

])
            ->firstOrFail();

        return response()->json($userProspecto);
    }

    // Actualizar UserProspecto por prospecto_id
    public function updateByProspecto(Request $request, $prospectoId)
{
    $userProspecto = UserProspecto::where('prospecto_id', $prospectoId)->firstOrFail();

    $data = $request->validate([
        'id_estado_civil' => 'nullable|integer',
        'fecha_nacimiento' => 'nullable|date',
        'id_sexo' => 'nullable|integer',
        'id_departamento' => 'nullable|integer',
        'id_provincia' => 'nullable|integer',
        'id_distrito' => 'nullable|integer',
        'telef_domicilio' => 'nullable|string|max:15',
        'telef_oficina' => 'nullable|string|max:15',
        'celular' => 'nullable|string|max:15',
        'direccion_prospecto' => 'nullable|string|max:100',
        'numero_documento' => 'nullable|string|max:20',
        'urbanizacion' => 'nullable|string|max:100',
        'referencia' => 'nullable|string|max:100',
        'ocupacion' => 'nullable|string|max:50',
        'nombres' => 'nullable|string|max:50',
        'ubigeo' => 'nullable|string|max:6',
        'estado_eliminacion' => 'nullable|boolean',
    ]);

    $userProspecto->update($data);
    return response()->json($userProspecto);
}

}
