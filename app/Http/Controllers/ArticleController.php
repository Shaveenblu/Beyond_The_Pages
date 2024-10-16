<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    //
    public function index() {
        $articles = Article::all();
        return view('articles.index', ['articles' => $articles]);

    }

    public function create() {
        return view('articles.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'excerpt' => 'required',
            'description' => 'required',
            'status' => 'required|integer',

        ]);

        $newArticle = Article::create($data);

        return redirect(route('articles.index'));

    }

    public function edit(Article $article) {
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Article $article, Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'excerpt' => 'required',
            'description' => 'required',
            'status' => 'required|integer',
        ]);

        $article->update($data);

        return redirect(route('articles.index'))->with('success', "Article updated succesfully");
    }

    public function destroy(Article $article) {
        $article->delete();
        return redirect(route('articles.index'))->with('success', 'Article delted succefully');
    }
}
