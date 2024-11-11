@extends('layouts.app')

@section('content')

    <h1 class="text-green-600 text-center text-xl mt-5">
        View articles
    </h1>

    <div class="container align-content-center justify-center text-center">
        <div class="searchbar mt-0 mb-4 m-10">
            <div class="row">
                <div class="col-md-6 mt-5">
                    <form>
                        <div class="input-group">
                            <input
                                id="indexSearch"
                                type="text"
                                name="Search"
                                placeholder="{{ __('crud.common.search') }}"
                                value="{{ $search ?? '' }}"
                                class="form-control"
                                autocomplete="off"
                                required/>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon ion-md-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="m-2 col-m-5 mt-5">
                    <a href="{{ route('articles.create') }}" class="btn btn-outline-success rounded-[10px]">+ Create</a>
                </div>
                <div class="col-md-6 text-right">
                    @can('create', App\Models\Article::class)

                        <a href="{{ route('articles.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i>@lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>


        @if(session()->has('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
        <div class="card m-10">
            <div class="card-body">

                <div class="table-responsive">
                    <table border="1" class="table table-borderless table-hover">
                        <tr>
                            <th scope="col" class="text-green-600 text-xl text-left">Title</th>
                            <th scope="col" class="text-green-600 text-xl text-left">Slug</th>
                            <th scope="col" class="text-green-600 text-xl text-left">Excerpt</th>
                            <th scope="col" class="text-green-600 text-xl text-left">Description</th>
                            <th scope="col" class="text-green-600 text-xl text-left">Status</th>
                            <th scope="col" class="text-green-600 text-xl text-left">Actions</th>

                        </tr>

            @foreach($articles as $article)
                <tr>
                    <td class="text-sm text-left">{{ $article->title }}</td>
                    <td class="text-sm text-left">{{ $article->slug }}</td>
                    <td class="text-sm text-left">{!! \Str::limit(trim($article->excerpt), 16) !!}</td>
                    <td class="text-sm text-left">{!! \Str::limit(trim($article->description), 16) !!}</td>
                    <td class="text-sm text-left">
                        @foreach($article->tags as $tag)
                            <span>#{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <div class="container">
                        <a href='{{ route('articles.edit', ['article' =>$article]) }}'>
                            <i class="icon ion-md-create"></i>
                        </a>
                        <a href =' {{ route('articles.show', ['article' => $article]) }} '>
                            <i class="icon ion-md-eye"></i>
                        </a>

                        <div class="text-red-600 col-1">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger rounded-[10px]" data-toggle="modal" data-target="#deleteModal{{ $article->id }}">
                                <i class="icon ion-md-trash"></i>
                            </button>
                        </div>
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
                    </td>

                </tr>
            @endforeach
        </table>
                </div>
            </div>
        </div>

    </div>

{{--    pagination --}}
    {{$articles->links()}}


@endsection
