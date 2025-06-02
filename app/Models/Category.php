<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'category_parent',
        'status'
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function childCategories()
    {
        return $this->hasMany(Category::class, 'category_parent', 'id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'category_parent', 'id');
    }

    public function getAllChildCategories()
    {
        $children = $this->childCategories;
        foreach ($this->childCategories as $child) {
            $children = $children->merge($child->getAllChildCategories());
        }
        return $children;
    }

    public function getToursFromLevel3()
    {
        // Lấy tất cả danh mục con (level 2)
        $level2Categories = $this->childCategories;
        $allTours = collect();

        // Với mỗi danh mục level 2, lấy các danh mục con của nó (level 3)
        foreach ($level2Categories as $level2Category) {
            $level3Categories = $level2Category->childCategories;
            
            // Lấy tất cả các tour từ các danh mục level 3
            foreach ($level3Categories as $level3Category) {
                $allTours = $allTours->merge($level3Category->tours);
            }
        }

        return $allTours;
    }

    public function getAllTours()
    {
        // Lấy tour trực tiếp từ danh mục này
        $allTours = $this->tours;
        
        // Lấy tất cả danh mục con (bất kỳ cấp nào)
        $childCategories = $this->getAllChildCategories();
        
        // Lấy tour từ tất cả các danh mục con
        foreach ($childCategories as $childCategory) {
            $allTours = $allTours->merge($childCategory->tours);
        }
        
        return $allTours;
    }

    public static function recursive($categories, $parents = 0, $level = 1, &$listCategory)
    {
        if (count($categories) > 0) {
            foreach ($categories as $key => $value) {
                if ($value->category_parent == $parents) {
                    $value->level = $level;
                    $listCategory[] = $value;
                    unset($categories[$key]);
                    $parent = $value->id;
                    self::recursive($categories, $parent, $level + 1, $listCategory);
                }
            }
        }
    }
}
