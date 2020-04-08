<?php

namespace App\Http\Controllers;

use App\Filial;

class FilialController extends Controller
{
    public function index()
    {
        return Filial::get();
    }

    public function show($id)
    {
        return Filial::findOrFail($id);
    }
}
