<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\contact;
use App\Models\Hotel;
use App\Models\restaurant;
use App\Models\Tourist;
use Carbon\Carbon;
use Illuminate\Http\Request;


class AdminController extends Controller
{

    public function index(){
      
      
        $data['blog_today']=Blog::all()->count();
        $data['blog_review']=Blog::where('publish_on',null)->count();
        $data['contact']=contact::all()->count();
        $data['tourist']=Tourist::all()->count();
        $data['hotel']=Hotel::all()->count();
        $data['restaurant']=restaurant::all()->count(); 
        return view('backend.dashboard',$data);
    }

    public function show()
    {
        $data['tourist']=0;
        $data['contact']=0;
        $data['blog_today']=Blog::all()->count();
        $data['blog_review']=Blog::where('publish_on',null)->count();
        $ct=contact::select('created_at')->get();
        $t=Tourist::select('created_at')->get();
        foreach($ct as $c)
        {
           
            if($c->created_at->toDateString()==Carbon::now('Asia/Ho_Chi_Minh')->toDateString())
            {
                $data['contact']++;
            }
         
        }
        foreach($t as $c)
        {
           
            if($c->created_at->toDateString()==Carbon::now('Asia/Ho_Chi_Minh')->toDateString())
            {
                $data['tourist']++;
            }
         
        }
        $data['hotel']=Hotel::all()->count();
        $data['restaurant']=restaurant::all()->count(); 
        return response()->json( $data);
    }

   
   
}