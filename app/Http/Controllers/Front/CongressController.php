<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CongressPage;
use App\Models\CongressSection;
use App\Models\FooterSetting;
use App\Models\Language;
use App\Models\MenuItem;
use App\Models\OurMission;
use App\Models\SocialLink;

class CongressController extends Controller
{
    public function index()
    {
        $congressPage = CongressPage::first();
        $sections = CongressSection::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();
        $mission = OurMission::where('is_active', true)->first();
/*
 *
 * ეს ცვლადები გლობალურია და ყველა კონტროლერშია საჭირო
 *
*/
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
        $footerSetting = FooterSetting::first();
        $currentLocale = app()->getLocale();
        $currentLanguage = $languages->firstWhere('code', $currentLocale)
            ?? $languages->firstWhere('is_default', true)
            ?? $languages->first();
/*
 *
 * არ უნდა დაგვავიწყდეს კომენტარებს შორის მოცემული ცვლადების გამოძახება
 *
*/

        return view('pages.congress', compact('congressPage', 'socialLinks', 'menuItems', 'languages', 'footerSetting', 'currentLanguage', 'sections', 'mission'));
    }
}
