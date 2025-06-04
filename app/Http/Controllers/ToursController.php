<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use Str;
use App\Models\Category;


class ToursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::with('category') -> orderBy('id', 'DESC')->get();
        return view('admin.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.tours.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:tours,title',
            'description' => 'nullable',
            'quantity' => 'required',
            'price_adult' => 'required',
            'price_children' => 'required',
            'category_id' => 'required',
            'vehicle' => 'required',
            'departure_date' => 'required',
            // 'return_date' => 'nullable|date|after:departure_date',
            'tour_form' => 'required',
            'tour_to' => 'required',
            'tour_time' => 'required',
            'note' => 'nullable',
            'image' => 'required',
            'status' => 'required',
        ],[
            'title.required' => 'Vui lòng nhập tên tour',
            'title.unique' => 'Tên tour đã tồn tại',
            'description.required' => 'Vui lòng nhập mô tả tour',
            'quantity.required' => 'Vui lòng nhập số lượng khách',
            'quantity.integer' => 'Số lượng khách phải là số nguyên',
            
            'price_adult.required' => 'Vui lòng nhập giá người lớn',
            'price_children.required' => 'Vui lòng nhập giá trẻ em',
            'vehicle.required' => 'Vui lòng nhập phương tiện di chuyển',
            'departure_date.required' => 'Vui lòng chọn ngày khởi hành',
           
            // 'return_date.after' => 'Ngày trở về phải sau ngày khởi hành',
            'tour_form.required' => 'Vui lòng nhập nơi khởi hành',
            'tour_to.required' => 'Vui lòng nhập nơi đến',
            'tour_time.required' => 'Vui lòng nhập thời gian tour',
            'image.required' => 'Vui lòng chọn ảnh đại diện cho tour',
            'status.required' => 'Vui lòng chọn trạng thái tour',
        ]);

        $tour = new Tour();
        $tour->title = $data['title'];
        $tour->description = $data['description'];
        $tour->quantity = $data['quantity'];
        $tour->price_adult = $data['price_adult'];
        $tour->price_children = $data['price_children'];
        $tour->category_id = $data['category_id'];
        $tour->vehicle = $data['vehicle'];
        $tour->departure_date = json_encode($data['departure_date']); 
        // $tour->return_date = $data['return_date'];
        $tour->tour_form = $data['tour_form'];
        $tour->tour_to = $data['tour_to'];
        $tour->tour_time = $data['tour_time'];
        $tour->note = $data['note'];
        $tour->status = $data['status'];
        $tour->slug = Str::slug($data['title']);
        $tour->tour_code = rand(0000,9999);
        
        $get_image = $request->image;
        $path = 'uploads/tours/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $tour->image = $new_image;
        $tour->save();
        return redirect()->route('tours.index')->with('success', 'Thêm tour thành công!');
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
        $tour = Tour::find($id);
        if ($tour) {
            $categories = Category::orderBy('id', 'DESC')->get();
            return view('admin.tours.edit', compact('tour', 'categories'));
        } else {
            return redirect()->route('tours.index')->with('error', 'Tour không tồn tại!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'quantity' => 'required',
            'price_adult' => 'required',
            'price_children' => 'required',
            'category_id' => 'required',
            'vehicle' => 'required',
            'departure_date' => 'required',
            // 'return_date' => 'nullable|date|after:departure_date',
            'tour_form' => 'required',
            'tour_to' => 'required',
            'tour_time' => 'required',
            'note' => 'nullable',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ],[
            'title.required' => 'Vui lòng nhập tên tour',
            'description.required' => 'Vui lòng nhập mô tả tour',
            'quantity.required' => 'Vui lòng nhập số lượng khách',
            'quantity.integer' => 'Số lượng khách phải là số nguyên',
            'price_adult.required' => 'Vui lòng nhập giá người lớn',
            'price_children.required' => 'Vui lòng nhập giá trẻ em',
            'vehicle.required' => 'Vui lòng nhập phương tiện di chuyển',
            'departure_date.required' => 'Vui lòng chọn ngày khởi hành',
            // 'return_date.after' => 'Ngày trở về phải sau ngày khởi hành',
        ]);

        $tour = Tour::find($id);
        if ($tour) {
            $tour->title = $data['title'];
            $tour->description = $data['description'];
            $tour->quantity = $data['quantity'];
            $tour->price_adult = $data['price_adult'];
            $tour->price_children = $data['price_children'];
            $tour->category_id = $data['category_id'];
            $tour->vehicle = $data['vehicle'];
            $tour->departure_date = $data['departure_date']; 
            // $tour->return_date = $data['return_date'];
            $tour->tour_form = $data['tour_form'];
            $tour->tour_to = $data['tour_to'];
            $tour->tour_time = $data['tour_time'];
            $tour->note = $data['note'];
            $tour->status = $data['status'];
            $tour->slug = Str::slug($data['title']);
            $tour->tour_code = rand(0000,9999);
            // $tour->tour_code = $tour->tour_code; 
            
            if ($request->image) {
                // Upload new image
                $get_image = $request->image;
                $path = 'uploads/tours/';
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $tour->image = $new_image;
            }
            toastr()->success('Data has been saved successfully!', 'Congrats');
            // Save the updated tour
            if ($tour->save()) {
                
                return redirect()->route('tours.index')->with('success', 'Cập nhật tour thành công!');
            } else { 
                return redirect()->route('tours.index')->with('error', 'Cập nhật tour thất bại!');
            }
        }
        else {
            return redirect()->route('tours.index')->with('error', 'Tour không tồn tại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tour = Tour::find($id);
        if ($tour) {
            $tour->delete();
            return redirect()->route('tours.index')->with('success', 'Xóa tour thành công!');
        } else {
            return redirect()->route('tours.index')->with('error', 'Tour không tồn tại!');
        }
    }

// ToursController.php
    public function search(Request $request)
    {
        $query = \App\Models\Tour::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                ->orWhere('tour_form', 'like', "%$search%");
            });
        }

        if ($request->filled('price')) {
            [$min, $max] = explode('-', $request->input('price'));
            $query->whereBetween('price_adult', [intval($min)*1000000, intval($max)*1000000]);
        }

        $tours = $query->where('status', 1)->paginate(12);

        return view('pages.search', compact('tours', 'search'));
    }
}
