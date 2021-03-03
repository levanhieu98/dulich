<?php

namespace App\Http\Controllers;

use App\Helpers\UploadFile;
use App\Models\Language;
use App\Models\MapPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class MapPlaceController extends Controller
{

    public function destroy(Request $rq)
    {
        try {
            $map = MapPlace::find($rq->id);
            $map->delete();
            UploadFile::destroyFile($map->image, 'img');
            return response()->json($rq->id, 200);
        } catch (\Throwable $th) {
            return response()->json('fail', 500);
        }
    }
    public function add(Request $rq)
    {
        try {

            $place = new MapPlace();
            $place->title = $rq->title;
            $place->map_id = $rq->map_id;
            $place->url = $rq->url;
            $place->language_id = $rq->language_id;
            if ($rq->hasFile('image')) {
                $hinh = ($rq->file('image'));
                $place->image = UploadFile::uploadImg($hinh, 'img');
            }
            $place->save();
            
            return response()->json($place, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $place = MapPlace::find($request->id);
            $place->title = $request->title;
            $place->map_id = $request->map_id;
            $place->url = $request->url;
            $place->language_id = $request->language_id;
            $img = $place->image;
            if ($request->hasFile('image')) 
            {
                $hinh = ($request->file('image'));
                UploadFile::destroyFile($img, 'img');
                $place->image = UploadFile::uploadImg($hinh, 'img');
            }
            $place->save();
            return response()->json($place, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
