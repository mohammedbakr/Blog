<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\Article;
use App\Models\Tag;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        $articles = Article::orderby('created_at', 'DESC')->paginate(10);

        return view('pages.index', compact('articles', 'tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $article = Article::find($id);

        return view('pages.show', compact('article'));
    }

    public function indexContact(){
        return view('pages.contact');
    }

    public function sendmail(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'body' => 'required|min:10',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $body = $request->input('body');

        SendEmailJob::dispatchNow($name, $email, $subject, $body);

        return back()->with('success', 'Thanks for contacting us');
    }

}
