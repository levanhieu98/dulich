<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Map;
use App\Models\MapPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class MapController extends Controller
{
    public function index(Request $request)
    {

        if (isset($request->id)) {
            Cookie::queue('id_lang', $request->id, 1);
        }
        $data = $this->Check();
        $data["languages"] = Language::all();
        return view('backend.map.index', $data);
    }

    protected function Check()
    {

        if (Cookie::get('id_lang')) {
            $data["tmp"] = Language::find(Cookie::get('id_lang'))->name;
            $data["map"] = Map::where('language_id', Cookie::get('id_lang'))->get();
            Cookie::queue(Cookie::forget('id_lang'));
        } else {
            $data["tmp"] = "";
            $data["map"] = array();
            $data["map"] = Map::with('place')->get();
        }
        // dd($data);
        return $data;
    }

    public function update(Request $request, $id)
    {
        $map = Map::find($id);
        $map->description=$request->description;
        $map->language_id=$request->language_id;
        $map->title=$request->title;
        $map->save();
        $place=MapPlace::where('map_id',$id)->get();
        foreach($place as $p)
        {
            $p->language_id=$map->language_id;
            $p->save();
        }
        Cookie::queue('id_lang', $request->language_id, 1);
        return redirect('/map')->with('Sua','Sửa thành công');
    }

}
