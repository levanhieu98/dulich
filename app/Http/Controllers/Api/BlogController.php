<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogCollection;
use App\Models\Blog_tag;
use App\Models\Tag;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $limit = $request->limit ? $request->limit : config('user.page_limit');
            $iso = $request->lang ? $request->lang : config('user.language_default');
            $language =  Language::where('iso', $iso)->first();
            if ($language != null) {
                if ($request->id_category != '') {
                    $data = DB::table('blogs')
                        ->join('categories', 'blogs.category_id', '=', 'categories.id')
                        ->join('languages', 'languages.id', '=', 'blogs.language_id')
                        ->select('blogs.*', 'categories.name as category', 'languages.name as lang')
                        ->where('blogs.language_id', $language->id)->where('blogs.category_id', $request->id_category)
                        ->where('blogs.publish_on', '!=', null)->orderBy('blogs.created_at', 'desc')
                        ->count();
                    if ($data > 0) {
                        $data = DB::table('blogs')
                            ->join('categories', 'blogs.category_id', '=', 'categories.id')
                            ->join('languages', 'languages.id', '=', 'blogs.language_id')
                            ->select('blogs.*', 'categories.name as category', 'languages.name as lang')
                            ->where('blogs.language_id', $language->id)->where('blogs.category_id', $request->id_category)
                            ->where('blogs.publish_on', '!=', null)->orderBy('blogs.created_at', 'desc')
                            ->paginate($limit);
                    } else {
                        $data = "404 Not found";
                        return response()->json(["data" => $data], 404);
                    }
                } else {
                    $data = DB::table('blogs')
                        ->join('categories', 'blogs.category_id', '=', 'categories.id')
                        ->join('languages', 'languages.id', '=', 'blogs.language_id')
                        ->select('blogs.*', 'categories.name as category', 'languages.name as lang')
                        ->where('blogs.language_id', $language->id)->where('blogs.publish_on', '!=', null)
                        ->orderBy('blogs.created_at', 'desc')
                        ->paginate($limit);
                }
                $domain = request()->root();
                foreach ($data as $i) {
                    $arr_tag = array();
                    $arr = array();
                    $tags = Blog_tag::where("blog_id", $i->id)->get();
                    foreach ($tags as $tmp) {
                        array_push($arr_tag, [
                            "id" => $tmp->tag_id,
                            "name" => Tag::find($tmp->tag_id)->name,
                        ]);
                    }
                    array_push($arr, ["original" => $domain . '/img/original/' . $i->image, "medium" => $domain . '/img/medium/' . $i->image,]);
                    $i->image = $arr;
                    $i->tag = $arr_tag;
                }
                return response()->json($data, 200);
            } else {
                $data = "404 Not found";
                return response()->json(["data" => $data], 404);
            }
        } catch (\Throwable $th) {
            $data = "Server 500 error";
            return response()->json(["data" => $data], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $data = Blog::where('slug', $slug)->first();
            
            if ($data != null) {
                $domain = request()->root();
                $arr_tag = array();
                $arr = array();
                $tags = Blog_tag::where("blog_id", $data->id)->get();
                foreach ($tags as $tmp) {
                    array_push($arr_tag, [
                        "id" => $tmp->tag_id,
                        "name" => Tag::find($tmp->tag_id)->name,
                    ]);
                }
                array_push($arr, ["original" => $domain . '/img/original/' . $data->image, "medium" => $domain . '/img/medium/' . $data->image,]);
                $data->image = $arr;
                $data->tag = $arr_tag;
                $data->category=$data->category;
                return response()->json(["data" => $data], 200);
            } else {
                $data = "404 Not found";
                return response()->json(["data" => $data], 404);
            }
        } catch (\Throwable $th) {
            $data = "Server 500 error";
            return response()->json(["data" => $data], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
