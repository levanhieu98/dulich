<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\contact;
class Contacts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $input = $request->all();
            $contact=contact::create( $request->all());
            $value=$request->email;
            $vars =['name'=>$request->name,'mail'=>$request->email,'sub'=>$request->subject,'msg' =>$request->message];
                Mail::send('backend.mail', $vars , function ($message) use($value) {
                    $message->to($value, 'Visitor')->subject('Hiệp Hội Du Lịch Thanh Hóa Phản Hồi!');
                });
                Mail::send('backend.mailer', $vars , function ($message)  {
                    $message->to('', 'Visitor')->subject('LIÊN HỆ TỪ KHÁCH HÀNG!');
                });
          
            return response()->json( $contact , 200);
        } catch (\Throwable $th) {
            return response()->json( 'Server 500 error' , 500);
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
