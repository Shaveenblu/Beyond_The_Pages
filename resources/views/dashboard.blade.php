<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Welcome to Beyond the Pages') }}
        </h2>
        <br/>
        <div>
            <div class="row">
                <div class="col-2">
                    <a href="{{ route('articles.create') }}" class="btn btn-outline-success">Create an Article</a>
                </div>
                <div class="col-1.3">
                    <a href="{{ route('articles.index') }}" class="btn btn-outline-success">Read Articles</a>
                </div>
            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
