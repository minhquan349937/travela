<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class StatisticController extends Controller
{
    /**
     * Constructor để áp dụng middleware auth
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Hiển thị trang thống kê tổng quan
     */
    public function index()
    {
        // Lấy thống kê doanh thu theo tháng cho năm hiện tại
        $currentYear = Carbon::now()->year;
        $monthlyRevenue = $this->getMonthlyRevenue($currentYear);
        
        // Thống kê tour bán chạy nhất
        $topTours = $this->getTopTours();

        // Tổng doanh thu
        $totalRevenue = Booking::where('status', 1)->sum('total_price');
        
        // Tổng số booking
        $totalBookings = Booking::count();
        
        // Booking chưa xử lý
        $pendingBookings = Booking::where('status', 0)->count();

        // Booking trong tháng này
        $currentMonth = Carbon::now()->month;
        $currentMonthBookings = Booking::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        return view('admin.statistics.index', compact(
            'monthlyRevenue', 
            'topTours',
            'totalRevenue',
            'totalBookings',
            'pendingBookings',
            'currentMonthBookings',
            'currentYear'
        ));
    }

    /**
     * Lấy thống kê doanh thu theo khoảng thời gian
     */
    public function getRevenueByDateRange(Request $request)
    {
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now()->subDays(30);
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now();
        
        // Đảm bảo end_date luôn lớn hơn hoặc bằng start_date
        if ($startDate > $endDate) {
            $temp = $startDate;
            $startDate = $endDate;
            $endDate = $temp;
        }

        // Thống kê doanh thu theo ngày trong khoảng thời gian
        $dailyRevenue = Booking::where('status', 1)
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as revenue'),
                DB::raw('COUNT(*) as booking_count')
            )
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        // Tổng doanh thu trong khoảng thời gian
        $totalRevenue = $dailyRevenue->sum('revenue');
        
        // Số lượng booking trong khoảng thời gian
        $bookingCount = $dailyRevenue->sum('booking_count');

        return view('admin.statistics.date_range', compact(
            'dailyRevenue',
            'totalRevenue',
            'bookingCount',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Lấy thống kê doanh thu theo tháng cho một năm cụ thể
     */
    public function getYearlyRevenue(Request $request)
    {
        $year = $request->year ?? Carbon::now()->year;
        $monthlyRevenue = $this->getMonthlyRevenue($year);
        
        return view('admin.statistics.yearly', compact('monthlyRevenue', 'year'));
    }

    /**
     * Lấy chi tiết thống kê tour bán chạy
     */
    public function getTopToursDetail()
    {
        $topTours = $this->getTopTours(20); // Lấy top 20 tour
        return view('admin.statistics.top_tours', compact('topTours'));
    }

    /**
     * Helper: Lấy doanh thu theo tháng của một năm cụ thể
     */
    private function getMonthlyRevenue($year)
    {
        return Booking::where('status', 1)
            ->whereYear('created_at', $year)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_price) as revenue'),
                DB::raw('COUNT(*) as booking_count')
            )
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();
    }

    /**
     * Helper: Lấy top tour bán chạy nhất
     */
    private function getTopTours($limit = 5)
    {
        try {
            return DB::table('bookings')
                ->join('tours', 'bookings.tour_id', '=', 'tours.id')
                ->select(
                    'tours.id',
                    'tours.title',
                    'tours.price_adult', 
                    DB::raw('COUNT(bookings.id) as booking_count'),
                    DB::raw('SUM(bookings.total_price) as total_revenue')
                )
                ->where('bookings.status', 1)
                ->groupBy('tours.id', 'tours.title', 'tours.price_adult')
                ->orderBy('booking_count', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Exception $e) {
            // Log lỗi để debug sau này
            \Log::error("Error in getTopTours: " . $e->getMessage());
            
            // Trả về collection rỗng để tránh lỗi
            return collect([]);
        }
    }
} 