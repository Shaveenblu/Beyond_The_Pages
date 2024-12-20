<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ArticleController extends Controller
{
    //
    public function index() {
        $articles = Article::with('tag')->get();
        return view('articles.index', ['articles' => $articles]);

    }

    public function create() {
        $data = Article::all();
        $status = Tag::all();
        return view('articles.create', ['data' => $data, 'status' => $status]);
    }

    public function store(Request $request) {
        $status = Tag::all();

        /*need to save user_id*/
        /*need to save category_id*/
        /*need to save tags*/
       // article_tag (table)
        $data = $request->validate([
            'title' => 'required|string|max:255|min:3|',
            'excerpt' => 'required|string|max:255|min:3',
            'description' => 'required|string|min:3',
            'status' => 'required|integer',
        ]);
        $data['slug'] = Str::slug($data['title']);

        $newArticle = Article::create($data);

        return redirect(route('articles.index', ['status' => $status]));

    }

    public function edit(Article $article) {
        $status = Tag::all();
        return view('articles.edit', ['article' => $article, 'status' => $status]);
    }

    public function update(Article $article, Request $request) {
        $status = Tag::all();
        $data = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'excerpt' => 'required|string|max:255|min:3',
            'description' => 'required|string|min:3',
            'status' => 'required|integer',
        ]);
        $data['slug'] = Str::slug($data['title']);

        $article->update($data);

        return redirect(route('articles.index', ['status' => $status]));
    }

    public function destroy(Article $article) {
        $article->delete();
        Alert::success('Deleted successfully', 'Article deleted successfully');
        return redirect()->route('articles.index');
    }

}
