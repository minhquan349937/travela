<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Tour;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable',
            'image' => 'required|max:2048',
            'tour_id' => 'required',
        ],[
            'title.required' => 'Vui lòng nhập tiêu đề ảnh',
            'image.required' => 'Vui lòng chọn ảnh',
            'image.image' => 'Tệp tải lên phải là hình ảnh',
            'status.required' => 'Vui lòng chọn trạng thái',
            
        ]);

        
        if ($request->image) {
            foreach ($request->image as $key => $gla) {
                $gallery = new Gallery();
                $gallery->tour_id = $data['tour_id'];
                $gallery->title = $data['title'];
                // them hinh anh
                $get_image = $gla;
                $path = 'uploads/galleries/';
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $gallery->image = $new_image;
                $gallery->save();
            }
            
        }
        

        return redirect()->back()->with('success', 'Thêm ảnh thành công!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $galleries = Gallery::where('tour_id', $id)->get();
        $tour = Tour::find($id);
        return view('admin.galleries.create', compact('tour', 'id', 'galleries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();
        return redirect()->back()->with('success', 'Xóa ảnh thành công!');

    }
}
