<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        return Genre::get();
    }

    public function show($id)
    {
        return Genre::findOrFail($id);
    }

    public function store(Request $request)
    {
        $genre = $request->isMethod('put') ? Genre::findOrFail($request->id) : new Genre;
        $genre->title = $request->input('title');

        if ($genre->save()) {
            return $genre;
        }

    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);

        if ($genre->delete()) {
            return $genre;
        }
    }
}
