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
        $language = $request->isMethod('put') ? Language::findOrFail($request->id) : new Language;
        $language->title = $request->input('title');
        
        if ($language->save()) {
            return $language;
        }
        
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);

        if ($language->delete()) {
            return $language;
        }
    }
}
