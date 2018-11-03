<?php

namespace App\Http\Controllers;
use App\Article;
use App\category;
use App\comment;
use App\panel;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(3);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate(request() , [
            'title'    => 'required',
            'body'     => 'required',
            'category' => 'required',
            'file'     => 'required|mimes:png,jpg,jpeg|max:1024'
        ]);

        if($file = $request->file('file'))
        {
            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();
            $destinationPath = public_path('images');

        $article = auth()
            ->user()
            ->articles()
            ->create(['title' => request('title'), 'body' => request('body'), 'file' => $filename]);
        $article->categories()->attach(request('category'));

        $file->move($destinationPath, $filename);
        }
        session()->flash('message', 'مقاله با موفقیت ثبت شد.');
        return redirect('panel/index');
    }

    public function show(Article $article)
    {
        $view = $article->viewCount + 1;
        $article->update(['viewCount' => $view]);
        $comments = $article->comments()->get();
        return view('articles.show', compact('article', 'comments'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $image_path = "images/".$article->file;
        if($request->file('file')) {
            $this->validate(request() , [
                'title'    => 'required',
                'body'     => 'required',
                'category' => 'required',
                'file'     => 'required|mimes:png,jpg,jpeg|max:1024'
            ]);

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images');
//            $article->update(request(['title', 'body']));
            $article->update(['title' => request('title'), 'body' => request('body'), 'file' => $filename]);
            $article->categories()->sync(request('category'));

            if(file_exists($image_path)) {
                @unlink($image_path);
            }

            $file->move($destinationPath, $filename);
        }else{
            $this->validate(request() , [
                'title'    => 'required',
                'body'     => 'required',
                'category' => 'required'
            ]);
            $filename = $article->file;
            $article->update(['title' => request('title'), 'body' => request('body'), 'file' => $filename]);
            $article->categories()->sync(request('category'));
        }
        session()->flash('message', 'مقاله با موفقیت ویرایش شد.');
        return redirect('panel/index');
    }

    public function delete(Article $article)
    {
        $article->categories()->sync(request('category'));
        $article->delete();

        $image_path = "images/".$article->file;
        if(file_exists($image_path)) {
            @unlink($image_path);
        }

//        return view('panel.index', compact('article'));
        session()->flash('message', 'مقاله با موفقیت حذف شد.');
        return redirect(route('panel.index'));
    }

    public function search(Request $request)
    {
        if($request->ajax()) {
            $output = "";
            $articles = "";
            $search = $request->search;
            if ($search != '')
            {
                $articles = Article::where('title', 'LIKE', '%' . $search . '%')->get();

                if ($articles)
                {
                    foreach ($articles as $key => $article) {
                        $output.='<tr>'.
                            '<td><a href="'. route('article.show', ['article' => $article->slug]) .'">'.$article->title.'</a></td>'.
                            '</tr>';
                    }
                    return Response($output);
                }

            }else{
                $output.='<tr>'.
                    '<td style="color: #ac2925">برای جستجو متنی را وارد کنید...</td>'.
                    '</tr>';
                return Response($output);
            }

        }
    }
}
