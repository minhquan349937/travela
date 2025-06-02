<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function showDomesticTours()
    {
        // Lấy danh mục tour trong nước (giả sử có id = 1 hoặc category_parent = 0)
        $domesticCategory = Category::where('category_parent', 0)->first();
        
        if ($domesticCategory) {
            // Lấy tất cả tour từ các danh mục level 3
            $tours = $domesticCategory->getToursFromLevel3();
            
            // Sắp xếp tour theo thứ tự mới nhất
            $tours = $tours->sortByDesc('created_at');
            
            return view('tours.domestic', compact('tours'));
        }
        
        return redirect()->back()->with('error', 'Không tìm thấy danh mục tour trong nước');
    }

    public function showToursByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        
        // Sử dụng phương thức getAllTours để lấy cả tours từ danh mục con
        $tours = $category->getAllTours();
        
        // Sắp xếp tour theo thứ tự mới nhất
        $tours = $tours->sortByDesc('created_at');
        
        return view('tours.by_category', compact('tours', 'category'));
    }

    public function showCategoryHierarchy()
    {
        // Lấy danh mục cấp 1
        $level1Categories = Category::where('category_parent', 0)->get();
        
        return view('tours.categories', compact('level1Categories'));
    }

    public function getCategories($level, $parentId = null)
    {
        if ($level == 1) {
            // Level 1 categories (category_parent = 0)
            $categories = Category::where('category_parent', 0)->get();
            return response()->json($categories);
        } elseif ($level == 2) {
            // Level 2 categories (children of specified level 1 category)
            $categories = Category::where('category_parent', $parentId)->get();
            return response()->json($categories);
        } elseif ($level == 3) {
            // Get the parent category
            $parentCategory = Category::findOrFail($parentId);
            // Check if this is a level 2 category
            if ($parentCategory->parentCategory && $parentCategory->parentCategory->category_parent == 0) {
                // This is a level 2 category, get its level 3 children
                $categories = Category::where('category_parent', $parentId)->get();
            } else {
                // This is a level 1 category, get all its level 3 descendants
                $level2Categories = Category::where('category_parent', $parentId)->get();
                $categories = collect();
                foreach ($level2Categories as $level2) {
                    $level3 = Category::where('category_parent', $level2->id)->get();
                    $categories = $categories->merge($level3);
                }
            }
            return response()->json($categories);
        }
    }
}
