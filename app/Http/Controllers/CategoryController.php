<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\{Blog, Category, Language};
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        if (isset($request->id)) {
            Cookie::queue('id_lang', $request->id, 1);
        }

        $data = $this->Check();

        $data["language"] = Language::all();
        return view("backend.categories.categories", $data);
    }

    protected function Check()
    {
        if (Cookie::get('id_lang')) {
            $data["category"] = array();
            $data["tmp"] = Language::find(Cookie::get('id_lang'))->name;
            $data["category"] = Category::where('language_id', Cookie::get('id_lang'))->get();
            $data["category_cha"] = Category::where([['language_id', Cookie::get('id_lang')], ['parent_id', null]])->get();
            Cookie::queue(Cookie::forget('id_lang'));
        } else {
            $data["tmp"] = "";
            $data["category"] = array();
            $data["category"] = Category::all();
            $data["category_cha"] = Category::where('parent_id', null)->get();
        }
        return $data;
    }

    public function Add_Category(CategoryRequest $request)
    {
        try {
            Cookie::queue('id_lang', $request->language_id, 1);
            Category::create($request->all());
            return back()->with('success', 'Thêm loại thành công');
        } catch (\Throwable $th) {
            return redirect('danh-sach-the-loai')->with('error', 'Thêm thất bại');
        }
    }

    public function Update_Category(Request $request)
    {
        try {
            Cookie::queue('id_lang', $request->language_id, 1);
            $category = Category::find($request->id)->update($request->all());
            return redirect('danh-sach-the-loai')->with('successS', 'Sửa loại thành công');
        } catch (\Throwable $th) {
            return redirect('danh-sach-the-loai')->with('error', 'Sửa loại thất bại');
        }
    }

    public function deleteCategory($id)
    {
        try {
            $caregory = Category::find($id);
            $caregory->delete();
            $blog = Blog::where('category_id', $id)->delete();
            return redirect('/danh-sach-the-loai')->with('successx', 'Xóa loại thành công');
        } catch (\Throwable $th) {
            return redirect('danh-sach-the-loai')->with('error', 'Xóa thất bại');
        }
    }

    public function delete(Request $request)
    {
        foreach ($request->id as $id) {
            $caregory = Category::find($id);
            $caregory->delete();
            $blog = Blog::where('category_id', $id)->delete();
        }
        return response()->json($request->id);
    }

    public function slug(Request $request)
    {
        $data = Str::slug($this->utf8convert($request->category));
        return response()->json($data, 200);
    }

    public function utf8convert($str)
    {

        if (!$str) return false;

        $utf8 = array(

            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'd' => 'đ|Đ',

            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'i' => 'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',

            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach ($utf8 as $ascii => $uni) $str = preg_replace("/($uni)/i", $ascii, $str);

        return $str;
    }
}
