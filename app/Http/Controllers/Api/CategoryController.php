<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $iso = $request->lang ? $request->lang : config('user.language_default');
            $language = Language::where('iso', $iso)->first();
            if(!empty($language))
                {
                    $data = Category::where('language_id', $language->id);
                    $data = $data->withCount(['blogs as count_blog'=> function ($query) {
                        $query->where('publish_on', 1);
                    }])->get();
                    return response()->json(["data"=>$data], 200);
                }
            else
            {
                $data1="404 Not found";
                return response()->json(["data"=>$data1], 404);
            }
        } catch (\Throwable $th) {
            $data1="Server 500 error";
            return response()->json(["data"=>$data1], 500);
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
    public function show(Request $request)
    {
        // $iso = $request->lang ? $request->lang : config('user.language_default');
        // $language = Language::where('name', $iso)->first();
        // $data = Category::where('parent_id', '!=', null)->where([['language_id', $language->id], ['parent_id', $request->id]])->get();
        // return response()->json($data, 200);
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
