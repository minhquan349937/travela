<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    
    public function index()
    {
        return view('pages.home');
    }
    public function tour($slug)
    {
        return view('pages.tour');
    }
    public function detail_tour($slug)
    {
        return view('pages.detail_tour');
    }
}
