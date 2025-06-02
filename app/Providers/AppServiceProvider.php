<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Tour;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function getCategoriesProduct()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        $listCategory = [];
        Category::recursive($categories, $parents = 0, $level = 1, $listCategory);
        return $listCategory;
    }
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $categories = $this->getCategoriesProduct();
            
            // Lấy danh mục có slug không rỗng để hiển thị footer
            $category_footer = Category::whereNotNull('slug')
                ->where('slug', '!=', '')
                ->inRandomOrder()
                ->take(8)
                ->get();

            $view->with([
                'categories' => $categories,
                'category_footer' => $category_footer
            ]);
        });
    }
}
