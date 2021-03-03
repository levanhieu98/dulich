<?php

namespace App\Http\Controllers;

use App\Helpers\AlbumUpload;
use App\Helpers\TourUpload;
use App\Http\Requests\Tour\AddRequest;
use App\Models\Language;
use App\Models\tour_image;
use Illuminate\Http\Request;
use App\Models\Tourist;
use App\Models\travel_list;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;

class TouristController extends Controller
{
    public function tourist()
    {
        $data["tourist"] = Tourist::all();

        return view('backend.Tourist.tourist', $data);
    }

    public function delete_tourist(Request $request)
    {
        foreach ($request->id as $id) {
            Tourist::find($id)->delete();
        }
        return response()->json($request->id);
    }

    public function deletes($id)
    {
        Tourist::find($id)->delete();
        return redirect('/tourist');
    }
    public function form_tour()
    {
        $language = Language::all();
        $typeOfTour = \App\Models\TypeOfTour::all();
        return view('backend.Tourist.add_tour', compact('language', 'typeOfTour'));
    }

    public function list_tour(Request $request)
    {
        if (isset($request->id)) {
            Cookie::queue('id_lang', $request->id, 1);
        }
        $data = $this->Checktour();
        $data["language"] = Language::all();
        return view('backend.Tourist.listtour', $data);
    }

    protected function Checktour()
    {

        if (Cookie::get('id_lang')) {
            $data["tmp"] = Language::find(Cookie::get('id_lang'))->name;
            $data["travel_list"] = travel_list::where('language_id', Cookie::get('id_lang'))->get();
            Cookie::queue(Cookie::forget('id_lang'));
        } else {
            $data["tmp"] = "";
            $data["travel_list"] = travel_list::all();
        }
        return $data;
    }

    public function add_tour(AddRequest $request)
    {
        $tour = new travel_list();
        $tour->title = $request->title;
        $tour->content = $request->content;
        $tour->language_id = $request->language_id;
        $tour->price = $request->price;
        $tour->location = $request->location;
        $tour->place = $request->place;
        $tour->date = $request->date;
        $tour->type_of_tour_id = $request->type_of_tour_id;
        $tour->slug = Str::slug($tour->title);

        if ($request->hasFile('image')) {
            $hinh = ($request->file('image'));
            $tour->images = TourUpload::uploadImg('img', $hinh);
        }
        $tour->save();

        if ($request->hasFile('avatar')) {
            foreach ($request->file('avatar') as $value) {
                $tour_img = new tour_image();
                $tour_img->tour_id = $tour->id;
                $tour_img->image = AlbumUpload::uploadImg('img', $value);
                $tour_img->save();
            }
        }

        return back()->with('success', 'Thêm thành công');
    }

    public function delete_tour($id)
    {

        $t = travel_list::find($id);
        $imgs = $t->images;
        TourUpload::destroyFile('img', $imgs);
        $t->delete();
        $img = tour_image::where('tour_id', $id)->get();
        foreach ($img as $image) {
            AlbumUpload::destroyFile('img', $image->image);
        }
        tour_image::where('tour_id', $id)->delete();
        Cookie::queue('id_lang', $t->language_id, 1);
        return back()->with('successx', 'Xóa thành công');
    }

    public  function delete(Request $request)
    {
        foreach ($request->id as $id) {
            $t = travel_list::find($id);
            $imgs = $t->images;
            TourUpload::destroyFile('img', $imgs);
            $t->delete();
            $img = tour_image::where('tour_id', $id)->get();
            foreach ($img as $image) {
                AlbumUpload::destroyFile('img', $image->image);
            }
            tour_image::where('tour_id', $id)->delete();
            Cookie::queue('id_lang', $t->language_id, 1);
        }
        return response()->json($request->id);
    }

    public function edit_tour($id)
    {
        $tour = $id = travel_list::where('slug', $id)->first();
        $language = Language::all();
        $tour_img = tour_image::where('tour_id', $id->id)->get();
        $typeOfTour = \App\Models\TypeOfTour::all();
        return view('backend.Tourist.edittour', compact(['tour', 'language', 'tour_img', 'typeOfTour']));
    }

    public function get_edit_tour(Request $request, $id)
    {
        Cookie::queue('id_lang', $request->language_id, 1);
        $tour = travel_list::find($id);
        $tour->title = $request->title;
        $tour->content = $request->content;
        $tour->language_id = $request->language_id;
        $tour->price = $request->price;
        $tour->location = $request->location;
        $tour->place = $request->place;
        $tour->date = $request->date;
        $tour->slug = Str::slug($tour->title);
        $tour->type_of_tour_id = $request->type_of_tour_id;
        $img = $tour->images;
        if ($request->hasFile('image')) {
            $hinh = $request->file('image');
            TourUpload::destroyFile('img', $img);
            $tour->images = TourUpload::uploadImg('img', $hinh);
        } else {
            $tour->images = $img;
        }
        $tour->save();

        if ($request->hasFile('avatar')) {
            $img = tour_image::where('tour_id', $id)->get();
            foreach ($img as $image) {
                AlbumUpload::destroyFile('img', $image->image);
            }
            tour_image::where('tour_id', $id)->delete();
            foreach ($request->file('avatar') as $value) {

                $tour_img = new tour_image();
                $tour_img->tour_id = $tour->id;
                $tour_img->image = AlbumUpload::uploadImg('img', $value);
                $tour_img->save();
            }
        }


        return redirect('/list-tour')->with('Sua', 'Sửa thành công');
    }
}
