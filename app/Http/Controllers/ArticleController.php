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
        $articles = Article::with('tags')->get();
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
            'status.*' => 'exists:tags,tag_id',

        ]);

//        $tags = ['status'];

        $data['slug'] = Str::slug($data['title']);
        $data['excerpt'] = strip_tags($data['excerpt']);
        $data['description'] = strip_tags($data['description']);

        $statusData = $data['status'];
        unset($data['status']);


        $newArticle = Article::create($data);
//        if (isset($statusData) && is_array($statusData)) {
//            $newArticle->tags()->attach($statusData);  // Attach status tags to the article_tags
//        }
        if (!empty($statusData)) {
            $newArticle->tags()->attach($statusData);  // Attach the status tags to the article_tags pivot table
        }

//        if (isset($data['tags'])) {
//            $newArticle->tags()->attach($data['tags']);
//        }

//        if($request->article_id) {
//            $status->category()->sync($request->article_id);
//        }
        return redirect(route('articles.index', ['status' => $status]));
    }

    public function edit(Article $article) {
        $status = Tag::all();
        $tag = Article_Tags::all();
        $articles = Article::with('tags')->get();
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
            'status' => 'required|array'

        ]);

        // Prepare the tag data for insertion
//        $tag = ([
//            'article_id' =>  $data->article_id,
//            'tag_id' => 'status',
//        ]);

        if(isset($data['status']) && is_array($data['status'])) {
            $article->tags()->sync($data['status']);
        }

        // Insert tag data into the article_tag table
//        DB::table('article_tag')->insert($tags);
        $data['slug'] = Str::slug($data['title']);
        $article->update($data);


        return redirect(route('articles.index', ['status' => $status]));
    }

    public function destroy(Article $article) {
        $article->delete();
        return redirect()->route('articles.index');
    }

}
