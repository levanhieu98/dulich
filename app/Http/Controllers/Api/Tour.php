<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\tour_image;
use App\Models\Tourist;
use App\Models\travel_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Tour extends Controller
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
            if (!empty($language)) {
                $data = travel_list::where([['id', '>', 0], ['language_id', $language->id]]);
                if(!empty($request->orther_id)) {
                    $data->where('slug', '!=', $request->orther_id);
                } 
                if(!empty($request->type_of_tour_id)) { 

                    $data->where('type_of_tour_id', $request->type_of_tour_id);
                }
                $data->with([
                    'tour_image' => function($query) {
                        $query->select('tour_id', 'image');
                    }]);
                 $data = $data->paginate($limit);
                return response()->json($data, 200);
            } else {
                return response()->json(['data' => '404 Not found'], 404);
            }
        } catch (\Throwable $th) {
            $data = "Server 500 error";
            return response()->json(['data' => $data], 500);
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
        try {
            $data = new Tourist();
            $data->start = $request->start;
            $data->start_day = $request->start_day;
            $data->date_time = $request->date_time;
            $data->adults = $request->adults;
            $data->children = $request->children;
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->email = $request->email;
            $data->save();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json('Server 500 error', 500);
        }
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
            $data = travel_list::where('slug', $id)->with([
                'tour_image' => function($query) {
                    $query->select('tour_id', 'image');
            }])->first();
            if (empty($data)) {
                return response()->json(["data" => '404 Not found'], 404);
            }
            return response()->json(["data" => $data], 200);
        } catch (\Throwable $th) {
            return response()->json(["data" => $th], 500);
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
