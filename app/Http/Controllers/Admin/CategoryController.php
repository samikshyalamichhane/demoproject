<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $this->authorize('categories-list');
        $categories = Category::published()->get();
        return view('admin.category.list',compact('categories'));
    }
}
