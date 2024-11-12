@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card  m-10 ">
        <div class="card-body ">
            <h4 class="card-title">
                <a href="{{ route('articles.index') }}" class="mr-5"><i class="icon ion-md-arrow-back"></i> Go back</a>

            </h4>
                <div class="mt-4">
                    <div class="mb-4 font-bold">
                        <span class="text-2xl">{{ $article->title }}</span>
                    </div>

                    <div class="mb-4">

                        <span class="text-sm">{!! $article->excerpt !!}</span>
                    </div>

                    <div class="mb-4">

                        <span class="text-xl">{!! $article->description !!}</span>
                    </div>
                </div>

                    <label>
                        @foreach($article->tags as $tag)
                            <span class="text-sm">#{{ $tag->name }}</span>
                        @endforeach
                    </label>

        </div>
            <div class="m-2 col-m-5 mt-5">
                <a href="{{ route('articles.create') }}" class="btn btn-outline-success rounded-[10px]">
                    <i class="icon ion-md-add"> Create article</i>

                </a>
            </div>
    </div>

</div>

@endsection

