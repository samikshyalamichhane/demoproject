<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Mail\NewsCreatedByUser;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        if(!auth()->check()){
            abort(403);
        }
        if (auth()->user()->is_admin) {
            $news = News::with('user')->latest()->get();
        } else {
            $news = News::with('user')
                ->when($request->user()->id, function ($query) use ($request) {
                    $query->where('user_id', $request->user()->id);
                })
                ->latest()->get();
        }
        return view('admin.news.list', compact('news'));
    }

    public function getTodayNews(){
        $news = News::with('user')->whereDate('created_at', Carbon::today())->get();
        return view('admin.news.list', compact('news'));
    }

    public function create()
    {
        $this->authorize('news-create');
        $categories = Category::published()->get();
        return view('admin.news.create', compact('categories'));
    }

    public function store(NewsRequest $request)
    {
       $news =  News::create([
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'publish' => $request->has('publish') ? 1 : 0,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'youtube_video_link' => $request->youtube_video_link,
            'tiktok_video_link' => $request->tiktok_video_link,
            'facebook_video_link' => $request->facebook_video_link,
            'image' => $request->hasFile('image') ? $request->file('image')->store('public/uploads/news') : null,
            'video' => $request->hasFile('video') ? $request->file('video')->store('public/uploads/videos') : null
        ]);
        $user = User::admin()->first();
        $maildata = [
            'news_title' => $request->title,
            'admin' => $user->name,
            'user' => $news->user->name,
            'user_email' => $news->user->email,
            'news_link' => env('APP_URL'). '/admin/news'
        ];
        // dd($maildata);
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewsCreatedByUser($maildata));
        return redirect()->route('news.index')->with('success', 'News Created Successfully!');
    }

    public function show(News $news)
    {
        return view('admin.news.view', compact('news'));
    }

    public function edit(News $news)
    {
        $categories = Category::published()->get();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(NewsRequest $request, News $news)
    {
        $news->title = $request->title;
        $news->description = $request->description;
        $news->short_description = $request->short_description;
        $news->publish = $request->has('publish') ? 1 : 0;
        $news->user_id = $news->user_id;
        $news->category_id = $request->category_id;
        $news->youtube_video_link = $request->youtube_video_link;
        $news->tiktok_video_link = $request->tiktok_video_link;
        $news->facebook_video_link = $request->facebook_video_link;

        if(auth()->user()->is_admin){
            $news->edited = 1;
        } else {
            $news->edited = 0;
        }
        
        if ($request->hasFile('image')) {
            $news->deleteImage();
            $news->image = $request->file('image')->store('public/uploads/news');
        }
        if ($request->hasFile('video')) {
            $news->deleteVideo();
            $news->video = $request->file('video')->store('public/uploads/videos');
        }
        $news->update();
        return redirect()->route('news.index')->with('success', 'News Updated Successfully!');
    }

    public function destroy(News $news)
    {
        $news->deleteImage();
        $news->deleteVideo();
        $news->delete();
        return redirect()->back()->with('success', 'News Deleted Successfully!');
    }
}
