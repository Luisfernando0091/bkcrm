<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vendedor;

class VendedorController extends Controller
{
    public function index()
    {
        return Vendedor::select('id', 'nombres', 'email')
            ->orderBy('nombres')
            ->get();
    }
}
