<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tour;
use App\Models\Gallery;
use App\Models\Schedule;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    
    public function index()
    {
        // Lấy tour nổi bật dựa trên số lượng đặt tour (sử dụng phương thức an toàn hơn)
        $featuredTourIds = DB::table('bookings')
            ->select('tour_id', DB::raw('COUNT(*) as booking_count'))
            ->groupBy('tour_id')
            ->orderBy('booking_count', 'desc')
            ->limit(9)
            ->pluck('tour_id');
            
        $featuredTours = [];
        
        if ($featuredTourIds->count() > 0) {
            $featuredTours = Tour::whereIn('id', $featuredTourIds)
                ->where('status', 1)
                ->get();
                
            // Sắp xếp lại theo thứ tự của $featuredTourIds
            $featuredTours = $featuredTours->sortBy(function($tour) use ($featuredTourIds) {
                return array_search($tour->id, $featuredTourIds->toArray());
            });
        }
        
        // Nếu không có đủ tour có booking, lấy thêm tour mới nhất
        if (count($featuredTours) < 6) {
            $existingIds = collect($featuredTours)->pluck('id')->toArray();
            $remainingCount = 6 - count($featuredTours);
            
            $additionalTours = Tour::where('status', 1)
                ->whereNotIn('id', $existingIds)
                ->orderBy('created_at', 'desc')
                ->take($remainingCount)
                ->get();
                
            $featuredTours = collect($featuredTours)->concat($additionalTours);
        }
        
        // Lấy tất cả danh mục cấp 1
        $category_parent = Category::where('category_parent', 0)->get();
        
        // Mảng để lưu trữ tours cho mỗi danh mục cấp 1
        $categoryTours = [];
        
        // Số lượng tour tối đa hiển thị cho mỗi danh mục
        $maxToursPerCategory = 6;
        
        // Với mỗi danh mục cấp 1, lấy tất cả tours từ nó và các danh mục con
        foreach ($category_parent as $parent) {
            $allTours = $parent->getAllTours()->sortByDesc('created_at');
            // Giới hạn số lượng tour hiển thị
            $categoryTours[$parent->id] = $allTours->take($maxToursPerCategory);
        }
        
        return view('pages.home', compact('category_parent', 'categoryTours', 'featuredTours'));
    }
    
    public function tour($slug = null)
    {
        // Nếu không có slug, chuyển hướng về trang chủ
        if (!$slug) {
            return redirect()->route('home');
        }
        
        $category = Category::where('slug', $slug)->first();
        
        if (!$category) {
            return redirect()->back()->with('error', 'Không tìm thấy danh mục');
        }
        
        // Lấy tất cả tour từ danh mục này và các danh mục con của nó
        $tours = $category->getAllTours()->sortByDesc('created_at');
        
        return view('pages.tour', compact('category', 'tours'));
    }
    
    public function detail_tour($slug)
    {
        
        $tour = Tour::with('category')->where('slug', $slug)->first();
        $schedule = Schedule::where('tour_id', $tour->id)->first();
        $related_tour = Tour::where('category_id', $tour->category_id)->whereNotIn('id', [$tour->id])->orderBy('id', 'DESC')->get();
        $galleries = Gallery::where('tour_id', $tour->id)->get();
        return view('pages.detail_tour', compact('tour', 'related_tour', 'galleries', 'schedule'));
    }
    
    /**
     * Hiển thị trang giới thiệu
     */
    public function about()
    {
        return view('pages.about');
    }
    
    /**
     * Hiển thị trang liên hệ
     */
    public function contact()
    {
        return view('pages.contact');
    }
}
