<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

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
            'title' => 'required|string|max:255|min:3|',
//            'slug' => 'required',
            'excerpt' => 'required|string|max:255|min:3',
            'description' => 'required|string|min:3',
            'status' => 'required|integer',
        ]);
        $data['slug'] = Str::slug($data['title']);

        $newArticle = Article::create($data);

        return redirect(route('articles.index'));

    }

    public function edit(Article $article) {
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Article $article, Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'excerpt' => 'required|string|max:255|min:3',
            'description' => 'required|string|min:3',
            'status' => 'required|integer',
        ]);
        $data['slug'] = Str::slug($data['title']);

        $article->update($data);

        return redirect(route('articles.index'));
    }

    public function destroy(Article $article) {
        $article->delete();
        $alert = Alert::success('Deleted successfully', 'Article deleted successfully');
        return redirect()->route('articles.index');
    }

}
