<?php

namespace App\Http\Controllers;

use App\Article;
use App\comment;
use App\Mail\CommentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(Article $article)
    {
        $this->validate(request(), [
            'body' => 'required|min:10'
        ]);

        $user = auth()->user();

        $article->comments()->create([
            'user_id' => $user->id,
            'body'    => request('body')
        ]);

        Mail::to($user->email)->send(new CommentMail($user));

        $commentCount = $article->commentCount+1;
        $article->update(['commentCount' => $commentCount]);
        return back();
    }

    public function show(Comment $comment)
    {
        $comments = $comment->latest()->paginate(10);
        return view('panel.comment', compact('comments'));
    }

    public function deletecomment(Comment $comment)
    {
        $comment->delete();
        session()->flash('message', 'پیام با موفقیت حذف شد.');
        return redirect(route('panel.comment'));
    }

    public function activecomment(Comment $comment)
    {
        $comment->update(['approved' => 1]);
        session()->flash('message', 'پیام با موفقیت تایید شد.');
        return redirect(route('panel.comment'));
    }
}


