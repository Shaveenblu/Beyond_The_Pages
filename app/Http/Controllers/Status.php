<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class Status extends Controller
{
    //
    public function index() {
        return view('status.index');
    }

    public function create() {
        return view('status.index');
    }

    public function show($slug) {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('post.show', compact('post'));
    }



}
