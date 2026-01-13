<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prospecto;
use Illuminate\Http\Request;

class ProspectoController extends Controller
{
    // Listar todos los prospectos con el nombre del producto
             public function index(Request $request)
{
    $perPage = $request->get('per_page', 15);

    $query = Prospecto::with([
        'producto',
        'certificado',
        'canalDigital',      
        'conclusion',
        'userProspecto.sexo',
        'userProspecto.estadoCivil',
        'tipoDocumento',
        'userProspecto',
        'vendedor', // <--- ESTO ES LO QUE FALTA
        
    ]);

    if ($request->filled('id')) {
        $query->where('id', $request->id);
    }

    if ($request->filled('mes')) {
        $query->whereMonth('created_at', $request->mes);
    }

    if ($request->filled('año') || $request->filled('anio')) {
        $año = $request->año ?? $request->anio;
        $query->whereYear('created_at', $año);
    }

    if ($request->filled('mes') && ($request->filled('año') || $request->filled('anio'))) {
        $año = $request->año ?? $request->anio;
        $query->whereMonth('created_at', $request->mes)
              ->whereYear('created_at', $año);
    }

    $prospectos = $query->paginate($perPage);

    return response()->json($prospectos);
}


    // Crear un nuevo prospecto
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'nullable|email|max:150',
            'tipo_documento_id' => 'nullable|integer',
            'id_productos' => 'nullable|integer',
            'id_canales' => 'nullable|integer',
            'fecha_registro' => 'nullable|date',
            'id_estado_prospecto' => 'nullable|integer',
            // Agregar las demás validaciones según necesites
        ]);

        $prospecto = Prospecto::create($data);
        return response()->json($prospecto, 201);
    }

    // Mostrar un prospecto con el nombre del producto
    public function show($id)
    {
        // Cargar prospecto y su producto asociado
        $prospecto = Prospecto::with('producto','userProspecto')->findOrFail($id);
        return response()->json($prospecto);
    }

    // Actualizar prospecto
    public function update(Request $request, $id)
    {
        $prospecto = Prospecto::findOrFail($id);
        $prospecto->update($request->all());
        return response()->json($prospecto);
    }

    // Eliminar prospecto
    public function destroy($id)
    {
        $prospecto = Prospecto::findOrFail($id);
        $prospecto->delete();
        return response()->json(['message' => 'Prospecto eliminado']);
    }


}
