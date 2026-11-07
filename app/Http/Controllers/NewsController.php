<?php

namespace App\Http\Controllers;

use App\Models\HomepageSetting;
use App\Models\NewsPost;

class NewsController extends Controller
{
    public function index()
    {
        return view('fronts.edusoft-themes.elegant.news-index', [
            'schoolDetails' => getSchoolDetails(),
            'page'          => HomepageSetting::current(),
            'posts'         => NewsPost::published()->paginate(9),
        ]);
    }

    public function show(string $slug)
    {
        $post = NewsPost::published()->where('slug', $slug)->firstOrFail();

        return view('fronts.edusoft-themes.elegant.news-show', [
            'schoolDetails' => getSchoolDetails(),
            'page'          => HomepageSetting::current(),
            'post'          => $post,
            'more'          => NewsPost::published()->where('id', '!=', $post->id)->limit(3)->get(),
        ]);
    }
}
