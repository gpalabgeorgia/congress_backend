<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink;

class HomeController extends Controller
{
    public function index()
    {
        // ვღებულობთ მხოლოდ აქტიურ სოც.ქსელებს, დახარისხებულს sort_order-ის მიხედვით
        $socialLinks = SocialLink::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();
        return view('pages.home', compact('socialLinks'));
    }
}
