<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function scopePublished($query)
    {
        return $query->where('publish', 1);
    }

    public function news(){
        return $this->hasMany(News::class);
    }
}
