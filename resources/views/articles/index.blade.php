@extends('layouts.app')

@section('content')

    <h1 class="text-green-600 text-center text-xl">
        View articles
        <div class="m-4 col-m-5">
            <a href="{{ route('articles.create') }}" class="btn btn-outline-success rounded-[10px]">Create an Article</a>
        </div>
    </h1>

    <div class="container align-content-center justify-center text-center">
        @if(session()->has('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
            @foreach($articles as $article)
    <div class="card w-[67rem] border-indigo-400 border-1 rounded-[10px] justify-center justify-items-center m-10 bg-gradient bg-indigo-50 ">
        <div class="card-body">

                    <h4 class="card-title text-2xl p- font-bold">{{ $article->title }}</h4>
                    <p class="text-sm p-1 text-gray-400">{{ $article->created_at }}</p>
                    <h6 class="card-text text-sm p-1 py-3">{!! $article->excerpt !!}</h6>
                    <h6 class="card-text text-xl p-1 py-3">{!! $article->description !!}</h6>
                    <p class="card-text text-sm py-6">
                    @foreach($article->tags as $tag)
                        <span>#{{ $tag->name }}</span>
                        @endforeach
                    </p>
                    <div class="row">
                        <div class=" col-2">
                        <a href="{{ route('articles.edit', ['article' => $article]) }}" class="">Edit</a>
                        </div>

                    <div class="text-red-600 col-1">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger rounded-[10px]" data-toggle="modal" data-target="#deleteModal{{ $article->id }}">
                            Delete
                        </button>

                        <!-- Delete popup -->
                        <div class="modal fade" id="deleteModal{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $article->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $article->id }}">Confirm Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this article?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form method="post" action="{{ route('articles.destroy', ['article' => $article]) }}" style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger rounded-[10px]">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--Success message--}}
                        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="successModalLabel">Article Deleted</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        The article has been successfully deleted.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary rounded-[10px]" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    </div>

        </div>
    </div>
            @endforeach
    </div>



@endsection
