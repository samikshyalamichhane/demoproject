<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::with('news')->published()->orderBy('created_at', 'DESC')->get();
        return view('front.index', compact('categories'));
    }

    public function newsInner($slug)
    {
        $news = News::where('slug', $slug)->first();
        $news->view = $news->view + 1;
        $news->save();

        $relatedNews = News::published()->where('slug', '!=', $news->slug)->take(4)->get();
        $latestNews = News::published()->where('slug', '!=', $news->slug)->latest()->take(4)->get();
        return view('front.news-inner', compact('news', 'relatedNews', 'latestNews'));
    }

    public function newsByCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $news = News::where('category_id', $category->id)->published()->latest()->get();
        return view('front.all-news', compact('news', 'category'));
    }

    public function searchNews(Request $request)
    {
        $q = $request->title;
        $searchedNews = News::published()->latest()->with('user')->whereHas('user', function ($query) use($q) {
            $query->where('title', 'like', '%' . $q  . "%")
            ->orWhere('name', 'like', '%' . $q  . "%");
        })->paginate(40);
        return view('front.search', compact('searchedNews'));
    }
}
