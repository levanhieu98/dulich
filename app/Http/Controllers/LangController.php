<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{
    public function changeLang(Request $request, $lang)
    {
        if (in_array($lang, ['en', 'vi'])) {
            $request->session()->put(['lang' => $lang]);
            App::setLocale($lang);
            return redirect()->back();
        }
    }
}
