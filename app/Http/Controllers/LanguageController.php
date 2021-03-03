<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Http\Requests\Language\LanguageRequest;
use App\Http\Requests\Language\UpdateLanguageRequest;

class LanguageController extends Controller
{
    public function index(){
        $data["language"] = Language::all();
        return view("backend.language.language", $data);
    }

    public function Add_Language(LanguageRequest $request){
        $language = Language::create($request->all());
        return response($language);
    }

    public function Edit_Language(UpdateLanguageRequest $request){
        $language = Language::find($request->id)->update($request->all());
        return response($request->all());
    }
    
    public function Delete_Language(Request $request){
        Language::find($request->id)->delete();
        return response($request->all());
    }
}