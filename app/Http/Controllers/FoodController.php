<?php

namespace App\Http\Controllers;

use App\Helpers\AlbumUpload;
use App\Helpers\UploadFile;
use App\Models\album_food;
use App\Models\food;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;

class FoodController extends Controller
{
    public function food(Request $request)
    {
        if (isset($request->id)) {
            Cookie::queue('id_lang', $request->id, 1);
        }
        $data = $this->Check();
        $data["language"] = Language::all();
        // $food=food::all();
        return view('backend.food.listfood',$data);
    }

    protected function Check()
    {   
        
        if (Cookie::get('id_lang')) {
            $data["tmp"] = Language::find(Cookie::get('id_lang'))->name;
            $data["food"] = food::where('language_id', Cookie::get('id_lang'))->get();
            Cookie::queue(Cookie::forget('id_lang'));
        } else {
            $data["tmp"] = "";
            $data["food"] = array();
            $data["food"] = food::all();
        }
        return $data;
    }
   

    public function form_food()
    {
        $data['languages']=Language::all();
        return view('backend.food.addfood',$data);
    }

    public function add_food(Request $request)
    {
        $fd=new food();
        $fd->name=$request->name;
        $fd->description=$request->description;
        $fd->address=$request->address;
        $fd->slug=Str::slug($request->name);
        $fd->language_id=$request->language_id;
        if($request->hasFile('image'))
		{
			$hinh=($request->file('image'));
            $fd->banner=UploadFile::uploadImg($hinh,'img');
        }
        $fd->save();
        if ($request->hasFile('avatar')) {
            foreach($request->file('avatar') as $value)
            {
                $fd_img=new album_food();
                $fd_img->food_id=$fd->id;
                $fd_img->album=AlbumUpload::uploadImg('img',$value);
                $fd_img->save();
            } 
        }
        return back()->with('success','Thêm thành công');
    }

    public function update_food($id)
    {
    
        $data['food']=$id=$fd=food::where('slug',$id)->first();
        $data['img']=album_food::where('food_id',$id->id)->get();
        $data['languages']=Language::all();
        return view ('backend.food.editfood',$data); 
    }

    public  function get_update_food(Request $request,$id)
    {

        $fd=food::find($id);
        $fd->name=$request->name;
        $fd->description=$request->description;
        $fd->address=$request->address;
        $img = $fd->banner;
        $fd->slug=Str::slug($request->name);
        $fd->language_id=$request->language_id;
        if ($request->hasFile('image')) {
            // $patholdfile = './img_tour/'.$img;
            $hinh=$request->file('image');
            // $filename=$hinh->getClientOriginalName(); 
            // $ten=str::random(4)."_". $filename; 
            // $img_resize=Image::make( $hinh->getRealPath());
            // $img_resize ->resize(360, 225);
            // File::delete($patholdfile);
            // $img_resize ->save(public_path("img_tour/".$ten));
            UploadFile::destroyFile($img,'img');
            $fd->banner=UploadFile::uploadImg($hinh,'img');
        }
        else
        {
            $fd->banner=$img;
        }
        $fd->save();

        if ($request->hasFile('avatar')) 
        {
            $img=album_food::where('food_id',$id)->get();
            foreach($img as $image)
            {
               AlbumUpload::destroyFile('img',$image->album);
            }
           album_food::where('food_id',$id)->delete();
            foreach($request->file('avatar') as $value)
            {
                // $filename = str::random(4) . "_" . $value->getClientOriginalName();
                // $img_resize=Image::make($value->getRealPath());
                // $img_resize ->resize(750,390);
                // $img_resize ->save(public_path("img_tour/".$filename));
                $imgg=new album_food();
                $imgg->food_id=$fd->id;
                $imgg->album=AlbumUpload::uploadImg('img',$value);
                $imgg->save();
            }
        }
        Cookie::queue('id_lang', $request->language_id, 1);
        return redirect('/food')->with('Sua','Sửa thành công');
    }

    public function delete_food($id)
    {
        $t = food::find($id);
        $imgs = $t->banner;
       UploadFile::destroyFile($imgs,'img');
       $t->delete();
        $img=album_food::where('food_id',$id)->get();
        foreach($img as $image)
        {
           AlbumUpload::destroyFile('img',$image->album);
        }
        album_food::where('food_id',$id)->delete();
        return back()->with('successx', 'Xóa thành công');
    }

    public function delete(Request $request)
    {
        foreach($request->id as $id)
        {
            $t = food::find($id);
            $imgs = $t->banner;
            UploadFile::destroyFile($imgs,'img');
            $t->delete();
            $img=album_food::where('food_id',$id)->get();
            foreach($img as $image)
            {
                AlbumUpload::destroyFile('img',$image->album);
            }
            album_food::where('food_id',$id)->delete();
        }
        return response()->json('ok',200);
    }

    public  function checkfood(Request $request)
    {
        $data=food::where('name',$request->name)->count();
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
