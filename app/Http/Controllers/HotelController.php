<?php

namespace App\Http\Controllers;

use App\Helpers\AlbumUpload;
use App\Helpers\UploadFile;
use App\Models\album_hotel;
use App\Models\Hotel;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;

class HotelController extends Controller
{
    public function hotel(Request $request)
    {
        if (isset($request->id)) {
            Cookie::queue('id_lang', $request->id, 1);
        }
        $data = $this->Check();
        $data["language"] = Language::all();
        // $hotel=Hotel::all();
        return view('backend.hotel.hotel',$data);
    }

    protected function Check()
    {   
        
        if (Cookie::get('id_lang')) {
            $data["tmp"] = Language::find(Cookie::get('id_lang'))->name;
            $data["hotel"] = Hotel::where('language_id', Cookie::get('id_lang'))->get();
            Cookie::queue(Cookie::forget('id_lang'));
        } else {
            $data["tmp"] = "";
            $data["hotel"] = array();
            $data["hotel"] = Hotel::all();
        }
        return $data;
    }

    public  function form_hotel()
    {
        $data['languages']=Language::all();
        return view('backend.hotel.formhotel',$data);
    }

    public function add_hotel(Request $request)
    {
        $ht=new Hotel();
        $ht->name=$request->name;
        $ht->description=$request->description;
        $ht->address=$request->address;
        $ht->rating=$request->rate;
        $ht->slug=Str::slug($request->name);
        $ht->language_id=$request->language_id;
        if($request->hasFile('image'))
		{
			$hinh=($request->file('image'));
            // $filename=$hinh->getClientOriginalName(); 
            // $ten=str::random(4)."_". $filename; 
            // $img_resize=Image::make( $hinh->getRealPath());
            // $img_resize ->resize(360, 225);
            // $img_resize ->save(public_path("img_tour/".$ten));
            $ht->banner=UploadFile::uploadImg($hinh,'img');
        }
        $ht->save();
        if ($request->hasFile('avatar')) {
            foreach($request->file('avatar') as $value)
            {
                // $filename = str::random(4) . "_" . $value->getClientOriginalName();
                // $img_resize=Image::make($value->getRealPath());
                // $img_resize ->resize(750,390);
                // $img_resize ->save(public_path("img_tour/".$filename));
                $ht_img=new album_hotel();
                $ht_img->hotel_id=$ht->id;
                $ht_img->album=AlbumUpload::uploadImg('img',$value);
                $ht_img->save();
            } 
        }
        return back()->with('success','Thêm thành công');
    }

    public function update_hotel($id)
    {
        $data['hotel']=$id=Hotel::where('slug',$id)->first();
        $data['hotels']=Hotel::all();
        $data['languages']=Language::all();
        $data['album']=album_hotel::where('hotel_id',$id->id)->get();
        return view ('backend.hotel.edithotel',$data);

    }

    public function get_update_hotel(Request $request,$id)
    {
        $ht=Hotel::find($id);
        $ht->name=$request->name;
        $ht->description=$request->description;
        $ht->address=$request->address;
        $ht->rating=$request->rate;
        $ht->slug=Str::slug($request->name);
        $ht->language_id=$request->language_id;
        $img = $ht->banner;
        if ($request->hasFile('image')) {
            $hinh=$request->file('image');
            UploadFile::destroyFile( $img,'img');
            $ht->banner=UploadFile::uploadImg($hinh,'img');
        }
        else
        {
            $ht->banner=$img;
        }
        $ht->save();
        if ($request->hasFile('avatar')) 
        {
            $img=album_hotel::where('hotel_id',$id)->get();
            foreach($img as $image)
            {
                AlbumUpload::destroyFile('img',$image->album);
            }
           album_hotel::where('hotel_id',$id)->delete();
            foreach($request->file('avatar') as $value)
            {
                $imgg=new album_hotel();
                $imgg->hotel_id=$ht->id;
                $imgg->album=AlbumUpload::uploadImg('img',$value);
                $imgg->save();
            }
        }
        Cookie::queue('id_lang', $request->language_id, 1);
        return redirect('/hotel')->with('Sua','Sửa thành công');
    }

    public function delete_hotel($id)
    {
        $t = Hotel::find($id);
        $imgs = $t->banner;
        UploadFile::destroyFile($imgs,'img');
        $t->delete();
        $img=album_hotel::where('hotel_id',$id)->get();
        foreach($img as $image)
        {
            AlbumUpload::destroyFile('img',$image->album);
        }
        album_hotel::where('hotel_id',$id)->delete();
        return back()->with('successx', 'Xóa thành công');
    }

    public  function delete(Request $request)
    {
        foreach($request->id as $id)
        {
            $t = Hotel::find($id);
            $imgs = $t->banner;
            UploadFile::destroyFile($imgs,'img');
            $t->delete();
            $img=album_hotel::where('hotel_id',$id)->get();
            foreach($img as $image)
            {
                AlbumUpload::destroyFile('img',$image->album);
            }
            album_hotel::where('hotel_id',$id)->delete();
        }
        return response()->json('ok',200);
    }

    public function checkhotel(Request $request)
    {
        $data=Hotel::where('name',$request->name)->count();
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
