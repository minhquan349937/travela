<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'quantity',
        'price_adult',
        'price_children',
        'category_id',
        'vehicle',
        'departure_date',
        'tour_form',
        'tour_to',
        'tour_time',
        'note',
        'image',
        'status',
        'slug',
        'tour_code'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
