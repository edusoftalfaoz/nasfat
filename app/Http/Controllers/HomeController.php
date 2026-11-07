<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\GalleryItem;
use App\Models\HomepageSetting;
use App\Models\NewsPost;
use App\Models\Program;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $schoolDetails = getSchoolDetails();

        // If the website migrations have not been run yet, show the page with
        // empty lists instead of a 500 error.
        $ready = Schema::hasTable('homepage_settings');

        return view('fronts.edusoft-themes.elegant.home', [
            'schoolDetails' => $schoolDetails,
            'stats'         => getSchoolStats(),
            'page'          => $ready ? HomepageSetting::current() : new HomepageSetting(),
            'programs'      => $ready ? Program::active()->get() : collect(),
            'features'      => $ready ? Feature::active()->get() : collect(),
            'testimonials'  => $ready ? Testimonial::active()->get() : collect(),
            'gallery'       => $ready ? GalleryItem::active()->get() : collect(),
            'news'          => $ready ? NewsPost::published()->limit(3)->get() : collect(),
        ]);
    }
}
