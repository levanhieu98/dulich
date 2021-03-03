<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\restaurant;
use Illuminate\Http\Request;

class Restaurants extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $iso=$request->lang?$request->lang:config('user.language_default');
            $language = Language::where('iso', $iso)->first();
            if($language != null)
            {
                $domain = request()->root();
            $limit = $request->limit ? $request->limit : config('user.page_limit');
            $data=restaurant::where('language_id',$language->id)->paginate($limit);
            foreach($data as $imgs)
            {
                foreach ($imgs->album as $i) {
                    $i->album = $domain . '/img/album/' . $i->album;
                }
            }
            return response()->json($data,200);
            }
            else
            {
                $data="404 Not found";
                return response()->json(['data'=>$data],200);
            }
        } catch (\Throwable $th) {
            $data="Server 500 error";
            return response()->json(['data'=>$data],200);
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
    public function show($id)
    {   
        try {
            $domain = request()->root();
            $data=restaurant::where('slug',$id)->first();
            if($data != null)
            {
                foreach ($data->album as $i) {
                    $i->album = $domain . '/img/album/' . $i->album;
                }
                return response()->json(["data"=>$data],200);
            }
            else
            {
                $data="404 Not found";
                return response()->json(["data"=>$data],200);
            }
        } catch (\Throwable $th) {
                $data="Server 500 error";
                return response()->json(["data"=>$data],500);
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
