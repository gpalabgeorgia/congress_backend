<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\HeroBanner; // <--- 1. Добавили импорт
use App\Models\Language;
use App\Models\MenuItem;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // ვღებულობთ მხოლოდ აქტიურ სოც.ქსელებს, დახარისხებულს sort_order-ის მიხედვით
        $socialLinks = SocialLink::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        // ვტვირთავთ მხოლოდ მთავარ მენიუს პუნქტებს და მათში ჩადებულ კატეგორიებს
        $menuItems = MenuItem::whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => function ($query) {
                $query->where('is_active', true)->orderBy('sort_order', 'asc');
            }])
            ->orderBy('sort_order', 'asc')
            ->get();

        // ვტვირთავთ აქტიურ ენებს
        $languages = Language::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        // ვღებულობთ მთავარ ბანერს
        $heroBanner = HeroBanner::first();

        // ვღებულობთ მიმდინარე ან ნაგულისხმევ ენას მბ-დან
        $currentLocale = app()->getLocale();
        $currentLanguage = $languages->firstWhere('code', $currentLocale)
            ?? $languages->firstWhere('is_default', true)
            ?? $languages->first();

        $features = Feature::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        // <--- 3. Передаем $heroBanner в compact
        return view('pages.home', compact('socialLinks', 'menuItems', 'languages', 'currentLanguage', 'heroBanner', 'features'));
    }
}
