<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\food;
use App\Models\Hotel;
use App\Models\place;
use App\Models\restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $domain = request()->root();
            $data['hotel']=$hotel=Hotel::orderByDesc('created_at')->take(5)->get();
    
            $data['restaurant']=$rs=restaurant::orderByDesc('created_at')->take(5)->get();
           
            $data['food']=$f=food::orderByDesc('created_at')->take(5)->get();
          
            $data['place']=$p=place::orderByDesc('created_at')->take(5)->get();
           
            return response()->json(['data'=>$data],200);
        } catch (\Throwable $th) {
            $data="Server 500 error ";
            return response()->json(['data'=>$data],500);
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
