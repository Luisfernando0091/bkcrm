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




public function updateSeguimiento(Request $request, $prospectoId)
{
    $prospecto = Prospecto::findOrFail($prospectoId);

    // ====== CAMPOS NORMALES ======
    $prospecto->fill($request->except([
        'nombre_archivo1',
        'nombre_archivo2'
    ]));

    // ====== ASEGURAR CARPETA ======
    $path = public_path('img');
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    // ====== ARCHIVO 1 ======
    if ($request->hasFile('nombre_archivo1')) {
        $file = $request->file('nombre_archivo1');
        $name = time().'_'.$file->getClientOriginalName();
        $file->move($path, $name);

        $prospecto->nombre_archivo1 = url('img/'.$name);
        $prospecto->archivo1 = $name;
    }

    // ====== ARCHIVO 2 ======
    if ($request->hasFile('nombre_archivo2')) {
        $file = $request->file('nombre_archivo2');
        $name = time().'_'.$file->getClientOriginalName();
        $file->move($path, $name);

        $prospecto->nombre_archivo2 = url('img/'.$name);
        $prospecto->archivo2 = $name;
    }

    $prospecto->save();

    return response()->json([
        'ok' => true,
        'message' => 'Seguimiento actualizado correctamente'
    ]);
}
}
