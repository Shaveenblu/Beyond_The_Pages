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
    function __construct()
    {
        $this->middleware('permission:article-list|article-create|article-edit|article-delete', ['only' => ['index','show']]);
        $this->middleware('permission:article-create', ['only' => ['create','store']]);
        $this->middleware('permission:article-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:article-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request) {
        $search = $request->input('Search');

        // query used
        $articles = Article::with('tags')
            ->when($search, function($query, $search){
                return $query->where('title', 'like', '%'. $search . '%');
            })
            ->orderby('created_at', 'desc')
            ->paginate(3);

        return view('articles.index', ['articles' => $articles, 'search' => $search]);
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

        $data['slug'] = Str::slug($data['title']);
        $data['excerpt'] = strip_tags($data['excerpt']);
        $data['description'] = strip_tags($data['description']);

        $statusData = $data['status'];
        unset($data['status']);

        $newArticle = Article::create($data);

        if (!empty($statusData)) {
            $newArticle->tags()->attach($statusData);  // Attach the status tags to the article_tags pivot table
        }

        return redirect(route('articles.index', ['status' => $status]));
    }

    public function edit(Article $article) {
        $status = Tag::all();
        $tag = Article_Tags::all();
        $articles = Article::with('tags')->get();
        return view('articles.edit', ['article' => $article, 'status' => $status, 'tag' => $tag]);
    }

    public function show(Article $article) {
        $status = Tag::all();
        return view('articles.show', ['article'=>$article]);

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

        if(isset($data['status']) && is_array($data['status'])) {
            $article->tags()->sync($data['status']);
        }

        $data['slug'] = Str::slug($data['title']);
        $article->update($data);

        return redirect(route('articles.index', ['status' => $status]));
    }

    public function destroy(Article $article) {
        $article->delete();
        return redirect()->route('articles.index');
    }

}
