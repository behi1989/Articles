<?php

namespace App\Http\Controllers;

use App\Article;
use App\category;
use App\User;

class PanelController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('panel.index', compact('articles', 'categories', 'users'));
    }

    public function category()
    {
        $limit = 10;
        $categories = Category::latest()->paginate($limit);
        return view('panel.category', compact('categories'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('panel.users', compact('users'));
    }

    public function deleteuser(User $user)
    {
        $user->delete();
        session()->flash('message', 'کاربر با موفقیت حذف شد.');
        return redirect(route('panel.users'));
    }

    public function editcategory(Category $category)
    {
        return view('panel.edit', compact('category'));
    }

    public function update(Category $category)
    {
        $category->update(request(['name']));
        session()->flash('message', 'دسته با موفقیت ویرایش شد.');
        return redirect('panel/category');
    }

    public function deletecategory(Category $category)
    {
        $category->articles()->sync(request('article'));
        $category->delete();
        session()->flash('message', 'دسته با موفقیت حذف شد.');
        return redirect(route('panel.category'));
    }
}
