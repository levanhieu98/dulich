<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests\Tag\TagRequest;
use App\Http\Requests\Tag\AddRequest;
use App\Models\{Tag,Language};
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
class TagController extends Controller
{
    public function index(Request $request){
        if (isset($request->id)) {
            Cookie::queue('id_lang', $request->id, 1);
        }
        $data = $this->Check2();
        $data["language"] = Language::all();
        return view("backend.tag.tag", $data);
    }
    protected function Check2()
    {
        if (Cookie::get('id_lang')) {
            $data["tmp"] = Language::find(Cookie::get('id_lang'))->name;
            $data["tags"] = Tag::where('language_id', Cookie::get('id_lang'))->get();
            Cookie::queue(Cookie::forget('id_lang'));
        } else {
            $data["tmp"] = "";
            $data["tags"] = array();
                $data["tags"] = Tag::all();
         
        }
        return $data;
    }
   
    public function add_Tag(AddRequest $request)
    {   
        Cookie::queue('id_lang', $request->language_id, 1);
        Tag::create($request->all());
        Cookie::queue('200','ok',0.20);
        return Response($request->all());
    }

    public function Edit_Tag(TagRequest $request){
        Cookie::queue('id_lang', $request->language_id, 1);
        $tag = Tag::find($request->id);
        $tag->name=$request->name;
        $tag->slug=$request->slug;
        $tag->save();
        Cookie::queue('201','ok',0.20);
        return Response($request->all());
    }

    public function Delete_Tag(Request $request){
       
        $tag = Tag::find($request->id)->delete();
        Cookie::queue('202','ok',0.20);
        return Response($request->all());
    }

    public function Delete(Request $request)
    {
        foreach($request->id as $id )
        {
             Tag::find($id)->delete();
            Cookie::queue('202','ok',0.20);
        }
        return response()->json('ok',200);
    }

    public function slug(Request $request)
    {   $data=Str::slug($this->utf8convert($request->category));
        return response()->json($data,200);
    }

    public function utf8convert($str) {
        
        if(!$str) return false;
        
        $utf8 = array(
        
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        
        'd'=>'đ|Đ',
        
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        
        'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
        
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        
                                        );
        
        foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
        
      return $str;
        
        }
}