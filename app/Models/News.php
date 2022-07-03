<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use Sluggable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('publish', 1);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    public function imageUrl()
    {
        return Storage::disk('public')->url($this->image);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function youtubeVideo($url){
        $convertedUrl = str_replace('https://youtu.be/','',$url);
        return $convertedUrl;
    }

    public function facebookVideo($url){
    	$url_string = parse_url($url, PHP_URL_QUERY);
  		parse_str($url_string, $args);
  		return isset($args['v']) ? $args['v'] : false;
    }

        public function tiktokVideo($url)
    {
        $convertedUrl = str_replace('?is_from_webapp=1&sender_device=pc','',$url);
        $dd = explode("video/",$convertedUrl);
        $url = $dd[0] ?? ''."video/".$dd[1] ?? '';
        return $url;
    }

    public function getTiktokUrl($url){
        $convertedUrl = str_replace('?is_from_webapp=1&sender_device=pc','',$url);
        $dd = explode("video/",$convertedUrl);
        return $dd[1] ?? '';
    }


    public function deleteImage()
    {
        return Storage::delete($this->image);
    }

    public function deleteVideo()
    {
        return Storage::delete($this->video);
    }
}
