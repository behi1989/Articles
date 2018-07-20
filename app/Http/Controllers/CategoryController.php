<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $articles = $category->articles()->paginate(10);
        return view('articles.index', compact('articles'));
    }
}
