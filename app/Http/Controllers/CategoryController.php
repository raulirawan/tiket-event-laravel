<?php

namespace App\Http\Controllers;

use App\Events;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::take(6)->get();
        return view('pages.category', compact('categories'));
    }

    public function detail($slug)
    {
        $categories = Category::take(6)->get();
        $category = Category::where('slug',$slug)->firstOrFail();
        
        $events = Events::with(['galleries'])->where('category_id',$category->id)->get();
        return view('pages.category-details', compact('categories','events'));
    }
}
