<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Monolog\Level;
use Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.categories.index', compact('categories'));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$categories = Category::orderBy('id', 'DESC')->get();
        $categories = $this->getCategoriesProduct();
        return view('admin.categories.create', compact('categories'));
    }
    public function getCategoriesProduct()
    {
        $categories = Category::orderBy('category_parent', 'DESC')->get();
        $listCategory = [];
        Category::recursive($categories, $parents = 0, $level = 1, $listCategory);
        return $listCategory;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories|max:255',
            'description' => 'required',
            'image' => 'required',
            'status' => 'required',
            'category_parent' => 'required',
        ],[
            'title.required' => 'Vui lòng nhập tên danh mục',
            'title.unique' => 'Tên danh mục đã tồn tại',
            'description.required' => 'Vui lòng nhập mô tả',
            'image.required' => 'Vui lòng chọn ảnh',
            // 'status.required' => 'Vui lòng chọn trạng thái',
        ]);

        // if( $data['category_parent'] == 0){
        //     $data['category_parent'] = 0;
        // }

        $category = new Category();
        $category->title = $data['title'];
        $category->category_parent = $data['category_parent'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->slug = Str::slug($data['title']);
        $get_image = $request->image;
        $path = 'uploads/categories/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $category->image = $new_image;
        $category->save();
        return redirect() ->route('categories.index')->with('success', 'Thêm danh mục thành công');
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
        $category = Category::find($id);
        $categories = $this->getCategoriesProduct();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
            'category_parent' => 'required',
        ],[
            'title.required' => 'Vui lòng nhập tên danh mục',
            'description.required' => 'Vui lòng nhập mô tả',
            'status.required' => 'Vui lòng chọn trạng thái',
            'title.unique' => 'Tên danh mục đã tồn tại', 
        ]);
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->category_parent = $data['category_parent'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->slug = Str::slug($data['title']);
        if ($request -> image) {
            $get_image = $request->image;
            $path = 'uploads/categories/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $category->image = $new_image;
        }
        
        $category->save();
        return redirect()->route('categories.index');
    }

   
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with( 'Xóa danh mục thành công');
    }

    
}
