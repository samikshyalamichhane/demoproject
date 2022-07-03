<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory;
    public function deleteImage()
    {
        return Storage::delete($this->logo);
    }
    public function youtubeVideo($url){
    	$url_string = parse_url($url, PHP_URL_QUERY);
  		parse_str($url_string, $args);
  		return isset($args['v']) ? $args['v'] : false;
    }
}
