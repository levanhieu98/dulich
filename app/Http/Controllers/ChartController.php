<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\contact;
use App\Models\Tourist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function show()
    {
       $users = DB::table('users')
       ->where('name', '=', 'admin')
       ->orWhere(function ($query) {
           $query->where('id', '>', 0);
       })
       ->get();
    dd($users);

        $data['blog']=$this->blog();
        $data['tourist']=$this->tourist();
        $data['contact']=$this->contact();
        
       
        return view('backend.map.chart',$data);
    }

    protected function blog()
    {
        $blog=Blog::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count');
        $months=Blog::select(DB::raw("Month(created_at) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('month');
        $datas=array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month )
        {
            $datas[$month-1]=$blog[$index];
        }
        return $datas;
    }

    protected function tourist()
    {
        $tour=Tourist::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count');
        $monthT=Tourist::select(DB::raw("Month(created_at) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('month');
       
        $dataT=array(0,0,0,0,0,0,0,0,0,0,0,0);
       
        foreach($monthT as $index => $month )
        {
            $dataT[$month-1]=$tour[$index];
        }
        return $dataT;
    }

    protected function contact()
    {
        $contact=contact::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count');
        $monthC=contact::select(DB::raw("Month(created_at) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('month');
       
        $dataC=array(0,0,0,0,0,0,0,0,0,0,0,0);
       
        foreach($monthC as $index => $month )
        {
            $dataC[$month-1]=$contact[$index];
        }
        return $dataC;
    }
}
