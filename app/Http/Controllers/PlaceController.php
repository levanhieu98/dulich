<?php

namespace App\Http\Controllers;

use App\Helpers\AlbumUpload;
use App\Helpers\UploadFile;
use App\Http\Controllers\Api\Places;
use App\Models\album_place;
use App\Models\Language;
use App\Models\place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;

class PlaceController extends Controller
{
    public function place(Request $request)
    {
        if (isset($request->id)) {
            Cookie::queue('id_lang', $request->id, 1);
        }
        $data = $this->Check();
        $data["language"] = Language::all();
        // $place=place::all();
        return view('backend.place.place',$data);
    }

    protected function Check()
    {   
        
        if (Cookie::get('id_lang')) {
            $data["tmp"] = Language::find(Cookie::get('id_lang'))->name;
            $data["place"] = place::where('language_id', Cookie::get('id_lang'))->get();
            Cookie::queue(Cookie::forget('id_lang'));
        } else {
            $data["tmp"] = "";
            $data["place"] = array();
            $data["place"] = place::all();
        }
        return $data;
    }

    public function form_place()
    {
        $data['languages']=Language::all();
        return view('backend.place.formplace',$data);
    }

    public function add_place(Request $request)
    {
        $pl=new place();
        $pl->name=$request->name;
        $pl->description=$request->description;
        $pl->address=$request->address;
        $pl->slug=Str::slug($request->name);
        $pl->language_id=$request->language_id;
        if($request->hasFile('image'))
		{
			$hinh=($request->file('image'));
            $pl->banner=UploadFile::uploadImg($hinh,'img');
        }
        $pl->save();
        if ($request->hasFile('avatar')) {
            foreach($request->file('avatar') as $value)
            {
                $ht_img=new album_place();
                $ht_img->place_id=$pl->id;
                $ht_img->album=AlbumUpload::uploadImg('img',$value);
                $ht_img->save();
            } 
        }
        return back()->with('success','Thêm thành công');
    }

    public function update_place($id)
    {
        $data['place']=$id=place::where('slug',$id)->first();
        $data['album']=album_place::where('place_id',$id->id)->get();
        $data['languages']=Language::all();
        return view ('backend.place.editplace',$data);
    }

    public function get_update_place(Request $request,$id)
    {
        $pl=place::find($id);
        $pl->name=$request->name;
        $pl->description=$request->description;
        $pl->address=$request->address;
        $pl->slug=Str::slug($request->name);
        $pl->language_id=$request->language_id;
        $img = $pl->banner;

        if ($request->hasFile('image')) {
            $hinh=$request->file('image');
            UploadFile::destroyFile($img,'img');
            $pl->banner=UploadFile::uploadImg($hinh,'img');
        }
        else
        {
            $pl->banner=$img;
        }
        $pl->save();

        if ($request->hasFile('avatar')) 
        {
            $img=album_place::where('place_id',$id)->get();
            foreach($img as $image)
            {
               AlbumUpload::destroyFile('img',$image->album);
            }
           album_place::where('place_id',$id)->delete();
            foreach($request->file('avatar') as $value)
            {
                $imgg=new album_place();
                $imgg->place_id=$pl->id;
                $imgg->album=AlbumUpload::uploadImg('img',$value);
                $imgg->save();
            }
        }
        Cookie::queue('id_lang', $request->language_id, 1);
        return redirect('/place')->with('Sua','Sửa thành công');
    }

    public function delete_place($id)
    {
        $t = place::find($id);
        $imgs = $t->banner;
       UploadFile::destroyFile($imgs,'img');
        $t->delete();
        $img=album_place::where('place_id',$id)->get();
        foreach($img as $image)
        {
            AlbumUpload::destroyFile('img',$image->album);
        }
        album_place::where('place_id',$id)->delete();
        return back()->with('successx', 'Xóa thành công');
    }

    public function delete(Request $request)
    {
        foreach($request->id as $id)
        {
            $t = place::find($id);
            $imgs = $t->banner;
            UploadFile::destroyFile($imgs,'img');
            $t->delete();
            $img=album_place::where('place_id',$id)->get();
            foreach($img as $image)
            {
                AlbumUpload::destroyFile('img',$image->album);
            }
            album_place::where('place_id',$id)->delete();
        }
        return response()->json('ok',200);
    }

    public function checkplace(Request $request)
    {
        $data=place::where('name',$request->name)->count();
        if($data>0)
        {
            return response()->json('<p style="color:red">Tên khách sạn đã tồn tại</p>');
        }
        else
        {
            return response()->json('true');
        }
    }
}
