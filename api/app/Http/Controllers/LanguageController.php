<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        return Language::get();
    }

    public function show($id)
    {
        return Language::findOrFail($id);
    }

     public function store(Request $request)
    {
        $language = new Language;
        $language->title = $request->input('title');
        $language->save();
    }
}
