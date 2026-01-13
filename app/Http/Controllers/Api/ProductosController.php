<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Productos;

class ProductosController extends Controller
{

    public function index()
    {
        $Productos = Productos::all();
        return response()->json($Productos);
        
    }
 // Mostrar un Productos
    public function show($id)
    {
        $Productos = Productos::findOrFail($id);
        return response()->json($Productos);
    }


}
