<?php

namespace App\Http\Controllers;

use App\Article;
use App\category;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $articles = $category->articles()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.category');
    }

    public function store()
    {
        $this->validate(request() , [
            'category'    => 'required'
        ]);

        Category::create([
            'name' => request('category')
        ]);

        session()->flash('message', 'دسته بندی مورد نظر با موفقیت ثبت شد.');
        return redirect('panel/category');
    }
}
