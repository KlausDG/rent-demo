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
        $genre = new Genre;
        $genre->title = $request->input('title');
        $genre->save();
    }
}
