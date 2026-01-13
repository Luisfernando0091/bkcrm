<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conclusiones;

class ConclusionController extends Controller
{
    public function index()
    {
        return response()->json(
            Conclusiones::all()
        );
    }
}
