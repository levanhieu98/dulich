<?php

namespace App\Http\Controllers;

use App\Helpers\AlbumUpload;
use App\Helpers\UploadFile;
use App\Models\album_restaurant;
use App\Models\Language;
use App\Models\restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;
class RestaurantController extends Controller
{
    public function restaurant(Request $request)
    {
        // $res=restaurant::all();
        if (isset($request->id)) {
            Cookie::queue('id_lang', $request->id, 1);
        }
        $data = $this->Check();
        $data["language"] = Language::all();
        return view("backend.restaurant.listrestaurant", $data);
    }

    protected function Check()
    {   
        
        if (Cookie::get('id_lang')) {
            $data["tmp"] = Language::find(Cookie::get('id_lang'))->name;
            $data["res"] = restaurant::where('language_id', Cookie::get('id_lang'))->get();
            Cookie::queue(Cookie::forget('id_lang'));
        } else {
            $data["tmp"] = "";
            $data["res"] = array();
            $data["res"] = restaurant::all();
        }
        return $data;
    }

    public function form_restaurant()
    {
        $data['languages']=Language::all();
        return view("backend.restaurant.formrestaurant",$data);
    }

    public function add_restaurant(Request $request)
    {
        $res=new restaurant();
        $res->name=$request->name;
        $res->description=$request->description;
        $res->address=$request->address;
        $res->time=$request->time .'-'.$request->time1;
        $res->slug=Str::slug($request->name);
        $res->rating=$request->rate;
        $res->language_id=$request->language_id;
        if($request->hasFile('image'))
		{
			$hinh=($request->file('image'));
            $res->banner=UploadFile::uploadImg($hinh,'img');
        }
         $res->save();
        if ($request->hasFile('avatar')) {
            foreach($request->file('avatar') as $value)
            {
                $res_img=new album_restaurant();
                $res_img->restaurant_id=$res->id;
                $res_img->album=AlbumUpload::uploadImg('img',$value);
                $res_img->save();
            }
           
        }
      
        return back()->with('success','Thêm thành công');
      
    }

    public function delete_restaurant($id)
    {
        $t = restaurant::find($id);
        $imgs = $t->banner;
        UploadFile::destroyFile($imgs,'img');
        $t->delete();
        $img=album_restaurant::where('restaurant_id',$id)->get();
        foreach($img as $image)
        {
           
            AlbumUpload::destroyFile('img',$image->album);
        }
        album_restaurant::where('restaurant_id',$id)->delete();
        return back()->with('successx', 'Xóa thành công');
    }

    public  function delete(Request $request)
    {
        foreach($request->id as $id)
        {
            $t = restaurant::find($id);
            $imgs = $t->banner;
            UploadFile::destroyFile($imgs,'img');
            $t->delete();
            $t->delete();
            $img=album_restaurant::where('restaurant_id',$id)->get();
            foreach($img as $image)
            {
                AlbumUpload::destroyFile('img',$image->album);
            }
            album_restaurant::where('restaurant_id',$id)->delete();
        }
        return response()->json("ok",200);
    }

    public function update_restaurant($id)
    {
        $res=$id=restaurant::where('slug',$id)->first();
        $languages=Language::all();
        $str=$res->time;
        $tmp=strpos($str,'-');
        $start=substr($str,0,$tmp);
        $end=substr($str,$tmp+1);
        $img=album_restaurant::where('restaurant_id',$id->id)->get();
        

        return view('backend.restaurant.editrestaurant',compact(['res','start','end','img','languages']));
    }

    public function get_update_restaurant( Request $request,$id)
    {

        $res=restaurant::find($id);
        $res->name=$request->name;
        $res->description=$request->description;
        $res->address=$request->address;
        $res->time=$request->time .'-'.$request->time1;
        $res->slug=Str::slug($request->name);
        $res->rating=$request->rate;
        $res->language_id=$request->language_id;
        $img = $res->banner;
        if ($request->hasFile('image')) {
            $hinh=$request->file('image');
            $res->banner=UploadFile::uploadImg($hinh,'img');
        }
        else
        {
            $res->banner=$img;
        }
        $res->save();

        if ($request->hasFile('avatar')) 
        {
            $img=album_restaurant::where('restaurant_id',$id)->get();
            foreach($img as $image)
            {
                $patholdfile = 'img_tour/'.$image->album;
                File::delete($patholdfile);
            }
            album_restaurant::where('restaurant_id',$id)->delete();
            foreach($request->file('avatar') as $value)
            {
                
                $imgg=new album_restaurant();
                $imgg->restaurant_id=$res->id;
                $imgg->album=AlbumUpload::uploadImg('img',$value);;
                $imgg->save();
            }
        }
       
        Cookie::queue('id_lang', $request->language_id, 1);
        return redirect('/restaurant')->with('Sua','Sửa thành công');
    }

    public function checkrestaurant(Request $request)
    {
        $data=restaurant::where('name',$request->name)->count();
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
