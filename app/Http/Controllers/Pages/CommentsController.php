<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request, $id)
    {
        $request->validate([

            'body' => 'required',
        ]);

        $article = Article::where('id', $id)->firstOrFail();

        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->user_id = Auth::id();
        $comment->article()->associate($article);


        $comment->save($request->all());

        return redirect()->route('pages.index.show', $article->id);
        }
}
