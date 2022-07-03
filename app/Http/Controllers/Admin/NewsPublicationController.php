<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsPublicationController extends Controller
{
    public function store(Request $request ,  News $news)
    {
        $news->update(['publish' => 1]);
        return response()->json([
            "status" => "true",
            "message" => "News published!!"
          ], 200);
    }

   
    public function destroy(Request $request ,  News $news)
    {
        $news->update(['publish' => 0]);
        return response()->json([
            "status" => "true",
            "message" => "News unpublished!!"
          ], 200);
    }

    public function verify(Request $request ,  News $news)
    {
        $news->update(['is_verified' => 1]);
        return response()->json([
            "status" => "true",
            "message" => "News Verified!!"
          ], 200);
    }

   
    public function unverify(Request $request ,  News $news)
    {
        $news->update(['is_verified' => 0]);
        return response()->json([
            "status" => "true",
            "message" => "News unverified!!"
          ], 200);
    }
}
