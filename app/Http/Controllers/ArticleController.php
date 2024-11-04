<?php

namespace App\Http\Controllers;

use App\Models\Article_Tags;
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
        $tag = Article_Tags::all();
        $status = Tag::all();
        return view('articles.create', ['data' => $data, 'status' => $status, 'tag' => $tag]);
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
            'status' => 'required|array',
        ]);





        $data['slug'] = Str::slug($data['title']);
        $data['excerpt'] = strip_tags($data['excerpt']);
        $data['description'] = strip_tags($data['description']);

        $newArticle = Article::create($data);

        if (isset($data['tags'])) {
            $newArticle->tags()->attach($data['tags']);
        }
        return redirect(route('articles.index', ['status' => $status]));
    }

    public function edit(Article $article) {
        $status = Tag::all();
        $tag = Article_Tags::all();
        return view('articles.edit', ['article' => $article, 'status' => $status, 'tag' => $tag]);
    }

    public function update(Article $article, Request $request) {
        // Retrieve all statuses for potential use
        $status = Tag::all();

        // Validate the incoming request data
        $data = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'excerpt' => 'required|string|max:255|min:3',
            'description' => 'required|string|min:3',
            'status' => 'required|integer',
        ]);

        // Prepare the tag data for insertion
        $tag = [
            'article_id' =>  $data->article_id,
            'tag_id' => 'status',
        ];

        // Insert tag data into the article_tag table
        DB::table('article_tag')->insert($tag);
        $data['slug'] = Str::slug($data['title']);
        $article->update($data);


        return redirect(route('articles.index', ['status' => $status]));
    }

    public function destroy(Article $article) {
        $article->delete();
        return redirect()->route('articles.index');
    }

}
