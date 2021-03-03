<?php

namespace App\Http\Controllers;

use App\Helpers\UploadFile;
use App\Models\Language;
use App\Models\Traveler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class TravelerController extends Controller
{
    public function touroperator(Request $request)
    {
        if (isset($request->id)) {
            Cookie::queue('id_lang', $request->id, 1);
        }
        $data = $this->Check();

        $data["language"] = Language::all();
        return view('backend.TourOperators.index',$data);
    }
    protected function Check()
    {
       
        if (Cookie::get('id_lang')) {
            $data["tmp"] = Language::find(Cookie::get('id_lang'))->name;
            $data["traveler"] = Traveler::where('language_id', Cookie::get('id_lang'))->get();
            Cookie::queue(Cookie::forget('id_lang'));
        } else {
            $data["tmp"] = "";
            $data["traveler"] = array();
             $data["traveler"] =Traveler::all();
                 
        }
        return $data;
    }

    public function form_touroperator()
    {
        $data['language']=Language::all();
        return view('backend.TourOperators.formadd',$data);
    }

    public function add_touroperator(Request $request)
    {
        try {
            $tr=new Traveler();
            $tr->name=$request->name;
            $tr->phone=$request->phone;
            $tr->email=$request->email;
            $tr->address=$request->address;
            $tr->links=$request->link;
            $tr->language_id=$request->language_id;
            if($request->hasFile('image'))
            {
                $hinh=($request->file('image'));
                $tr->images=UploadFile::uploadImg($hinh,'img');
            }
            $tr->save();
            return back()->with('success','Thêm thành công');
        } catch (\Throwable $th) {
           echo"asdasdasd";
        }
       
    }

    public function update_touroperator($id)
    {
        $data['traveler']=Traveler::find($id);
        $data['language']=Language::all();
        return view('backend.TourOperators.formedit',$data);
    }

    public function get_touroperator(Request $request,$id)
    {
        $tr=Traveler::find($id);
        $tr->name=$request->name;
        $tr->phone=$request->phone;
        $tr->email=$request->email;
        $tr->address=$request->address;
        $tr->links=$request->link;
        $tr->language_id=$request->language_id;
        $img=$tr->images;
        if($request->hasFile('image'))
            {
                $hinh=($request->file('image'));
                UploadFile::destroyFile('img', $img);
                $tr->images=UploadFile::uploadImg($hinh,'img');
            }
            $tr->save();
        Cookie::queue('id_lang', $request->language_id, 1);
        return redirect('/touroperator')->with('Sua','Sửa thành công');
    }

    public function delete_touroperator($id)
    {
        $t = Traveler::find($id);
        $imgs = $t->images;
        UploadFile::destroyFile($imgs,'img');
        $t->delete();
        return back()->with('successx', 'Xóa thành công');
    }

    public function delete(Request $request)
    {
        foreach($request->id as $id)
        {
            $t = Traveler::find($id);
            $imgs = $t->images;
            UploadFile::destroyFile($imgs,'img');
            $t->delete();
            Cookie::queue('id_lang', $t->language_id, 1);
        }
        return response()->json($request->id);
    }
}
