<?php

namespace App\Http\Controllers;
use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        $data=contact::all();
        return view("backend.contact.contact",compact('data'));
    }

    public function delete($id)
    {
        $contact= contact::find($id);
        $contact->delete();
        return redirect('/contact')->with('successx', 'Xóa liên hệ thành công');
    }

    public function destroy(Request $request)
    {
        foreach($request->id as $id)
        {
            $contact= contact::find($id);
            $contact->delete();
        }
        return response()->json($request->id);
    }
}
