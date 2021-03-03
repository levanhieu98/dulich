<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Map;
use Illuminate\Http\Request;

class Maps extends Controller
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
                $data = Map::where('language_id',$language->id)->paginate($limit);
                foreach ($data as $imgs) {
                    $imgs->place= $imgs->place;
                }
                return response()->json($data, 200);
            }
            else
            {
                $data="404 Not found";
                return response()->json(["data" => $data], 404);
            }
        } catch (\Throwable $th) {
            $data="Server 500 error";
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
    public function show($id)
    {
        //
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
