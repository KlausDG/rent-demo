<?php

namespace App\Http\Controllers;

use App\Difficulty;
use Illuminate\Http\Request;

class DifficultyController extends Controller
{
    public function index()
    {
        return Difficulty::get();
    }

    public function show($id)
    {
        return Difficulty::findOrFail($id);
    }

    public function store(Request $request)
    {
        $dif = $request->isMethod('put') ? Difficulty::findOrFail($request->id) : new Difficulty;
        $dif->title = $request->input('title');

        if ($dif->save()) {
            return $dif;
        }
        
    }

    public function destroy($id)
    {
        $dif = Difficulty::findOrFail($id);
        
        if ($dif->delete()) {
            return $dif;
        }
    }
}
