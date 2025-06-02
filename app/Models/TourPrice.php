<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourPrice extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tour_prices';
}
