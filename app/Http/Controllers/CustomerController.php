<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Lấy danh sách khách hàng duy nhất từ bảng bookings
        $customers = DB::table('bookings')
            ->select('phone', 'fullname as name', 'email')
            ->groupBy('phone', 'fullname', 'email')
            ->get();
            
        return view('admin.customers.index', compact('customers'));
    }

    public function bookings($phone)
    {
        $bookings = DB::table('bookings')
            ->join('tours', 'bookings.tour_id', '=', 'tours.id')
            ->select(
                'bookings.*',
                'tours.title as tour_title'
            )
            ->where('bookings.phone', $phone)
            ->orderBy('bookings.created_at', 'DESC')
            ->get();

        return view('admin.customers.bookings', compact('bookings', 'phone'));
    }
}
