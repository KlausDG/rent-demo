<?php

namespace App\Http\Controllers;

use App\Filial;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $filial = new Filial;
        $filial->title = $request->input('title');
        $filial->phone = $request->input('phone');
        $filial->rua = $request->input('rua');
        $filial->bairro = $request->input('bairro');
        $filial->numero = $request->input('numero');
        $filial->cidade = $request->input('cidade');
        $filial->uf = $request->input('uf');
        $filial->pais = $request->input('pais');
        $filial->cep = $request->input('cep');
        $filial->complemento = $request->input('complemento');
        $filial->referencia = $request->input('referencia');

        $filial->save();
    }
}
