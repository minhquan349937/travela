<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ToursController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TourPriceController;
use App\Models\TourPrice;
use App\Http\Controllers\TourController;
use App\Http\Controllers\CustomerController;

use Illuminate\Support\Facades\Auth;




// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/tour/{slug?}', [IndexController::class, 'tour'])->name('tour');
Route::get('/chi-tiet-tour/{slug}', [IndexController::class, 'detail_tour'])->name('chi-tiet-tour');
Route::get('/gioi-thieu', [App\Http\Controllers\AboutController::class, 'index'])->name('gioi-thieu');
Route::get('/lien-he', [IndexController::class, 'contact'])->name('lien-he');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');

Route::resource('categories', CategoriesController::class);

Route::resource('tours', ToursController::class);


Route::resource('gallery', GalleryController::class);


Route::resource('schedule', ScheduleController::class);

Route::resource('booking', BookingController::class);

Route::post('/booking/{id}/update-status', [App\Http\Controllers\BookingController::class, 'updateStatus'])->name('booking.update-status');


Route::resource('tourprice', TourPriceController::class);



Route::get('/tim-kiem', [App\Http\Controllers\ToursController::class, 'search'])->name('tours.search');

Route::get('/tours/domestic', [TourController::class, 'showDomesticTours'])->name('tours.domestic');
Route::get('/tours/category/{categoryId}', [TourController::class, 'showToursByCategory'])->name('tours.by_category');

// Thêm routes cho chức năng danh mục phân cấp
Route::get('/tours/categories', [TourController::class, 'showCategoryHierarchy'])->name('tours.categories');
Route::get('/tours/categories/{level}/{parentId?}', [TourController::class, 'getCategories'])->name('tours.get_categories');

Route::get('/category/{id}/subcategories', [CategoriesController::class, 'showSubCategories'])->name('categories.subcategories');
Route::post('/tour/{id}/update-status', [CategoriesController::class, 'updateTourStatus'])->name('tour.update-status');

// Thêm routes cho thống kê
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/statistics', [App\Http\Controllers\StatisticController::class, 'index'])->name('admin.statistics');
    Route::get('/statistics/date-range', [App\Http\Controllers\StatisticController::class, 'getRevenueByDateRange'])->name('admin.statistics.date-range');
    Route::get('/statistics/yearly', [App\Http\Controllers\StatisticController::class, 'getYearlyRevenue'])->name('admin.statistics.yearly');
    Route::get('/statistics/top-tours', [App\Http\Controllers\StatisticController::class, 'getTopToursDetail'])->name('admin.statistics.top-tours');
    Route::get('/admin/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');
    Route::get('/admin/customers/{phone}/bookings', [App\Http\Controllers\CustomerController::class, 'bookings'])->name('customers.bookings');
});