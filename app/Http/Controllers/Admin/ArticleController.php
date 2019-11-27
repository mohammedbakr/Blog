<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        $articles = Article::latest()->paginate(5);

        return view('admin.articles.index', compact('articles', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required|string',
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,bmp,webp|max:2048',

        ]);

        $article = new Article();

        $article->title = $request->title;
        $article->body = $request->body;
        $article->user_id = Auth::user()->id;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/articlepics/'), $filename);
            $article->image = $filename;

        }else{
            
            return $request;
            $article->image = '';
        }

        $article->save();

        $article->tags()->sync($request->tags);

        return redirect()->route('admin.articles.index')->with('success', 'Article has beed added successfully');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $tags = Tag::all();

        return view('admin.articles.edit', compact('article', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'title' => 'required|string',
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,bmp,webp|max:2048',

        ]);

        $article = Article::find($id);

        $article->title = $request->title;
        $article->body = $request->body;
        $article->user_id = Auth::user()->id;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/articlepics/'), $filename);
            $article->image = $filename;

        }else{
            
            return $request;
            $article->image = '';
        }

        $article->save();

        $article->tags()->sync($request->tags);

        return redirect()->route('admin.articles.index')->with('success', 'Article has beed editted successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        $article->tags()->detach();

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article has been deleted successfully');
    }
}
