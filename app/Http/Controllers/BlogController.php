<?php

namespace App\Http\Controllers;

use App\Helpers\UploadFile;
use App\Http\Requests\Blogs\AddBlogRequest;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\{Tag, Blog, Blog_tag, Category, Language, PublishBlog};
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Image;
class BlogController extends Controller
{
    public function index(Request $request)
    {
       
        if (isset($request->id)) {
            Cookie::queue('id_lang', $request->id, 1);
        }
        $data = $this->Check();
        $data["language"] = Language::all();
        return view('backend.blog.index', $data);
    }

    protected function Check()
    {   
        if(Auth::id() == 1) $blog = Blog::where('id','!=',0);
        else $blog = Blog::where('author_id',Auth::id());
        if (Cookie::get('id_lang')) {
            $data["tmp"] = Language::find(Cookie::get('id_lang'))->name;
            $data["blogs"] = $blog->where('language_id', Cookie::get('id_lang'))->get();
            Cookie::queue(Cookie::forget('id_lang'));
        } else {
            $data["tmp"] = "";
            $data["blogs"] = array();
            $data["blogs"] = $blog->get();
        }
        return $data;
    }
    protected function Check_publish()
    {
        if (Cookie::get('id_lang')) {
            $data["tmp"] = Language::find(Cookie::get('id_lang'))->name;
            $data["blogs"] = Blog::where([['language_id', Cookie::get('id_lang')], ['publish_on', null]])->get();
            Cookie::queue(Cookie::forget('id_lang'));
        } else {
            $data["tmp"] = "vi";
            $data["blogs"] = array();
            $id_language = Language::where('iso', 'vi');
            if ($id_language->count() != 0) {
                $id_language = Language::where('iso', 'vi')->first()->id;
                $data["blogs"] = Blog::where([['language_id', $id_language], ['publish_on', null]])->get();
            }
        }
        return $data;
    }
    public function create(Request $request)
    {
        if (isset($request->id)) {
            Cookie::queue('id_lang', $request->id, 1);
        }
        $data = $this->Check_Blog_Add();
        $data["languages"] = Language::all();
        $data["category_cha"]=Category::where([['language_id',Language::all()->reverse()->first()->id],['parent_id',null]])->get();
       
        return view('backend.blog.create', $data);
    }

    public function get_Data_Category_Cha_By_Language(Request $request){
        $category = Category::where([['language_id', $request->id],['parent_id',null]])->get();
        return response($category);
    }

    public function add_category_ajax(CategoryRequest $request){
        Category::create($request->all());
        return response($request);
    }

    public function ajax_Get_Data_Category_By_Language(Request $request){
        $id_parent = Category::where('language_id', $request->id)->get();
        foreach ($id_parent as $key => $idparent) {
            if ($idparent->parent_id == null) {
                if(Category::where('parent_id',$idparent->id)->count() != 0) unset($id_parent[$key]);
            }
        }
        $category = $id_parent;
        $category['length'] = $id_parent->count();
        return response($category);
    }

    public function ajax_Get_Data_Tag_By_Language(Request $request){
        $tags = Tag::where('language_id', $request->id)->get();
        return response($tags);
    }

    protected function Check_Blog_Add()
    {
        if (Cookie::get('id_lang')) {
            $data["categories"] = array();
            $data["tags"] = array();
            $data["tmp"] = Language::find(Cookie::get('id_lang'))->name;
            $data["tags"] = Tag::where('language_id', Cookie::get('id_lang'))->get();
            $id_parent = Category::where('language_id', Cookie::get('id_lang'))->get();
            foreach ($id_parent as $idparent) {
                if ($idparent->parent_id != null) {
                    $data["categories"] = Category::where([['language_id', Cookie::get('id_lang')], ['parent_id', '!=', null]])->get();
                } else {
                    $data["categories"] = Category::where('language_id', Cookie::get('id_lang'))->get();
                }
            }
            Cookie::queue(Cookie::forget('id_lang'));
        } else {
            $data["tmp"] = "vi";
            $data["categories"] = array();
            $data["tags"] = array();
            $id_language = Language::where('iso', 'vi');
            if ($id_language->count() != 0) {
                $id_language = Language::where('iso', 'vi')->first()->id;
                $data["tags"] = Tag::where('language_id', $id_language)->get();
                $id_parent = Category::where('language_id', $id_language)->get();
                foreach ($id_parent as $key => $idparent) {
                    if ($idparent->parent_id == null) {
                        if(Category::where('parent_id',$idparent->id)->count() != 0) unset($id_parent[$key]);
                    }
                }
                $data["categories"] = $id_parent;
            }
        }
        return $data;
    }

    public function test() {
        $openPublish = PublishBlog::where('published_at', '<=', \Carbon\Carbon::now('Asia/Ho_Chi_Minh'))->get();
            if($openPublish->count() > 0) {
               $blogs =  Blog::whereIn('id', $openPublish->pluck('blog_id'))->get();
               foreach($blogs as $blog) {
                    $blog->publish_on =  true;
                    $blog->save();
               }
               $openPublish->each->delete();
            }
    }
    public function store(AddBlogRequest $request)
    {
        $blog = new Blog;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->content = $request->content;
        $blog->category_id  = $request->category_id;
        $blog->author_id =  Auth::user()->id;
        $blog->language_id = $request->language_id;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $blog->image =UploadFile::uploadImg($file,'img');   
        } else {
            $blog->image = config('user.img_daidien');
        }
        $blog->save();
        if(!empty($request->checked_publish && $request->time_publish)) {
            $publish = new PublishBlog;
            $publish->blog_id =  $blog->id;
            $publish->published_at = $request->time_publish;
            $publish->save();
        }
        else {
            $blog->publish_on =  1;
            $blog->save();
        }
        if (!empty($request->tags)) {
            foreach ($request->tags as $tag) {
                $blog_tag = new Blog_tag();
                $blog_tag->blog_id = $blog->id;
                $blog_tag->tag_id = $tag;
                $blog_tag->save();
            }
        }

        return back()->with('success', 'Thêm bài viết thành công');
    }

    public function ViewEditBlog($id)
    {
        $data = $this->dataViewEditBlog($id);
        return view('backend.blog.edit', $data);
    }

    protected function checkViewEditBlog($blog){
        if (Cookie::get('id_lang')) $l = Language::find(Cookie::get('id_lang'));
        else $l = Language::find($blog->language_id);
        Cookie::queue(Cookie::forget('id_lang'));
        return $l;
    }

    protected function dataViewEditBlog($id){
        $data["blog"] = $blog = Blog::find($id);
        $data["publish_blog"] = $blog->publish_blog;
        $data["id_languages"] = $l = $this->checkViewEditBlog($blog);
        $id_parent = Category::where('language_id',$l->id)->get();
        foreach ($id_parent as $key => $idparent) {
            if ($idparent->parent_id == null) {
                if(Category::where('parent_id',$idparent->id)->count() != 0) unset($id_parent[$key]);
            }
        }
        $data["categories"] = $id_parent;
        $data["tags"] = Tag::where('language_id',$l->id)->get();
        $data["languages"]  = Language::all();
        $data["id_category"] = Category::find($blog->category_id);
        $data["id_tag"] = Blog_tag::where('blog_id', $blog->id)->get();
        $data["category_cha"]=Category::where([['language_id',Language::all()->reverse()->first()->id],['parent_id',null]])->get();
        return $data;
    }

    public function EditBlog(Request $request)
    {
        $blog = Blog::find($request->id_blog);
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->content = $request->content;
        $blog->category_id  = $request->category_id;
        $blog->author_id =  Auth::user()->id;
        $blog->language_id = $request->language_id;
        $img = $blog->image;
        if( empty($request->checked_publish && $blog->publish_on )) {
            $blog->publish_on = 1;
            $pb = PublishBlog::where('blog_id', $request->id_blog)->first();
            if(!empty($pb)) {
                $pb->delete();
            }
        }
        if(!empty($request->checked_publish && $request->time_publish)) {
            $publish = PublishBlog::where('blog_id', $request->id_blog)->first();
            if($publish) {
                $publish->published_at = $request->time_publish;
                $publish->save();
            }
            else {
                $blog->publish_on = 0;
                $publishNew = new PublishBlog;
                $publishNew->blog_id =  $request->id_blog;
                $publishNew->published_at = $request->time_publish;
                $publishNew->save();
            }
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            UploadFile::destroyFile( $img,'img');
            $blog->image =UploadFile::uploadImg($file,'img');
            
        }
        $blog->save();
        Blog_tag::where('blog_id', $blog->id)->delete();
        if ($request->tags != "") {
            foreach ($request->tags as $tag) {
                $blog_tag = new Blog_tag();
                $blog_tag->blog_id = $blog->id;
                $blog_tag->tag_id = $tag;
                $blog_tag->save();
            }
        }
        Cookie::queue('id_lang', $request->language_id, 1);
        return redirect('/blogs')->with('successS', 'Sửa bài viết thành công');
    }

    public function DeleteBlog($id)
    {
        $blog = Blog::find($id);
        $img = $blog->image;
        if($img==config('user.img_daidien'))
        {
            $blog->delete();
        }
        else
        {
            UploadFile::destroyFile($img,'img');
            $blog->delete();
        }
        Cookie::queue('id_lang',  $blog->language_id, 1);
        return redirect('/blogs')->with('successx', 'Xóa bài viết thành công');
    }

    public  function Delete(Request $request)
    {
        foreach($request->id as $id)
        {
            $blog = Blog::find($id);
            $img = $blog->image;
        if($img==config('user.img_daidien'))
        {
            $blog->delete();
        }
        else
        {
            UploadFile::destroyFile($img,'img');
            $blog->delete();
        }
        Cookie::queue('id_lang',  $blog->language_id, 1);
        }
        
        return response()->json($request->id,200);
    }  
    
    public function PageBlogReview(Request $request)
    {
        if (isset($request->id)) {
            Cookie::queue('id_lang', $request->id, 1);
        }
        $data = $this->Check_publish();
        $data["language"] = Language::all();
        return view('backend.blog.review', $data);
    }

    public function DetailBlogReview($id)
    {
        $data["blog"] = Blog::where('id', $id)->first();
        return view('backend.blog.detail-blog-review', $data);
    }

    public function DPageBlogReview(Request $request)
    {
        foreach($request->id as $id)
        {
            $blog = Blog::find($id);
            $img = $blog->image;
            if($img==config('user.img_daidien'))
            {
                $blog->delete();
            }
            else
            {
                UploadFile::destroyFile($img,'img');
                $blog->delete();
            }
            Cookie::queue('id_lang',  $blog->language_id, 1);

        }
        return response()->json($request->id);
    }
    public function BlogReview($id)
    {

        Blog::find($id)->update(["publish_on" => Auth::user()->id]);
        return redirect('/danh-sach-bai-viet-chua-duyet')->with('successD', 'Thành công duyệt');
    }
}